<?php

namespace App\Http\Controllers;

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
