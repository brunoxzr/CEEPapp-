<?php

namespace App\Http\Controllers;

use App\Models\InstitucionalPessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalAdminController extends Controller
{
    public function index()
    {
        $pessoas = InstitucionalPessoa::orderBy('nivel')
            ->orderBy('nome')
            ->paginate(20);

        return view('admin.institucional.index', compact('pessoas'));
    }

    public function create()
    {
        return view('admin.institucional.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'  => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'area'  => 'nullable|string|max:255',
            'nivel' => 'required|integer|min:1|max:5',
            'foto'  => 'nullable|image|max:2048',
            'ativo' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('institucional', 'public');
        }

        InstitucionalPessoa::create($data);

        return redirect()
            ->route('admin.institucional.index')
            ->with('success', 'Pessoa cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $pessoa = InstitucionalPessoa::findOrFail($id);
        return view('admin.institucional.edit', compact('pessoa'));
    }

    public function update(Request $request, $id)
    {
        $pessoa = InstitucionalPessoa::findOrFail($id);

        $data = $request->validate([
            'nome'  => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'area'  => 'nullable|string|max:255',
            'nivel' => 'required|integer|min:1|max:5',
            'foto'  => 'nullable|image|max:2048',
            'ativo' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($pessoa->foto) {
                Storage::disk('public')->delete($pessoa->foto);
            }
            $data['foto'] = $request->file('foto')->store('institucional', 'public');
        }

        $pessoa->update($data);

        return redirect()
            ->route('admin.institucional.index')
            ->with('success', 'Pessoa atualizada.');
    }

    public function destroy($id)
    {
        $pessoa = InstitucionalPessoa::findOrFail($id);

        if ($pessoa->foto) {
            Storage::disk('public')->delete($pessoa->foto);
        }

        $pessoa->delete();

        return back()->with('success', 'Pessoa removida.');
    }
}
