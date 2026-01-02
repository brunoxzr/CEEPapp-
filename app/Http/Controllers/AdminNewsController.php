<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\News;

class AdminNewsController extends Controller
{
    /* =========================
     * LISTAGEM
     * ========================= */
public function index()
{
    $news = News::orderBy('published_at', 'desc')->paginate(12);

    return view('admin.news.index', compact('news'));
}


    /* =========================
     * CREATE
     * ========================= */
    public function create()
    {
        return view('admin.news.create');
    }

    /* =========================
     * STORE
     * ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:news,slug',
            'author'  => 'nullable|string|max:255',
            'content' => 'required',
            'cover'   => 'nullable|image|max:4096',
            'hero'    => 'nullable|image|max:4096',
        ]);

        $coverPath = null;
        $heroPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('news/covers', 'public');
        }

        if ($request->hasFile('hero')) {
            $heroPath = $request->file('hero')->store('news/heroes', 'public');
        }

        News::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->slug),
            'author'       => $request->author ?? 'CEEP Assaí',
            'content'      => $request->content, // HTML DO QUILL
            'cover_path'   => $coverPath,
            'hero_path'    => $heroPath,
            'published_at' => now(),
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia publicada com sucesso!');
    }

    /* =========================
     * EDIT
     * ========================= */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /* =========================
     * UPDATE
     * ========================= */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'required|string|max:255|unique:news,slug,' . $news->id,
            'author'  => 'nullable|string|max:255',
            'content' => 'required',
            'cover'   => 'nullable|image|max:4096',
            'hero'    => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('cover')) {
            if ($news->cover_path) {
                Storage::disk('public')->delete($news->cover_path);
            }
            $news->cover_path = $request->file('cover')->store('news/covers', 'public');
        }

        if ($request->hasFile('hero')) {
            if ($news->hero_path) {
                Storage::disk('public')->delete($news->hero_path);
            }
            $news->hero_path = $request->file('hero')->store('news/heroes', 'public');
        }

        $news->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->slug),
            'author'  => $request->author ?? 'CEEP Assaí',
            'content' => $request->content,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia atualizada com sucesso!');
    }

    /* =========================
     * DELETE
     * ========================= */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->cover_path) {
            Storage::disk('public')->delete($news->cover_path);
        }

        if ($news->hero_path) {
            Storage::disk('public')->delete($news->hero_path);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia excluída com sucesso.');
    }

    /* =========================
     * UPLOAD DE IMAGEM (QUILL)
     * ========================= */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096'
        ]);

        $path = $request->file('image')->store('news/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}
