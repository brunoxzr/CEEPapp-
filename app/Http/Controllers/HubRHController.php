<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlunoPerfil;
class HubRHController extends Controller
{
    public function index(Request $request)
    {
        $perfis = AlunoPerfil::where('publico', true)
            ->when($request->curso, fn($q) => $q->where('curso', $request->curso))
            ->when($request->ano, fn($q) => $q->where('ano', $request->ano))
            ->with('aluno')
            ->get();

        return view('hub-rh.index', compact('perfis'));
    }
}

