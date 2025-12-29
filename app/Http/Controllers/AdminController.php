<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\InstitucionalPessoa;
use App\Models\Permissao;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    private function requireAdmin()
    {
        if (!session('admin_id')) {
            abort(403, 'Não autenticado como gestor.');
        }
        return Admin::findOrFail(session('admin_id'));
    }
// ---------------- Dashboard ----------------
public function dashboard()
{
    $this->requireAdmin();

    $admin = \App\Models\Admin::find(session('admin_id'));

    /*
    |--------------------------------------------------------------------------
    | Dados BASE (todos veem)
    |--------------------------------------------------------------------------
    */
    $totAlunos = \App\Models\Aluno::count();
    $totNoticias = \App\Models\News::count();
    $ultimasNoticias = \App\Models\News::orderByDesc('published_at')->take(5)->get();

    /*
    |--------------------------------------------------------------------------
    | Dados condicionais por permissão
    |--------------------------------------------------------------------------
    */
    $totBoletins   = null;
    $recentes      = collect();
    $totSaeb       = null;
    $recentesSaeb  = collect();
    $hoje          = null;

    // Diretor vê tudo
    if ($admin->role === 'diretor') {
        $totAlunos = \App\Models\Aluno::count();
        $totBoletins = \App\Models\Boletim::count();
        $totNoticias = \App\Models\News::count();
        $hoje = \App\Models\Cronograma::whereDate('data', now())->count();
        $ultimasNoticias = \App\Models\News::orderByDesc('published_at')->take(5)->get();

        // Gráficos: exemplos, troque por queries reais se quiser
        $alunosPorTurma = \App\Models\Aluno::selectRaw('turma, COUNT(*) as total')->groupBy('turma')->pluck('total','turma');
        $boletinsPorAno = \App\Models\Boletim::selectRaw('ano, COUNT(*) as total')->groupBy('ano')->pluck('total','ano');
        $noticiasPorMes = \App\Models\News::selectRaw("to_char(published_at, 'MM/YYYY') as mes, COUNT(*) as total")
            ->groupBy('mes')->orderBy('mes')->pluck('total','mes');

        $gestores = Admin::where('role', 'gestor')->get();
        $permissoes = \App\Models\Permissao::orderBy('descricao')->get();
        $map = [];
        foreach ($gestores as $g) {
            $map[$g->id] = $g->permissoes()->pluck('permissoes.id')->toArray();
        }

        return view('admin.diretor.dashboard', compact(
            'admin', 'totAlunos', 'totBoletins', 'totNoticias', 'hoje', 'ultimasNoticias',
            'alunosPorTurma', 'boletinsPorAno', 'noticiasPorMes',
            'gestores', 'permissoes', 'map'
        ));
    }

    // Gestor: só se tiver permissão
    else {

        if (adminPode('ver_relatorios')) {

            $totBoletins = \App\Models\Boletim::count();
            $recentes = \App\Models\Boletim::with('aluno')
                ->orderByDesc('created_at')
                ->take(8)
                ->get();

            $totSaeb = \App\Models\SaebResultado::count();
            $recentesSaeb = \App\Models\SaebResultado::with('aluno')
                ->orderByDesc('created_at')
                ->take(8)
                ->get();
        }

        if (adminPode('gerenciar_cronograma')) {
            $hoje = \App\Models\Cronograma::whereDate('data', now())->count();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | View correta por tipo de admin
    |--------------------------------------------------------------------------
    */
return view(
    $admin->role === 'diretor'
        ? 'admin.diretor.dashboard'
        : 'admin.gestor.dashboard',
    compact(
        'admin',
        'totAlunos',
        'totBoletins',
        'hoje',
        'recentes',
        'totSaeb',
        'recentesSaeb',
        'totNoticias',
        'ultimasNoticias'
    )
);


}
// ========================= CRONOGRAMA =========================

/**
 * ================== VIEW PRINCIPAL (GRADE VISUAL) ==================
 * USADO PELO DRAG & DROP
 */
public function cronogramaIndex(Request $request)
{
    $anos = [
        "1º Ano" => ['1º DS','1º EDF','1º MEC','1º Eletro','1º Agro'],
        "2º Ano" => ['2º DS','2º EDF','2º MEC','2º Eletro','2º Agro'],
        "3º Ano" => ['3º DS','3º EDF','3º MEC','3º Eletro','3º Agro'],
    ];

    $dias = ['Segunda','Terça','Quarta','Quinta','Sexta'];

    $aulas = [
        1 => ['07:20','08:10'],
        2 => ['08:10','09:00'],
        3 => ['09:10','09:50'],
        4 => ['10:10','11:00'],
        5 => ['11:00','11:40'],
        6 => ['11:40','12:30'],
    ];

    $ano = $request->get('ano', '1º Ano');
    if (!isset($anos[$ano])) $ano = '1º Ano';

    $dia = $request->get('dia', 'Segunda');
    if (!in_array($dia, $dias)) $dia = 'Segunda';

    $turmas = $anos[$ano];

    // Professores + disciplinas (blocos)
    $professores = Admin::where('role', 'professor')
        ->with('disciplinas')
        ->orderBy('nome')
        ->get();

    // Slots existentes (DRAG)
    $itens = Cronograma::where('dia_semana', $dia)
        ->whereIn('turma', $turmas)
        ->whereNotNull('aula') // 👈 importante
        ->get();

    // mapa turma|aula => registro
    $map = [];
    foreach ($itens as $i) {
        $map[$i->turma.'|'.$i->aula] = $i;
    }

    return view('admin.cronograma.index', compact(
        'anos','dias','aulas','ano','dia','turmas','professores','map'
    ));
}

/**
 * ================== DRAG SAVE ==================
 */
public function cronogramaDragSave(Request $request)
{
    $data = $request->validate([
        'dia_semana' => 'required|string|max:20',
        'turma'      => 'required|string|max:100',
        'aula'       => 'required|integer|min:1|max:6',
        'inicio'     => 'required|date_format:H:i',
        'fim'        => 'required|date_format:H:i',
        'disciplina' => 'required|string|max:150',
        'professor'  => 'required|string|max:150',
    ]);

    Cronograma::updateOrCreate(
        [
            'dia_semana' => $data['dia_semana'],
            'turma'      => $data['turma'],
            'aula'       => $data['aula'], // 👈 CHAVE DO DRAG
        ],
        [
            'inicio'     => $data['inicio'],
            'fim'        => $data['fim'],
            'disciplina' => $data['disciplina'],
            'professor'  => $data['professor'],
        ]
    );

    return response()->json(['ok' => true]);
}

/**
 * ================== DRAG DELETE ==================
 */
public function cronogramaDragDelete(Request $request)
{
    $data = $request->validate([
        'dia_semana' => 'required|string|max:20',
        'turma'      => 'required|string|max:100',
        'aula'       => 'required|integer|min:1|max:6',
    ]);

    Cronograma::where($data)->delete();

    return response()->json(['ok' => true]);
}






/**
 * ================== VIEW ANTIGA (FORMULÁRIO) ==================
 * ⚠️ MANTIDA PRA NÃO QUEBRAR NADA
 */
public function cronograma(Request $request)
{
    $dia = $request->get('dia', 'Segunda');
    $dias = ['Segunda','Terça','Quarta','Quinta','Sexta'];

    $anos = [
        "1º Ano" => ['1º DS','1º EDF','1º MEC','1º Eletro','1º Agro'],
        "2º Ano" => ['2º DS','2º EDF','2º MEC','2º Eletro','2º Agro'],
        "3º Ano" => ['3º DS','3º EDF','3º MEC','3º Eletro','3º Agro'],
    ];

    $aulas = [
        1 => ['inicio' => '07:20', 'fim' => '08:10'],
        2 => ['inicio' => '08:10', 'fim' => '09:00'],
        3 => ['inicio' => '09:10', 'fim' => '09:50'],
        4 => ['inicio' => '10:10', 'fim' => '11:00'],
        5 => ['inicio' => '11:00', 'fim' => '11:40'],
        6 => ['inicio' => '11:40', 'fim' => '12:30'],
    ];

    $professores = Admin::where('role', 'professor')
        ->with('disciplinas')
        ->orderBy('nome')
        ->get();

    $itens = Cronograma::where('dia_semana', $dia)->get();

    return view('admin.cronograma.index', compact(
        'dia','dias','anos','aulas','itens','professores'
    ));
}






/**
 * ================== FORM LEGADO (JSON / AJAX) ==================
 */
public function salvarCronograma(Request $request)
{
    $request->validate([
        'dia'        => 'required|string',
        'turma'      => 'required|string',
        'aula'       => 'required|integer|min:1|max:6',
        'disciplina' => 'required|string',
        'professor'  => 'required|string',
    ]);

    $horarios = [
        1 => ['07:20','08:10'],
        2 => ['08:10','09:00'],
        3 => ['09:10','09:50'],
        4 => ['10:10','11:00'],
        5 => ['11:00','11:40'],
        6 => ['11:40','12:30'],
    ];

    [$inicio, $fim] = $horarios[$request->aula];

    Cronograma::updateOrCreate(
        [
            'dia_semana' => $request->dia,
            'turma'      => $request->turma,
            'aula'       => $request->aula,
        ],
        [
            'inicio'     => $inicio,
            'fim'        => $fim,
            'disciplina' => $request->disciplina,
            'professor'  => $request->professor,
        ]
    );

    return response()->json(['ok' => true]);
}





/**
 * ================== CRUD SIMPLES ==================
 */
public function cronogramaEdit($id)
{
    $item = Cronograma::findOrFail($id);
    return view('admin.cronograma_edit', compact('item'));
}

public function cronogramaUpdate(Request $req, $id)
{
    $item = Cronograma::findOrFail($id);
    $item->update($req->all());

    return redirect()->route('admin.cronograma')
        ->with('ok', 'Horário atualizado com sucesso!');
}

public function cronogramaDelete($id)
{
    Cronograma::findOrFail($id)->delete();

    return redirect()->route('admin.cronograma')
        ->with('ok', 'Horário removido!');
}






    // ---------------- Boletins ----------------
    public function boletins()
    {
        $this->requireAdmin();

        $boletins = Boletim::with('aluno')->orderByDesc('created_at')->paginate(20);
        $alunos   = Aluno::orderBy('nome')->get();

        return view('admin.boletins', compact('boletins', 'alunos'));
    }

    public function storeBoletim(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'aluno_id'    => 'required|exists:alunos,id',
            'disciplina'  => 'required|string|max:100',
            'ano'         => 'required|integer|min:2000|max:2100',
            'tipo'        => 'required|string|max:50',
            'origem'      => 'required|in:manual,saeb',
            'nota'        => 'nullable|numeric|min:0|max:10',
            'etapa'       => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        if ($data['origem'] === 'saeb') {
            $saeb = SaebResultado::where('aluno_id', $data['aluno_id'])
                ->where('disciplina', $data['disciplina'])
                ->where('ano', $data['ano'])
                ->orderByDesc('created_at')
                ->first();

            if (!$saeb) {
                return back()->withErrors([
                    'saeb' => 'Nenhum resultado SAEB encontrado para este aluno/ano/disciplina.'
                ]);
            }

            $data['nota'] = $saeb->media;
            $data['tipo'] = 'SAEB';
        }

        Boletim::create($data);
        return back()->with('ok', 'Boletim registrado.');
    }

    // ---------------- Usuários ----------------
    public function usuarios()
    {
        $this->requireAdmin();

        $alunos = Aluno::orderBy('nome')->get();
        $admins = Admin::orderBy('nome')->get();

        return view('admin.usuarios', compact('alunos', 'admins'));
    }

    public function storeUsuario(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'tipo'   => 'required|in:aluno,admin',
            'nome'   => 'required|string|max:100',
            'email'  => 'required|email|unique:alunos,email|unique:admins,email',
            'senha'  => 'required|string|min:4',
            'escola' => 'nullable|string|max:50',
            'turma'  => 'nullable|string|max:50',
        ]);

        if ($data['tipo'] === 'aluno') {
            Aluno::create([
                'nome'   => $data['nome'],
                'email'  => $data['email'],
                'senha'  => Hash::make($data['senha']),
                'escola' => $data['escola'] ?? 'CEEP',
                'turma'  => $data['turma'] ?? null,
            ]);
        } else {
            Admin::create([
                'nome'  => $data['nome'],
                'email' => $data['email'],
                'senha' => Hash::make($data['senha']),
            ]);
        }

        return back()->with('ok', 'Usuário criado com sucesso!');
    }

    public function editUsuario($tipo, $id)
    {
        $this->requireAdmin();

        $user = $tipo === 'aluno' ? Aluno::findOrFail($id) : Admin::findOrFail($id);

        return view('admin.edit_usuario', compact('user', 'tipo'));
    }

    public function updateUsuario(Request $request, $tipo, $id)
    {
        $this->requireAdmin();

        if ($tipo === 'aluno') {
            $user = Aluno::findOrFail($id);
            $data = $request->validate([
                'nome'   => 'required|string|max:100',
                'email'  => 'required|email|unique:alunos,email,' . $id,
                'senha'  => 'nullable|string|min:4',
                'escola' => 'nullable|string|max:50',
                'turma'  => 'nullable|string|max:50',
            ]);
        } else {
            $user = Admin::findOrFail($id);
            $data = $request->validate([
                'nome'  => 'required|string|max:100',
                'email' => 'required|email|unique:admins,email,' . $id,
                'senha' => 'nullable|string|min:4',
            ]);
        }

        if (!empty($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        } else {
            unset($data['senha']);
        }

        $user->update($data);

        return redirect()->route('admin.usuarios')->with('ok', 'Usuário atualizado com sucesso!');
    }

    public function deleteUsuario($tipo, $id)
    {
        $this->requireAdmin();

        if ($tipo === 'aluno') {
            Aluno::findOrFail($id)->delete();
        } else {
            Admin::findOrFail($id)->delete();
        }

        return back()->with('ok', 'Usuário excluído com sucesso!');
    }

    // ---------------- Criar Aluno direto ----------------
    public function createAluno()
    {
        $this->requireAdmin();
        return view('admin.create_aluno');
    }

    public function storeAluno(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'nome'   => 'required|string|max:100',
            'email'  => 'required|email|unique:alunos,email',
            'senha'  => 'required|string|min:4',
            'escola' => 'required|string|max:50',
            'turma'  => 'required|string|max:50',
        ]);

        Aluno::create([
            'nome'   => $data['nome'],
            'email'  => $data['email'],
            'senha'  => Hash::make($data['senha']),
            'escola' => $data['escola'],
            'turma'  => $data['turma'],
        ]);

        return redirect()->route('admin.usuarios')->with('ok', 'Aluno criado com sucesso!');
    }public function institucionalIndex()
{
    $this->requireAdmin();

    // PAGINATE (senão links() dá erro)
    $pessoas = InstitucionalPessoa::orderBy('nivel')
        ->orderBy('ordem')
        ->orderBy('nome')
        ->paginate(12);

    return view('admin.institucional.index', compact('pessoas'));
}

public function institucionalCreate()
{
    $this->requireAdmin();
    return view('admin.institucional.create');
}

public function institucionalStore(Request $request)
{
    $this->requireAdmin();

    $data = $request->validate([
        'nome'      => 'required|string|max:150',
        'slug'      => 'nullable|string|max:180',
        'cargo'     => 'required|string|max:150',
        'nivel'     => 'required|integer|min:1|max:10',
        'ordem'     => 'nullable|integer|min:0|max:9999',
        'biografia' => 'nullable|string',
        'foto'      => 'nullable|image|max:4096',
        'ativo'     => 'nullable|boolean',
    ]);

    // slug: se não vier, gera do nome
    $slugBase = $data['slug'] ?? '';
    $slugBase = trim($slugBase) !== '' ? $slugBase : $data['nome'];
    $slug = Str::slug($slugBase);

    // garante unique
    $finalSlug = $slug;
    $i = 2;
    while (InstitucionalPessoa::where('slug', $finalSlug)->exists()) {
        $finalSlug = $slug . '-' . $i;
        $i++;
    }
    $data['slug'] = $finalSlug;

    $data['ordem'] = $data['ordem'] ?? 0;
    $data['ativo'] = $request->boolean('ativo', true);

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('institucional', 'public');
    }

    InstitucionalPessoa::create($data);

    return redirect()->route('admin.institucional.index')
        ->with('ok', 'Pessoa adicionada no Institucional!');
}

public function institucionalEdit($id)
{
    $this->requireAdmin();

    $pessoa = InstitucionalPessoa::findOrFail($id);
    return view('admin.institucional.edit', compact('pessoa'));
}

public function institucionalUpdate(Request $request, $id)
{
    $this->requireAdmin();

    $pessoa = InstitucionalPessoa::findOrFail($id);

    $data = $request->validate([
        'nome'      => 'required|string|max:150',
        'slug'      => 'nullable|string|max:180',
        'cargo'     => 'required|string|max:150',
        'nivel'     => 'required|integer|min:1|max:10',
        'ordem'     => 'nullable|integer|min:0|max:9999',
        'biografia' => 'nullable|string',
        'foto'      => 'nullable|image|max:4096',
        'ativo'     => 'nullable|boolean',
    ]);

    // slug: se vier vazio, regenera do nome
    $slugBase = $data['slug'] ?? '';
    $slugBase = trim($slugBase) !== '' ? $slugBase : $data['nome'];
    $slug = Str::slug($slugBase);

    // unique (ignorando o atual)
    $finalSlug = $slug;
    $i = 2;
    while (InstitucionalPessoa::where('slug', $finalSlug)->where('id', '!=', $pessoa->id)->exists()) {
        $finalSlug = $slug . '-' . $i;
        $i++;
    }
    $data['slug'] = $finalSlug;

    $data['ordem'] = $data['ordem'] ?? 0;
    $data['ativo'] = $request->boolean('ativo', true);

    if ($request->hasFile('foto')) {
        if ($pessoa->foto) {
            Storage::disk('public')->delete($pessoa->foto);
        }
        $data['foto'] = $request->file('foto')->store('institucional', 'public');
    }

    $pessoa->update($data);

    return redirect()->route('admin.institucional.index')
        ->with('ok', 'Pessoa atualizada com sucesso!');
}

public function institucionalDestroy($id)
{
    $this->requireAdmin();

    $pessoa = InstitucionalPessoa::findOrFail($id);

    if ($pessoa->foto) {
        Storage::disk('public')->delete($pessoa->foto);
    }

    $pessoa->delete();

    return redirect()->route('admin.institucional.index')
        ->with('ok', 'Pessoa removida do Institucional.');
}public function permissoesIndex()
{
    $admin = Admin::find(session('admin_id'));

    if ($admin->role !== 'diretor') {
        abort(403);
    }

    return view('admin.permissoes.index', [
        'gestores' => Admin::where('role', 'gestor')->get(),
        'permissoes' => Permissao::all()
    ]);
}

public function permissoesUpdate(Admin $admin, Request $request)
{
    $diretor = Admin::find(session('admin_id'));

    if ($diretor->role !== 'diretor') {
        abort(403);
    }

    $admin->permissoes()->sync(
        $request->input('permissoes', [])
    );

    return back()->with('success', 'Permissões atualizadas.');
}

public function projetosIndex()
    {
        $this->requireAdmin();

        $admin = \App\Models\Admin::find(session('admin_id'));

        // Exemplo de dados fictícios para projetos
        $projetos = [
            ['id' => 1, 'nome' => 'Projeto A', 'descricao' => 'Descrição do Projeto A'],
            ['id' => 2, 'nome' => 'Projeto B', 'descricao' => 'Descrição do Projeto B'],
        ];

        return view('admin.projetos.index', compact('admin', 'projetos'));
    }
public function professoresIndex()
{
    $this->requireAdmin();

    $professores = Admin::where('role', 'professor')
        ->with('disciplinas')
        ->orderBy('nome')
        ->get();

    return view('admin.professores.index', compact('professores'));
}

public function editarProfessor($id)
{
    $this->requireAdmin();

    $professor = Admin::where('role', 'professor')
        ->with('disciplinas')
        ->findOrFail($id);

    $disciplinas = Disciplina::orderBy('nome')->get();

    return view('admin.professores.edit', compact(
        'professor',
        'disciplinas'
    ));
}

// ============================
// SALVAR DISCIPLINAS
// ============================
public function salvarProfessor(Request $request, $id)
{
    $this->requireAdmin();

    $professor = Admin::where('role', 'professor')
        ->findOrFail($id);

    $professor->disciplinas()->sync(
        $request->input('disciplinas', [])
    );

    return redirect()
        ->route('admin.professores')
        ->with('ok', 'Disciplinas atualizadas com sucesso!');
}

    public function professores()
{
    $this->requireAdmin();

    $professores = Admin::where('role', 'professor')
        ->with('disciplinas')
        ->orderBy('nome')
        ->get();

    return view('admin.professores.index', compact('professores'));
}
// FORM CREATE
public function createProfessor()
{
    $this->requireAdmin();

    return view('admin.professores.create');
}

// STORE
public function storeProfessor(Request $request)
{
    $this->requireAdmin();

    $data = $request->validate([
        'nome'  => 'required|string|max:150',
        'email' => 'required|email|unique:admins,email',
        'senha' => 'required|string|min:4',
    ]);

    Admin::create([
        'nome'  => $data['nome'],
        'email' => $data['email'],
        'senha' => Hash::make($data['senha']),
        'role'  => 'professor',
    ]);

    return redirect()
        ->route('admin.professores')
        ->with('ok', 'Professor criado com sucesso! Agora atribua as disciplinas.');
}


public function disciplinasIndex()
{
    $this->requireAdmin();

    $disciplinas = Disciplina::orderBy('nome')->get();

    return view('admin.disciplinas.index', compact('disciplinas'));
}

// FORM CREATE
public function disciplinasCreate()
{
    $this->requireAdmin();

    return view('admin.disciplinas.create');
}

// STORE
public function disciplinasStore(Request $request)
{
    $this->requireAdmin();

    $data = $request->validate([
        'nome'   => 'required|string|max:150',
        'codigo' => 'required|string|max:50|unique:disciplinas,codigo',
    ]);

    Disciplina::create($data);

    return redirect()
        ->route('admin.disciplinas.index')
        ->with('ok', 'Disciplina criada com sucesso.');
}

// EDIT
public function disciplinasEdit($id)
{
    $this->requireAdmin();

    $disciplina = Disciplina::findOrFail($id);

    return view('admin.disciplinas.edit', compact('disciplina'));
}

// UPDATE
public function disciplinasUpdate(Request $request, $id)
{
    $this->requireAdmin();

    $disciplina = Disciplina::findOrFail($id);

    $data = $request->validate([
        'nome'   => 'required|string|max:150',
        'codigo' => 'required|string|max:50|unique:disciplinas,codigo,' . $id,
    ]);

    $disciplina->update($data);

    return redirect()
        ->route('admin.disciplinas')
        ->with('ok', 'Disciplina atualizada.');
}

// DELETE
public function disciplinasDelete($id)
{
    $this->requireAdmin();

    Disciplina::findOrFail($id)->delete();

    return back()->with('ok', 'Disciplina removida.');
}public function dashboardProfessor()
{
    $admin = Admin::find(session('admin_id'));

    if (!$admin || $admin->role !== 'professor') {
        abort(403);
    }

    $diaHoje = match (now()->dayOfWeek) {
        1 => 'Segunda',
        2 => 'Terça',
        3 => 'Quarta',
        4 => 'Quinta',
        5 => 'Sexta',
        default => null,
    };

    $aulasHoje = Cronograma::where('professor', $admin->nome)
        ->where('dia_semana', $diaHoje)
        ->orderBy('inicio')
        ->get();

    return view('admin.professor.dashboard', compact(
        'admin',
        'diaHoje',
        'aulasHoje'
    ));
}

}
