<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Response;

class SitemapPremiosController extends Controller
{
    public function index()
    {
        $premios = Premio::where('ativo', true)->get();

        return response()
            ->view('sitemaps.premios', compact('premios'))
            ->header('Content-Type', 'application/xml');
    }
}
