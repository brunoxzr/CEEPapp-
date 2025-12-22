<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::orderByDesc('created_at')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required',
            'cover'        => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('news/covers', 'public');
        }

        News::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'excerpt'      => $this->makeExcerpt($request->content),
            'content'      => $request->content,
            'cover_path'   => $coverPath,
            'is_active'    => $request->boolean('is_active'),
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia criada com sucesso.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required',
            'cover'        => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover')) {
            if ($news->cover_path) {
                Storage::disk('public')->delete($news->cover_path);
            }

            $news->cover_path = $request->file('cover')->store('news/covers', 'public');
        }

        $news->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'excerpt'      => $this->makeExcerpt($request->content),
            'content'      => $request->content,
            'is_active'    => $request->boolean('is_active'),
            'published_at' => $request->published_at,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->cover_path) {
            Storage::disk('public')->delete($news->cover_path);
        }

        $news->delete();

        return back()->with('success', 'Notícia removida.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096',
        ]);

        $path = $request->file('image')->store('news/editor', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    /**
     * Gera resumo limpo do conteúdo HTML
     */
    private function makeExcerpt(string $content, int $limit = 180): string
    {
        $text = trim(strip_tags($content));

        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        return mb_substr($text, 0, $limit) . '…';
    }
}
