<?php
namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Comunicado;

class AlunoComunicadoController extends Controller
{
    public function index()
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
                         ->where('turma', $aluno->turma);
                  });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('aluno.comunicados.index', compact('comunicados'));
    }
}
