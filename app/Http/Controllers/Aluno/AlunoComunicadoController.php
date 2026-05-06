<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
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
                         ->whereJsonContains('turmas', $aluno->turma);
                  });
            })
            ->with(['leituras' => function ($q) use ($aluno) {
                $q->where('aluno_id', $aluno->id);
            }])
            ->orderByDesc('created_at')
            ->get();

        return view('aluno.comunicados.index', compact('comunicados'));
    }
}
