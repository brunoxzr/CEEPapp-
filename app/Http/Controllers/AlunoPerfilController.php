<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Aluno;

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

        if (!$alunoId) {
            return redirect()->route('login.unificado');
        }

        $aluno = Aluno::findOrFail($alunoId);

        // ===============================
        // VALIDAÇÃO
        // ===============================
        $data = $request->validate([
            'foto'      => 'nullable|image|max:2048',
            'linkedin'  => 'nullable|url',
            'github'    => 'nullable|url',
            'portfolio' => 'nullable|url',
            'bio'       => 'nullable|string|max:500',
            'curso'     => 'required|string',
            'ano'       => 'required|string',
        ]);

        // ===============================
        // UPLOAD DA FOTO
        // ===============================
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perfis', 'public');
        }

        // ===============================
        // GERAR SLUG DO ALUNO (UMA VEZ)
        // ===============================
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

        // ===============================
        // SALVAR PERFIL
        // ===============================
        $aluno->perfil()->updateOrCreate(
            ['aluno_id' => $aluno->id],
            $data
        );

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
