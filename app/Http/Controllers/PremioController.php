<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Request;

class PremioController extends Controller
{
    public function index()
    {
        $premios = Premio::where('ativo', true)
            ->orderByDesc('ano')
            ->get();

        return view('portal.premios', compact('premios'));
    }
    public function show(Premio $premio)
{
    $premio->load('alunos');

    return view('portal.premios.show', compact('premio'));
}
}
