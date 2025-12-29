<?php
namespace App\Http\Controllers;
use App\Models\Cronograma;
use Illuminate\Support\Carbon;

class ProfessorController extends Controller
{
public function dashboardProfessor()
{
    $professor = auth()->user(); // admin logado
    if ($professor->role !== 'professor') {
        abort(403);
    }

    $diaHoje = match (Carbon::now()->dayOfWeek) {
        1 => 'Segunda',
        2 => 'Terça',
        3 => 'Quarta',
        4 => 'Quinta',
        5 => 'Sexta',
        default => null,
    };

    $aulasHoje = Cronograma::where('professor', $professor->nome)
        ->where('dia_semana', $diaHoje)
        ->orderBy('inicio')
        ->get();

    return view('professor.dashboard', compact(
        'professor',
        'aulasHoje',
        'diaHoje'
    ));
}
public function cronogramaProfessor()
{
    $professor = auth()->user();
    if ($professor->role !== 'professor') {
        abort(403);
    }

    $cronograma = Cronograma::where('professor', $professor->nome)
        ->orderByRaw("
            CASE dia_semana
                WHEN 'Segunda' THEN 1
                WHEN 'Terça' THEN 2
                WHEN 'Quarta' THEN 3
                WHEN 'Quinta' THEN 4
                WHEN 'Sexta' THEN 5
                ELSE 6
            END
        ")
        ->orderBy('inicio')
        ->get();

    return view('professor.cronograma', compact('professor', 'cronograma'));
}

}
