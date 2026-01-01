<?php

namespace App\Http\Controllers;

use App\Models\CalendarioInstitucional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarioController extends Controller
{
    /* =====================================================
     | ADMIN
     |=====================================================*/

    private function requireAdmin()
    {
        if (!session('admin_id')) {
            abort(403, 'Acesso restrito.');
        }
    }

    // 📋 LISTAGEM ADMIN
public function indexAdmin(Request $request)
{
    $this->requireAdmin();

    $mes = $request->get('mes', now()->month);
    $ano = $request->get('ano', now()->year);

    $inicioMes = Carbon::create($ano, $mes, 1)->startOfMonth();
    $fimMes    = $inicioMes->copy()->endOfMonth();

    $eventos = CalendarioInstitucional::whereBetween('data', [$inicioMes, $fimMes])
        ->orderBy('data')
        ->orderBy('hora_inicio')
        ->get()
        ->groupBy(fn ($e) => $e->data->format('Y-m-d'));

    return view('admin.calendario.index', [
        'eventos'    => $eventos,
        'mes'        => $mes,
        'ano'        => $ano,
        'inicioMes'  => $inicioMes
    ]);
}

    // ➕ FORM CREATE
    public function create()
    {
        $this->requireAdmin();
        return view('admin.calendario.create');
    }

    // 💾 STORE
    public function store(Request $request)
{
    $this->requireAdmin();

    $data = $request->validate([
        'titulo'       => 'required|string|max:150',
        'descricao'    => 'nullable|string',
        'data'         => 'required|date',
        'hora_inicio'  => 'nullable|date_format:H:i',
        'hora_fim'     => 'nullable|date_format:H:i',
        'tipo'         => 'required|string|max:50',
        'publico'      => 'required|in:alunos,professores,todos',
        'ativo'        => 'nullable',
    ]);

    // ✅ conversão correta
    $data['ativo'] = $request->has('ativo');

    CalendarioInstitucional::create($data);

    return redirect()
        ->route('admin.calendario.index')
        ->with('ok', 'Evento adicionado ao calendário institucional.');
}

    // ✏️ FORM EDIT
    public function edit($id)
    {
        $this->requireAdmin();

        $evento = CalendarioInstitucional::findOrFail($id);

        return view('admin.calendario.edit', compact('evento'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $this->requireAdmin();

        $evento = CalendarioInstitucional::findOrFail($id);

        $data = $request->validate([
            'titulo'       => 'required|string|max:150',
            'descricao'    => 'nullable|string',
            'data'         => 'required|date',
            'hora_inicio'  => 'nullable|date_format:H:i',
            'hora_fim'     => 'nullable|date_format:H:i',
            'tipo'         => 'required|string|max:50',
            'publico'      => 'required|in:alunos,professores,todos',
            'ativo'        => 'nullable|boolean',
        ]);

        $data['ativo'] = $request->boolean('ativo', true);

        $evento->update($data);

        return redirect()
            ->route('admin.calendario.index')
            ->with('ok', 'Evento atualizado com sucesso.');
    }

    // 🗑️ DELETE
    public function destroy($id)
    {
        $this->requireAdmin();

        CalendarioInstitucional::findOrFail($id)->delete();

        return back()->with('ok', 'Evento removido do calendário.');
    }

    /* =====================================================
     | ALUNO
     |=====================================================*/

    private function requireAluno()
    {
        if (!session('aluno_id')) {
            abort(403, 'Não autenticado como aluno.');
        }
    }

    // 📅 LISTAGEM PARA ALUNO
    public function indexAluno(Request $request)
{
    $this->requireAluno();

    $mes = $request->get('mes', now()->month);
    $ano = $request->get('ano', now()->year);
    $tipo = $request->get('tipo');

    $query = CalendarioInstitucional::where('ativo', true)
        ->whereIn('publico', ['alunos', 'todos'])
        ->whereMonth('data', $mes)
        ->whereYear('data', $ano);

    if ($tipo) {
        $query->where('tipo', $tipo);
    }

    $eventos = $query
        ->orderBy('data')
        ->orderBy('hora_inicio')
        ->get()
        ->groupBy(fn ($e) => $e->data->format('Y-m-d'));

    return view('aluno.calendario.index', [
        'eventos' => $eventos,
        'mes'     => $mes,
        'ano'     => $ano,
        'tipo'    => $tipo,
        'inicioMes' => \Carbon\Carbon::create($ano, $mes, 1),
    ]);
}
    // 🔔 CONTADOR (badge no dashboard)
    public function contarNovosAluno()
    {
        $this->requireAluno();

        return CalendarioInstitucional::where('ativo', true)
            ->whereIn('publico', ['alunos', 'todos'])
            ->whereDate('data', '>=', now())
            ->count();
    }
}
