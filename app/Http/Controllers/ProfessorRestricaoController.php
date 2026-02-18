<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ProfessorRestricao;
use Illuminate\Http\Request;

class ProfessorRestricaoController extends Controller
{
    /**
     * Diretor OU gestor com permissão de professores
     */
    private function requirePermissaoProfessores()
    {
        $admin = Admin::find(session('admin_id'));

        if (!$admin) {
            abort(403, 'Não autenticado.');
        }

        // Diretor sempre pode
        if ($admin->role === 'diretor') {
            return $admin;
        }

        // Gestor precisa da permissão
        if ($admin->role === 'gestor' && adminPode('gerenciar_professores')) {
            return $admin;
        }

        abort(403, 'Sem permissão para gerenciar professores.');
    }

    /**
     * Lista professores e restrições
     */
    public function index()
    {
        $this->requirePermissaoProfessores();

        $professores = Admin::where('role', 'professor')
            ->with('restricoes')
            ->orderBy('nome')
            ->get();

        return view('admin.restricoes.index', compact('professores'));
    }

    /**
     * Cria restrição
     */
    public function store(Request $request)
    {
        $this->requirePermissaoProfessores();

        $data = $request->validate([
            'admin_id'   => 'required|exists:admins,id',
            'dia_semana' => 'required|string|max:20',
            'aula'       => 'nullable|integer|min:1|max:6',
            'motivo'     => 'nullable|string|max:255',
        ]);

        ProfessorRestricao::create($data);

        return back()->with('ok', 'Restrição adicionada.');
    }

    /**
     * Remove restrição
     */
    public function destroy($id)
    {
        $this->requirePermissaoProfessores();

        ProfessorRestricao::findOrFail($id)->delete();

        return back()->with('ok', 'Restrição removida.');
    }
}
