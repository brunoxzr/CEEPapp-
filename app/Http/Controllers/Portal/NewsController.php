<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $query = News::query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(12)->withQueryString();

        return view('news.index', compact('news', 'search'));
    }

public function show($slug)
{
    $news = News::where('slug', $slug)->firstOrFail();

    $recentNews = News::where('id', '!=', $news->id)
        ->orderByDesc('published_at')
        ->limit(6)
        ->get();

    return view('news.show', compact('news', 'recentNews'));
}

}
