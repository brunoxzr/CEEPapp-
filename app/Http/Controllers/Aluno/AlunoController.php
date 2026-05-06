<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use Illuminate\Support\Carbon;
use App\Models\Comunicado;
use App\Models\CalendarioInstitucional;
use App\Models\PresidenteTurma;
use App\Models\ChamadaTurma;
use Illuminate\Http\Request;
// ...


class AlunoController extends Controller
{
    private function requirePresidenteTurma()
{
    $aluno = $this->requireAluno();

    $isPresidente = PresidenteTurma::where('aluno_id', $aluno->id)
        ->where('turma', $aluno->turma)
        ->where('ativo', true)
        ->exists();

    if (!$isPresidente) {
        abort(403, 'Você não é presidente desta turma.');
    }

    return $aluno;
}
    /**
     * Garante que o usuário é aluno autenticado
     */
    private function requireAluno()
    {
        if (!session('aluno_id')) {
            abort(403, 'Não autenticado como aluno.');
        }

        return Aluno::findOrFail(session('aluno_id'));
    }

    /**
     * ================= DASHBOARD =================
     */
public function dashboard()
{
    $aluno = $this->requireAluno();

    /* ================= REGRA: EGRESSO ================= */
    if ($aluno->turma === 'Egresso') {
        return redirect()->route('egresso.dashboard');
    }

    /* ================= BOLETINS ================= */
    $boletins = Boletim::where('aluno_id', $aluno->id)
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

    /* ================= CRONOGRAMA (HOJE) ================= */
    $cronograma = Cronograma::where('turma', $aluno->turma)
        ->where('dia_semana', now()->locale('pt_BR')->dayName)
        ->orderBy('inicio')
        ->get();

    /* ================= COMUNICADOS (EXIBIÇÃO) ================= */
$ultimosComunicados = Comunicado::where('ativo', true)
    ->where(function ($q) use ($aluno) {
        $q->where('publico', 'geral')
          ->orWhere(function ($q2) use ($aluno) {
              $q2->where('publico', 'turma')
                 ->whereJsonContains('turmas', $aluno->turma);
          });
    })
    ->with(['leituras' => function ($q) use ($aluno) {
        $q->where('aluno_id', $aluno->id);
    }])
    ->orderByDesc('created_at')
    ->take(3)
    ->get();


    /* ================= COMUNICADOS NÃO LIDOS ================= */
$comunicadosNaoLidos = Comunicado::where('ativo', true)
    ->where(function ($q) use ($aluno) {
        $q->where('publico', 'geral')
          ->orWhere(function ($q2) use ($aluno) {
              $q2->where('publico', 'turma')
                 ->whereJsonContains('turmas', $aluno->turma);
          });
    })
    ->whereDoesntHave('leituras', function ($q) use ($aluno) {
        $q->where('aluno_id', $aluno->id);
    })
    ->count();


    /* ================= EVENTOS (10 DIAS) ================= */
    $eventosProximos = CalendarioInstitucional::where('ativo', true)
        ->whereIn('publico', ['alunos', 'todos'])
        ->whereBetween('data', [
            now()->startOfDay(),
            now()->addDays(10)->endOfDay()
        ])
        ->orderBy('data')
        ->orderBy('hora_inicio')
        ->get();

    /* ================= CONTADOR GERAL ================= */
    $comunicadosCount = $comunicadosNaoLidos + $eventosProximos->count();

    return view('aluno.dashboard', compact(
        'aluno',
        'boletins',
        'cronograma',
        'ultimosComunicados',
        'eventosProximos',
        'comunicadosCount'
    ));
}

    /**
     * ================= CRONOGRAMA SEMANAL =================
     */
    public function cronograma()
    {
        $aluno = $this->requireAluno();

        $cronograma = Cronograma::where('turma', $aluno->turma)
            ->orderByRaw("
                CASE dia_semana
                    WHEN 'Segunda' THEN 1
                    WHEN 'Terça'   THEN 2
                    WHEN 'Quarta'  THEN 3
                    WHEN 'Quinta'  THEN 4
                    WHEN 'Sexta'   THEN 5
                    ELSE 6
                END
            ")
            ->orderBy('inicio')
            ->get();

        return view('aluno.cronograma', compact(
            'aluno',
            'cronograma'
        ));
    }

    /**
     * ================= BOLETIM =================
     */
    public function boletim()
    {
        $aluno = $this->requireAluno();

        $boletins = Boletim::where('aluno_id', $aluno->id)
            ->orderBy('disciplina')
            ->orderByDesc('ano')
            ->get();

        return view('aluno.boletim', compact('aluno', 'boletins'));
    }

    /**
     * ================= SAEB =================
     */
    public function saeb()
    {
        $aluno = $this->requireAluno();

        $resultados = SaebResultado::where('aluno_id', $aluno->id)
            ->orderByDesc('ano')
            ->orderByDesc('created_at')
            ->get();

        return view('aluno.saeb', compact('aluno', 'resultados'));
    }
    public function chamadaTurma()
{
    $aluno = $this->requirePresidenteTurma();

    $alunosTurma = Aluno::where('turma', $aluno->turma)
        ->orderBy('nome')
        ->get();

    $chamadas = ChamadaTurma::where('turma', $aluno->turma)
        ->withCount([
            'alunos as presentes_count' => function ($q) {
                $q->where('presente', true);
            },
            'alunos as ausentes_count' => function ($q) {
                $q->where('presente', false);
            },
        ])
        ->orderByDesc('data')
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

    return view('aluno.presidente.chamada', compact(
        'aluno',
        'alunosTurma',
        'chamadas'
    ));
}
public function chamadaTurmaStore(Request $request)
{
    $aluno = $this->requirePresidenteTurma();

    $data = $request->validate([
        'data' => 'required|date',
        'aula' => 'nullable|string|max:50',
        'observacao' => 'nullable|string|max:1000',
        'presentes' => 'nullable|array',
        'presentes.*' => 'integer|exists:alunos,id',
    ]);

    $alunosDaTurma = Aluno::where('turma', $aluno->turma)->pluck('id');

    $presentes = collect($data['presentes'] ?? [])
        ->map(fn ($id) => (int) $id)
        ->filter(fn ($id) => $alunosDaTurma->contains($id))
        ->values();

    $chamada = ChamadaTurma::create([
        'turma' => $aluno->turma,
        'data' => $data['data'],
        'aula' => $data['aula'] ?? null,
        'observacao' => $data['observacao'] ?? null,
        'presidente_id' => $aluno->id,
    ]);

    $sync = [];

    foreach ($alunosDaTurma as $alunoId) {
        $sync[$alunoId] = [
            'presente' => $presentes->contains($alunoId),
        ];
    }

    $chamada->alunos()->sync($sync);

    return redirect()
        ->route('aluno.presidente.chamada')
        ->with('ok', 'Chamada enviada com sucesso.');
}
}
