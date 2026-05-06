<?php

namespace App\Http\Controllers\Portal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\News;
use Carbon\Carbon;

class NewsSitemapController extends Controller
{
    public function index()
    {
        // Google News só aceita notícias dos últimos 2 dias
        $news = News::whereNotNull('published_at')
            ->where('published_at', '>=', Carbon::now()->subDays(2))
            ->orderByDesc('published_at')
            ->limit(1000)
            ->get();

        $xml = view('sitemaps.news', compact('news'));

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}
