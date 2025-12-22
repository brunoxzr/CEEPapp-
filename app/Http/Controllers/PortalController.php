<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        return view('index', compact('news'));
    }
}
