<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;

class ComunicadoController extends Controller
{
    /* ================= ADMIN ================= */

public function indexAdmin()
    {
        $comunicados = Comunicado::orderByDesc('created_at')->get();
        return view('admin.comunicados.index', compact('comunicados'));
    }

    public function edit($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        return view('admin.comunicados.edit', compact('comunicado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required',
            'publico' => 'required',
        ]);

        $comunicado = Comunicado::findOrFail($id);

        $comunicado->update([
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'publico'  => $request->publico,
            'turma'    => $request->turma,
        ]);

        return redirect()
            ->route('admin.comunicados.index')
            ->with('ok', 'Comunicado atualizado com sucesso.');
    }

    public function destroy($id)
    {
        Comunicado::findOrFail($id)->delete();

        return redirect()
            ->route('admin.comunicados.index')
            ->with('ok', 'Comunicado excluído com sucesso.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'   => 'required|string|max:200',
            'conteudo' => 'required|string',
            'publico'  => 'required|in:geral,turma,curso',
            'turma'    => 'nullable|string|max:50',
            'curso'    => 'nullable|string|max:50',
            'ativo'    => 'nullable|boolean',
        ]);

        $data['criado_por'] = session('admin_id');
        $data['ativo'] = $request->boolean('ativo', true);

        Comunicado::create($data);

        return redirect()
            ->route('admin.comunicados.index')
            ->with('ok', 'Comunicado publicado com sucesso.');
    }

    /* ================= ALUNO ================= */

public function indexAluno()
{
    // 🔐 pega aluno pela session (igual o resto do sistema)
    $aluno = \App\Models\Aluno::findOrFail(session('aluno_id'));

    $comunicados = \App\Models\Comunicado::where('ativo', true)
        ->where(function ($q) use ($aluno) {

            // público geral
            $q->where('publico', 'geral')

            // público por turma
            ->orWhere(function ($q) use ($aluno) {
                $q->where('publico', 'turma')
                  ->where('turma', $aluno->turma);
            });

        })
        ->orderByDesc('created_at')
        ->get();

    return view('aluno.comunicados.index', compact('comunicados', 'aluno'));
}

}

