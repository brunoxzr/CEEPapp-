<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Aluno;


class PremioAdminController extends Controller
{
    public function index()
    {
        $premios = Premio::latest()->get();
        return view('admin.premios.index', compact('premios'));
    }

    public function create()
    {
        return view('admin.premios.create');
    }

    // 🔥 ESTE MÉTODO ESTAVA FALTANDO
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
            'ano'       => 'nullable|digits:4',
            'imagem'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('premios', 'public');
        }

        Premio::create($data);

        return redirect()
            ->route('admin.premios.index')
            ->with('success', 'Prêmio cadastrado com sucesso.');
    }
    public function edit(Premio $premio)
{
    $alunos = Aluno::orderBy('nome')->get();

    return view('admin.premios.edit', compact('premio', 'alunos'));
}
public function update(Request $request, Premio $premio)
{
    $data = $request->validate([
        'titulo'    => 'required|string|max:255',
        'descricao' => 'required|string',
        'ano'       => 'nullable|digits:4',
        'imagem'    => 'nullable|image|max:2048',
        'alunos'    => 'array'
    ]);

    if ($request->hasFile('imagem')) {
        $data['imagem'] = $request->file('imagem')->store('premios', 'public');
    }

    $premio->update($data);

    // 🔗 sincroniza alunos participantes
    $premio->alunos()->sync($request->alunos ?? []);

    return redirect()
        ->route('admin.premios.index')
        ->with('success', 'Prêmio atualizado com sucesso.');
}

}
