<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        return response(
            view('sitemaps.index')->render(),
            200,
            ['Content-Type' => 'application/xml']
        );
    }
}
