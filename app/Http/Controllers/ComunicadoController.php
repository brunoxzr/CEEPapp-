<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Mail\ComunicadoMail;
use Illuminate\Support\Facades\Mail;

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
public function create()
{
    return view('admin.comunicados.create');
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

    // 🔥 ISSO é um MODEL, não string
    $comunicado = Comunicado::create($data);

    $alunosQuery = Aluno::whereNotNull('email');

    if ($comunicado->publico === 'turma') {
        $alunosQuery->where('turma', $comunicado->turma);
    }

    if ($comunicado->publico === 'curso') {
        $alunosQuery->where('curso', $comunicado->curso);
    }

    $emails = $alunosQuery->pluck('email');

foreach ($emails as $email) {
    Mail::to($email)->send(new ComunicadoMail($comunicado));

}


    return redirect()
        ->route('admin.comunicados.index')
        ->with('ok', 'Comunicado publicado e enviado por e-mail com sucesso.');
}

    /* ================= ALUNO ================= */

public function indexAluno()
{
    $aluno = \App\Models\Aluno::findOrFail(session('aluno_id'));

    /* ================= COMUNICADOS ================= */
    $comunicados = \App\Models\Comunicado::where('ativo', true)
        ->where(function ($q) use ($aluno) {
            $q->where('publico', 'geral')
              ->orWhere(function ($q) use ($aluno) {
                  $q->where('publico', 'turma')
                    ->where('turma', $aluno->turma);
              });
        })
        ->orderByDesc('created_at')
        ->get();

    /* ================= EVENTOS (10 DIAS) ================= */
    $eventosProximos = \App\Models\CalendarioInstitucional::where('ativo', true)
        ->whereIn('publico', ['alunos', 'todos'])
        ->whereBetween('data', [
            now()->startOfDay(),
            now()->addDays(10)->endOfDay()
        ])
        ->orderBy('data')
        ->orderBy('hora_inicio')
        ->get();

    return view('aluno.comunicados.index', compact(
        'aluno',
        'comunicados',
        'eventosProximos'
    ));
}

}

