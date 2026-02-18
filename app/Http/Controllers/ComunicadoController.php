<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Mail\ComunicadoMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\EnviarComunicadoEmail;
use App\Models\ComunicadoLeitura;

class ComunicadoController extends Controller
{
    /* ================= ADMIN ================= */


public function indexAdmin()
{
    $comunicados = Comunicado::with(['leituras'])->orderByDesc('created_at')->get();

    $stats = [];

    foreach ($comunicados as $c) {

        $alunosQuery = Aluno::query();

        // 🎯 PÚBLICO GERAL
        if ($c->publico === 'geral') {
            // não filtra, pega todos
        }

        // 🎯 TURMAS ESPECÍFICAS (JSON)
        if ($c->publico === 'turma' && !empty($c->turmas)) {
            $alunosQuery->whereIn('turma', $c->turmas);
        }

        // 🎯 CURSO
        if ($c->publico === 'curso' && $c->curso) {
            $alunosQuery->where('curso', $c->curso);
        }

        // TOTAL DE ALUNOS QUE DEVERIAM RECEBER
        $alunosIds = $alunosQuery->pluck('id');

        $totalAlunos = $alunosIds->count();

        // TOTAL DE LEITURAS APENAS DESSE PÚBLICO
        $lidos = $c->leituras
            ->whereIn('aluno_id', $alunosIds)
            ->count();

        $stats[$c->id] = [
            'total' => $totalAlunos,
            'lidos' => $lidos,
            'percentual' => $totalAlunos > 0
                ? round(($lidos / $totalAlunos) * 100)
                : 0
        ];
    }

    return view('admin.comunicados.index', compact('comunicados', 'stats'));
}


    public function edit($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        return view('admin.comunicados.edit', compact('comunicado'));
    }
public function create()
{
    return view('admin.comunicados.create');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required',
            'publico' => 'required',
        ]);

        $comunicado = Comunicado::findOrFail($id);

        $comunicado->update([
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'publico'  => $request->publico,
            'turma'    => $request->turma,
        ]);

        return redirect()
            ->route('admin.comunicados.index')
            ->with('ok', 'Comunicado atualizado com sucesso.');
    }

    public function destroy($id)
    {
        Comunicado::findOrFail($id)->delete();

        return redirect()
            ->route('admin.comunicados.index')
            ->with('ok', 'Comunicado excluído com sucesso.');
    }
public function store(Request $request)
{
    $data = $request->validate([
        'titulo'   => 'required|string|max:200',
        'conteudo' => 'required|string',
        'publico'  => 'required|in:geral,turma,curso',
        'turmas'   => 'nullable|array',
        'turmas.*' => 'string|max:50',
        'curso'    => 'nullable|string|max:50',
    ]);

    $data['criado_por'] = session('admin_id');
    $data['ativo'] = true;

    // ✅ ISSO FALTAVA
    if ($data['publico'] === 'turma') {
        $data['turmas'] = $request->turmas ?? [];
    } else {
        $data['turmas'] = null;
    }

    $comunicado = Comunicado::create($data);

    /* ================= ENVIO DE EMAIL ================= */

    $alunosQuery = Aluno::whereNotNull('email');

    // ✅ CORRETO: múltiplas turmas
    if ($comunicado->publico === 'turma' && !empty($comunicado->turmas)) {
        $alunosQuery->whereIn('turma', $comunicado->turmas);
    }

    if ($comunicado->publico === 'curso' && $comunicado->curso) {
        $alunosQuery->where('curso', $comunicado->curso);
    }

    $emails = $alunosQuery->pluck('email');

    foreach ($emails as $email) {
        EnviarComunicadoEmail::dispatch(
            $email,
            $comunicado->id
        );
    }

    return redirect()
        ->route('admin.comunicados.index')
        ->with('ok', 'Comunicado publicado. Envio de e-mails em segundo plano.');
}

    /* ================= ALUNO ================= */

public function indexAluno()
{
    if (!session('aluno_id')) {
        abort(403);
    }

    $aluno = Aluno::findOrFail(session('aluno_id'));

    $comunicados = Comunicado::where('ativo', true)
        ->where(function ($q) use ($aluno) {
            $q->where('publico', 'geral')
              ->orWhere(function ($q2) use ($aluno) {
                  $q2->where('publico', 'turma')
                     ->whereJsonContains('turmas', $aluno->turma);
              });
        })
        ->with(['leituras' => function ($q) {
            $q->where('aluno_id', session('aluno_id'));
        }])
        ->orderByDesc('created_at')
        ->get();

    /* ================= EVENTOS (10 DIAS) ================= */
    $eventosProximos = \App\Models\CalendarioInstitucional::where('ativo', true)
        ->whereIn('publico', ['alunos', 'todos'])
        ->whereBetween('data', [
            now()->startOfDay(),
            now()->addDays(10)->endOfDay()
        ])
        ->orderBy('data')
        ->orderBy('hora_inicio')
        ->get();

    return view('aluno.comunicados.index', compact(
        'comunicados',
        'eventosProximos'
    ));
}


public function marcarLido(Comunicado $comunicado)
{
    $alunoId = session('aluno_id');

    if (!$alunoId) {
        abort(403, 'Aluno não autenticado.');
    }

    ComunicadoLeitura::updateOrCreate(
        [
            'comunicado_id' => $comunicado->id,
            'aluno_id' => $alunoId,
        ],
        [
            'lido_em' => now(),
        ]
    );

    return back();
}


public function marcarNaoLido(Comunicado $comunicado)
{
    $alunoId = session('aluno_id');

    if (!$alunoId) {
        abort(403, 'Aluno não autenticado.');
    }

    ComunicadoLeitura::where([
        'comunicado_id' => $comunicado->id,
        'aluno_id' => $alunoId,
    ])->delete();

    return back();
}
public function verLeituraTurma(Comunicado $comunicado)
{
    $alunosQuery = Aluno::query();

    if ($comunicado->publico === 'turma' && $comunicado->turma) {
        $alunosQuery->where('turma', $comunicado->turma);
    }

    if ($comunicado->publico === 'curso' && $comunicado->curso) {
        $alunosQuery->where('curso', $comunicado->curso);
    }

    $alunos = $alunosQuery
        ->with(['leituras' => function ($q) use ($comunicado) {
            $q->where('comunicado_id', $comunicado->id);
        }])
        ->orderBy('nome')
        ->get();

    return view('admin.comunicados.turma', compact(
        'comunicado',
        'alunos'
    ));
}


}

