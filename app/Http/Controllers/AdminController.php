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

        $totAlunos   = Aluno::count();
        $totBoletins = Boletim::count();
        $hoje        = Cronograma::where('data', now()->toDateString())->count();
        $recentes    = Boletim::with('aluno')->orderByDesc('created_at')->take(8)->get();

        $totSaeb      = SaebResultado::count();
        $recentesSaeb = SaebResultado::with('aluno')->orderByDesc('created_at')->take(8)->get();

        return view('admin.dashboard', compact(
            'totAlunos', 'totBoletins', 'hoje',
            'recentes', 'totSaeb', 'recentesSaeb'
        ));
    }

    // ---------------- Cronograma ----------------
    public function cronograma()
    {
        $this->requireAdmin();

        $itens = Cronograma::orderByDesc('data')->paginate(20);

        return view('admin.cronograma', compact('itens'));
    }

    public function storeCronograma(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'dia_semana'  => 'required|string|max:20',
            'turma'       => 'required|string|max:50',
            'disciplina'  => 'required|string|max:150',
            'professor'   => 'required|string|max:150',
            'inicio'      => 'required',
            'fim'         => 'required',
            'sala'        => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        Cronograma::create($data);
        return back()->with('ok', 'Aula adicionada ao cronograma.');
    }
    public function cronogramaEdit($id)
{
    $item = Cronograma::findOrFail($id);
    return view('admin.cronograma_edit', compact('item'));
}public function cronogramaUpdate(Request $req, $id)
{
    $item = Cronograma::findOrFail($id);

    $item->update($req->all());

    return redirect()->route('admin.cronograma')
                     ->with('ok', 'Horário atualizado com sucesso!');
}public function cronogramaDelete($id)
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
}
}
