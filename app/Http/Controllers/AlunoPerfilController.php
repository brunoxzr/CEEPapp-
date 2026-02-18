<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Aluno;
use Illuminate\Support\Facades\Storage;

class AlunoPerfilController extends Controller
{
    /**
     * Exibir formulário do perfil do aluno
     */
    public function edit()
    {
        $alunoId = session('aluno_id');

        if (!$alunoId) {
            return redirect()->route('login.unificado');
        }

        $aluno = Aluno::with('perfil')->findOrFail($alunoId);
        $perfil = $aluno->perfil;

        return view('aluno.perfil', compact('perfil'));
    }

    /**
     * Salvar / atualizar perfil do aluno
     */
    public function update(Request $request)
{
    $alunoId = session('aluno_id');
    if (!$alunoId) return redirect()->route('login.unificado');

    $aluno = Aluno::with('perfil')->findOrFail($alunoId);

    $data = $request->validate([
        'foto'      => 'nullable|image|max:2048',
        'linkedin'  => 'nullable|url',
        'github'    => 'nullable|url',
        'portfolio' => 'nullable|url',
        'bio'       => 'nullable|string|max:2000',
        'curso'     => 'required|string',
        'ano'       => 'required|string',
        'remove_foto' => 'nullable' // pode deixar assim
    ]);

    // REMOVER FOTO
    if ($request->boolean('remove_foto')) {
        if ($aluno->perfil?->foto) {
            Storage::disk('public')->delete($aluno->perfil->foto);
        }
        $data['foto'] = null;
    }

    // UPLOAD NOVA FOTO (substitui)
    if ($request->hasFile('foto')) {
        if ($aluno->perfil?->foto) {
            Storage::disk('public')->delete($aluno->perfil->foto);
        }
        $data['foto'] = $request->file('foto')->store('perfis', 'public');
    }

    // SLUG
    if (empty($aluno->slug)) {
        $base = Str::slug($aluno->nome);
        $slug = $base;
        $i = 1;
        while (Aluno::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i;
            $i++;
        }
        $aluno->slug = $slug;
        $aluno->save();
    }

$aluno->perfil()->updateOrCreate(
    ['aluno_id' => $aluno->id],
    array_merge($data, ['publico' => true])
);


    return back()->with('success', 'Perfil atualizado com sucesso!');
}
public function removerFoto(Request $request)
{
    $alunoId = session('aluno_id');

    if (!$alunoId) {
        return redirect()->route('login.unificado');
    }

    $aluno = Aluno::with('perfil')->findOrFail($alunoId);

    if ($aluno->perfil && $aluno->perfil->foto) {

        // Remove arquivo físico
        Storage::disk('public')->delete($aluno->perfil->foto);

        // Limpa campo no banco
        $aluno->perfil->update([
            'foto' => null
        ]);
    }

    return back()->with('success', 'Foto removida com sucesso!');
}

}
