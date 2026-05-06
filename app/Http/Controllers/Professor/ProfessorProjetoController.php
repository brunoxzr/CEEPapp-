<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProfessorProjetoController extends Controller
{
    private function professor()
    {
        $admin = \App\Models\Admin::find(session('admin_id'));
        if (!$admin || $admin->role !== 'professor') {
            abort(403);
        }
        return $admin;
    }

    // LISTA
    public function index()
    {
        $professor = $this->professor();

        $projetos = Projeto::where('professor_id', $professor->id)
            ->orderByDesc('created_at')
            ->get();

        return view('admin.professor.projetos.index', compact('projetos'));
    }

    // FORM CREATE
    public function create()
    {
        $this->professor();
        return view('admin.professor.projetos.create');
    }

    // STORE
    public function store(Request $request)
    {
        $professor = $this->professor();

        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
            'curso'     => 'required|string|max:100',
            'capa'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            $data['capa'] = $request->file('capa')->store('projetos', 'public');
        }

        $data['professor_id'] = $professor->id;
        $data['status'] = 'rascunho';
        $data['slug'] = \Illuminate\Support\Str::slug($data['titulo']);
        $data['area'] = $request->input('area', $request->input('curso', '')); // Preenche area com curso ou vazio

        Projeto::create($data);

        return redirect()->route('professor.projetos.index')
            ->with('ok', 'Projeto criado com sucesso.');
    }

    // EDIT
    public function edit($id)
    {
        $professor = $this->professor();

        $projeto = Projeto::where('id', $id)
            ->where('professor_id', $professor->id)
            ->firstOrFail();

        return view('admin.professor.projetos.edit', compact('projeto'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $professor = $this->professor();

        $projeto = Projeto::where('id', $id)
            ->where('professor_id', $professor->id)
            ->firstOrFail();

        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
            'curso'     => 'required|string|max:100',
            'status'    => 'required|in:rascunho,publicado',
        ]);

        $projeto->update($data);

        return back()->with('ok', 'Projeto atualizado.');
    }
}
