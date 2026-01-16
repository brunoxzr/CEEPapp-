<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlunoPerfil;

class AlunoPublicController extends Controller
{
    public function show($slug)
    {
        $perfil = AlunoPerfil::whereHas('aluno', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })
        ->where('publico', true)
        ->with('aluno')
        ->firstOrFail();

        return view('aluno.public', compact('perfil'));
    }
}

