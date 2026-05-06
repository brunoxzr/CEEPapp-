<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\InstitucionalPessoa;

class PortalController extends Controller
{
    public function index()
    {
$news = News::orderByDesc('published_at')->take(10)->get();

$featured = $news->first();
$secondary = $news->skip(1)->take(4);
$list = $news->skip(5);

   // 👇 NOVO: Institucional
    $direcao = InstitucionalPessoa::where('ativo', 1)
        ->where('nivel', 1)
        ->orderBy('ordem')
        ->orderBy('nome')
        ->get();

    // 🔥 DESENVOLVEDORES (nível 4)
    $desenvolvedores = InstitucionalPessoa::where('ativo', 1)
        ->where('nivel', 4)
        ->orderBy('ordem')
        ->orderBy('nome')
        ->get();

    return view('index', compact(
        'featured',
        'secondary',
        'list',
        'direcao',
        'desenvolvedores'
    ));

    }


public function institucional()
{
    $pessoas = InstitucionalPessoa::where('ativo', 1)
        ->orderBy('nivel')
        ->orderBy('ordem')
        ->orderBy('nome')
        ->get()
        ->groupBy('nivel');

    return view('portal.institucional', compact('pessoas'));
}

public function institucionalShow($slug)
{
    $pessoa = InstitucionalPessoa::where('slug', $slug)
        ->where('ativo', 1)
        ->firstOrFail();

    $recentes = InstitucionalPessoa::where('ativo', 1)
        ->where('id', '!=', $pessoa->id)
        ->orderBy('nivel')
        ->orderBy('ordem')
        ->orderBy('nome')
        ->take(6)
        ->get();

    return view('portal.institucional_show', compact('pessoa', 'recentes'));
}


}
