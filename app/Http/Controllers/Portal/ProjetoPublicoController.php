<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoPublicoController extends Controller
{
    // LISTAGEM PÚBLICA
 public function index()
{
    $projetos = Projeto::where('status', 'publicado')
        ->orderByDesc('created_at')
        ->get();

    return view('projetos.index', compact('projetos'));
}

    // DETALHE DO PROJETO
    public function show($id)
    {
        $projeto = Projeto::where('id', $id)
            ->where('status', 'publicado')
            ->with(['professor', 'contribuicoes.aluno'])
            ->firstOrFail();

        return view('projetos.show', compact('projeto'));
    }
}
