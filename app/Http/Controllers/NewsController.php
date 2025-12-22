<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $news = News::query()
            ->whereNotNull('published_at')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'ILIKE', "%{$search}%")
                      ->orWhere('excerpt', 'ILIKE', "%{$search}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('news.index', compact('news', 'search'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('news.show', compact('news'));
    }
}
