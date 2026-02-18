<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Disciplina;
use App\Models\Atividade;
use App\Models\Aluno;
use Illuminate\Support\Facades\DB;
use App\Models\Cronograma;
use App\Mail\NovaAtividadeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AtividadeCorrigidaMail;

class ProfessorAtividadeController extends Controller
{
    /**
     * TELA 1 — MATÉRIAS + TURMAS DO PROFESSOR
     */
public function materias()
{
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    /**
     * 🔥 FONTE DA VERDADE: CRONOGRAMA
     * pega disciplina + turma reais
     */
    $vinculos = Cronograma::where('professor', $professor->nome)
        ->select('disciplina', 'turma')
        ->distinct()
        ->orderBy('disciplina')
        ->get();

    return view(
        'admin.professor.atividades.materias',
        compact('vinculos')
    );
}

    /**
     * TELA 2 — ATIVIDADES DA DISCIPLINA + TURMA
     */
public function atividadesDisciplina($disciplinaId)
{
    // professor autenticado
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    $disciplina = Disciplina::findOrFail($disciplinaId);

    /**
     * 🔥 BUSCA AS TURMAS PELO CRONOGRAMA
     * (fonte da verdade do sistema)
     */
    $turmas = Cronograma::where('professor', $professor->nome)
        ->where('disciplina', $disciplina->nome)
        ->pluck('turma')
        ->unique();

    if ($turmas->isEmpty()) {
        abort(403);
    }

    /**
     * ATIVIDADES DA DISCIPLINA
     */
$atividades = Atividade::where('professor_id', $professor->id)
    ->where('disciplina_id', $disciplina->id)
    ->whereIn('turma', $turmas)
    ->orderByDesc('created_at')
    ->get();


    return view(
        'admin.professor.atividades.atividades',
        compact('disciplina', 'atividades', 'turmas')
    );
}

/**
 * TELA — CRIAR NOVA ATIVIDADE
 */
public function create($disciplinaId)
{
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    $disciplina = Disciplina::findOrFail($disciplinaId);

    // turmas reais do professor nessa disciplina (cronograma é a verdade)
    $turmas = Cronograma::where('professor', $professor->nome)
        ->where('disciplina', $disciplina->nome)
        ->pluck('turma')
        ->unique()
        ->values();

    if ($turmas->isEmpty()) {
        abort(403, 'Professor não possui turmas nesta disciplina.');
    }

    return view(
        'admin.professor.atividades.create',
        compact('disciplina', 'turmas')
    );
}

/**
 * STORE — SALVAR NOVA ATIVIDADE
 */
public function store(Request $request, $disciplinaId)
{
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    $disciplina = Disciplina::findOrFail($disciplinaId);

    $data = $request->validate([
        'titulo'        => 'required|string|max:150',
        'descricao'     => 'nullable|string',
        'turma'         => 'required|string|max:50',
        'data_limite'   => 'nullable|date',
        'tipo'          => 'required|in:atividade,chamada',
    ]);

    $atividade = Atividade::create([
        'professor_id'   => $professor->id,
        'disciplina_id'  => $disciplina->id,
        'titulo'         => $data['titulo'],
        'descricao'      => $data['descricao'] ?? null,
        'turma'          => $data['turma'],
        'data_limite'    => $data['data_limite'] ?? null,
        'tipo'           => $data['tipo'],
        'visivel_aluno'  => $request->has('visivel_aluno'),
    ]);

    /**
     * 🔥 ENVIA EMAIL SE:
     * - for atividade
     * - estiver visível para aluno
     */
    if ($atividade->tipo === 'atividade' && $atividade->visivel_aluno) {

        $emails = Aluno::where('turma', $atividade->turma)
            ->whereNotNull('email')
            ->pluck('email');

        foreach ($emails as $email) {
            Mail::to($email)
                ->send(new NovaAtividadeMail($atividade)); // use send pra testar
        }
    }

    return redirect()
        ->route('professor.atividades.disciplina', $disciplina->id)
        ->with('success', 'Atividade criada com sucesso.');
}


/**
 * TELA — EDITAR ATIVIDADE
 */
public function edit($disciplinaId, Atividade $atividade)
{
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    // segurança: atividade pertence ao professor
    if ($atividade->professor_id !== $professor->id) {
        abort(403);
    }

    $disciplina = Disciplina::findOrFail($disciplinaId);

    // turmas que ele dá essa disciplina (cronograma é a verdade)
    $turmas = Cronograma::where('professor', $professor->nome)
        ->where('disciplina', $disciplina->nome)
        ->pluck('turma')
        ->unique();

    return view(
        'admin.professor.atividades.edit',
        compact('atividade', 'disciplina', 'turmas')
    );
}


    /**
     * TELA 3 — LANÇAMENTO POR ALUNO
     */
public function lancar(Atividade $atividade)
{
    $professorId = session('admin_id');

    if ($atividade->professor_id !== $professorId) {
        abort(403);
    }

    $alunos = Aluno::where('turma', $atividade->turma)
        ->orderBy('nome')
        ->get();

    $lancamentos = \App\Models\AtividadeAluno::where('atividade_id', $atividade->id)
        ->get()
        ->keyBy('aluno_id');

    return view('admin.professor.atividades.lancar', compact(
        'atividade',
        'alunos',
        'lancamentos'
    ));
}


/**
 * ATUALIZAR ATIVIDADE
 */
public function update(Request $request, $disciplinaId, Atividade $atividade)
{
    $professor = Admin::find(session('admin_id'));

    if (!$professor || $atividade->professor_id !== $professor->id) {
        abort(403);
    }

    $data = $request->validate([
        'titulo'        => 'required|string|max:255',
        'descricao'     => 'nullable|string',
        'turma'         => 'required|string|max:50',
        'data_limite'   => 'nullable|date',
        'tipo'          => 'required|in:atividade,chamada',
    ]);

    $atividade->update([
        'titulo'        => $data['titulo'],
        'descricao'     => $data['descricao'] ?? null,
        'turma'         => $data['turma'],
        'data_limite'   => $data['data_limite'] ?? null,
        'tipo'          => $data['tipo'],
        'visivel_aluno' => $request->has('visivel_aluno'),
    ]);

    return redirect()
        ->route('professor.atividades.disciplina', $disciplinaId)
        ->with('success', 'Atividade atualizada com sucesso.');
}

public function destroy($disciplinaId, Atividade $atividade)
{
    $professor = Admin::find(session('admin_id'));
    if (!$professor || $professor->role !== 'professor') {
        abort(403);
    }

    // garante que a atividade é do professor logado
    if ((int)$atividade->professor_id !== (int)$professor->id) {
        abort(403);
    }

    // garante que bate com a disciplina da URL (evita apagar coisa errada)
    if ((int)$atividade->disciplina_id !== (int)$disciplinaId) {
        abort(403);
    }

    $atividade->delete();

    return redirect()
        ->route('professor.atividades.disciplina', $disciplinaId)
        ->with('success', 'Atividade removida com sucesso.');
}

    /**
     * SALVAR CHECKLIST
     */


public function salvarLancamento(Request $request, Atividade $atividade)
{
    $professorId = session('admin_id');

    if ($atividade->professor_id !== $professorId) {
        abort(403);
    }

    $alunos = Aluno::where('turma', $atividade->turma)->get();

    foreach ($alunos as $aluno) {

        // 🔥 SE FOR CHAMADA
        if ($atividade->tipo === 'chamada') {

            $statusNovo = isset($request->presenca[$aluno->id])
                ? 'presente'
                : 'ausente';

        } else {

            // 🔥 SE FOR ATIVIDADE NORMAL
            $statusNovo = $request->status[$aluno->id] ?? 'pendente';

        }

        \App\Models\AtividadeAluno::updateOrCreate(
            [
                'atividade_id' => $atividade->id,
                'aluno_id'     => $aluno->id,
            ],
            [
                'status'       => $statusNovo,
                'nota'         => $request->nota[$aluno->id] ?? null,
                'feedback'     => $request->feedback[$aluno->id] ?? null,
                'corrigido_em' => $statusNovo === 'corrigido' ? now() : null,
            ]
        );
    }

    return back()->with('success', 'Dados salvos com sucesso.');
}



}
