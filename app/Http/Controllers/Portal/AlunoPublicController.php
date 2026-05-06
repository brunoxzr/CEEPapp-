<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
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
        ->with(['aluno.reconhecimentos'])
        ->first();

    if (!$perfil) {
        abort(404);
    }

    return view('aluno.public', compact('perfil'));
}

}
