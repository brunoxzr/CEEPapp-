<?php

namespace App\Http\Controllers;

use App\Models\AlunoPerfil;

class SitemapAlunosController extends Controller
{
    public function index()
    {
        $alunos = AlunoPerfil::query()
            ->where('publico', true)
            ->whereNotNull('aluno_id')
            ->whereHas('aluno', function ($q) {
                $q->whereNotNull('slug');
            })
            ->with('aluno')
            ->get();

        return response(
            view('sitemaps.alunos', compact('alunos'))->render(),
            200,
            ['Content-Type' => 'application/xml']
        );
    }
}
