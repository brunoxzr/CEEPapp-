<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use App\Models\News;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    private function adminLogado(): Admin
    {
        $adminId = session('admin_id');
        if (!$adminId) {
            abort(403, 'Não autenticado como gestor.');
        }

        return Admin::findOrFail($adminId);
    }

    public function index()
    {
        $admin = $this->adminLogado();

        // DIRETOR vai pro painel master
        if ($admin->isDiretor()) {
            return redirect()->route('admin.diretor.dashboard');
        }

        // GESTOR vai pro painel limitado
        return redirect()->route('admin.gestor.dashboard');
    }

    /**
     * Dashboard do gestor (limitado por permissões)
     * Aqui não tem gerenciamento de permissões.
     */
    public function gestorDashboard()
    {
        $admin = $this->adminLogado();

        // estatísticas gerais (somente visual)
        $totAlunos   = Aluno::count();
        $totBoletins = Boletim::count();
        $hoje        = Cronograma::where('data', now()->toDateString())->count();

        $recentesBoletim = Boletim::with('aluno')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $totSaeb = SaebResultado::count();
        $recentesSaeb = SaebResultado::with('aluno')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $totNoticias = class_exists(News::class) ? News::count() : 0;
        $ultimasNoticias = class_exists(News::class)
            ? News::orderByDesc('published_at')->take(6)->get()
            : collect();

        return view('admin.gestor.dashboard', compact(
            'admin',
            'totAlunos',
            'totBoletins',
            'hoje',
            'recentesBoletim',
            'totSaeb',
            'recentesSaeb',
            'totNoticias',
            'ultimasNoticias'
        ));
    }
}
