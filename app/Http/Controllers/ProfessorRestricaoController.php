<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ProfessorRestricao;
use Illuminate\Http\Request;

class ProfessorRestricaoController extends Controller
{
    private function requireDiretor()
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin || !$admin->isDiretor()) {
            abort(403);
        }
        return $admin;
    }

    public function index()
    {
        $this->requireDiretor();

        $professores = Admin::where('role', 'professor')
            ->with('restricoes')
            ->orderBy('nome')
            ->get();

        return view('admin.restricoes.index', compact('professores'));
    }

    public function store(Request $request)
    {
        $this->requireDiretor();

        $data = $request->validate([
            'admin_id'   => 'required|exists:admins,id',
            'dia_semana' => 'required|string',
            'aula'       => 'nullable|integer|min:1|max:6',
            'motivo'     => 'nullable|string|max:255',
        ]);

        ProfessorRestricao::create($data);

        return back()->with('ok', 'Restrição adicionada.');
    }

    public function destroy($id)
    {
        $this->requireDiretor();

        ProfessorRestricao::findOrFail($id)->delete();

        return back()->with('ok', 'Restrição removida.');
    }
}
