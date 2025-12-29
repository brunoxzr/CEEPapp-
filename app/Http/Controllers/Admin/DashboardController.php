<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Projeto;
use App\Models\News;
use App\Models\Permissao;

class DashboardController extends Controller
{
    private function admin()
    {
        return Admin::findOrFail(session('admin_id'));
    }

    public function index()
    {
        $admin = $this->admin();

        return view('admin.dashboard', [
            'admin' => $admin,
            'totAlunos' => Aluno::count(),
            'totProfessores' => Professor::count(),
            'totProjetos' => Projeto::count(),
            'totNoticias' => News::count(),
            'totAdmins' => Admin::count(),
        ]);
    }
}
