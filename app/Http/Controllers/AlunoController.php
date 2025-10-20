<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use Illuminate\Support\Carbon;

class AlunoController extends Controller
{
    private function requireAluno()
    {
        if (!session('aluno_id')) {
            abort(403, 'Não autenticado como aluno.');
        }
        return Aluno::findOrFail(session('aluno_id'));
    }

    // Dashboard do aluno
    public function dashboard()
    {
        $aluno = $this->requireAluno();

        $boletins = Boletim::where('aluno_id', $aluno->id)
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $cronograma = Cronograma::where('data', Carbon::today()->toDateString())
            ->where('turma', $aluno->turma)
            ->orderBy('inicio')
            ->get();

        $saeb = SaebResultado::where('aluno_id', $aluno->id)
            ->orderByDesc('ano')
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        return view('aluno.dashboard', compact('aluno', 'boletins', 'cronograma', 'saeb'));
    }

    public function cronograma()
{
    if (!session('aluno_id')) abort(403);

    $aluno = Aluno::findOrFail(session('aluno_id'));

    $cronograma = Cronograma::where('turma', $aluno->turma)
        ->orderByRaw("CASE
            WHEN dia_semana = 'Segunda' THEN 1
            WHEN dia_semana = 'Terça' THEN 2
            WHEN dia_semana = 'Quarta' THEN 3
            WHEN dia_semana = 'Quinta' THEN 4
            WHEN dia_semana = 'Sexta' THEN 5
            ELSE 6 END")
        ->orderBy('inicio')
        ->get();

    return view('aluno.cronograma', compact('aluno', 'cronograma'));
}

    // Boletim completo
    public function boletim()
    {
        $aluno = $this->requireAluno();

        $boletins = Boletim::where('aluno_id', $aluno->id)
            ->orderBy('disciplina')
            ->orderBy('ano','desc')
            ->get();

        return view('aluno.boletim', compact('aluno', 'boletins'));
    }

    // Resultados SAEB
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
