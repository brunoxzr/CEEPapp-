<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use Illuminate\Support\Carbon;
use App\Models\Comunicado;

// ...


class AlunoController extends Controller
{
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

    // ================= NOTAS =================
    $boletins = Boletim::where('aluno_id', $aluno->id)
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

    // ================= CRONOGRAMA (HOJE) =================
    $diaHoje = ucfirst(
        Carbon::now()->locale('pt_BR')->dayName
    );

    $cronograma = Cronograma::where('turma', $aluno->turma)
        ->where('dia_semana', $diaHoje)
        ->orderBy('inicio')
        ->get();

    // ================= SAEB =================
    $saeb = SaebResultado::where('aluno_id', $aluno->id)
        ->orderByDesc('ano')
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

    // ================= COMUNICADOS =================
    $comunicados = Comunicado::where('ativo', true)
        ->where(function ($q) use ($aluno) {
            $q->where('publico', 'geral')
              ->orWhere(function ($q2) use ($aluno) {
                  $q2->where('publico', 'turma')
                     ->where('turma', $aluno->turma);
              });
        })
        ->orderByDesc('created_at')
        ->get();

    $comunicadosCount = $comunicados->count();
    $ultimosComunicados = $comunicados->take(3);

    // ================= VIEW =================
    return view('aluno.dashboard', compact(
        'aluno',
        'boletins',
        'cronograma',
        'saeb',
        'comunicadosCount',
        'ultimosComunicados'
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
}
