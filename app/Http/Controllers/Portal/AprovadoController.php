<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Aprovado;

class AprovadoController extends Controller
{
    public function index()
    {
        $aprovados = Aprovado::where('ativo', true)
            ->orderByDesc('created_at')
            ->get();

        return view('portal.aprovados.index', compact('aprovados'));
    }
}

