<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permissao;
use Illuminate\Http\Request;

class AdminDiretorController extends Controller
{
    private function diretorLogado(): Admin
    {
        $adminId = session('admin_id');
        if (!$adminId) {
            abort(403, 'Não autenticado.');
        }

        $admin = Admin::findOrFail($adminId);

        if (!$admin->isDiretor()) {
            abort(403, 'Acesso restrito ao Diretor.');
        }

        return $admin;
    }

    public function dashboard(Request $request)
    {
        $diretor = $this->diretorLogado();

        $q = trim((string) $request->query('q', ''));

        $gestores = Admin::query()
            ->where('role', 'gestor')
            ->with('permissoes') // Carregar permissões relacionadas
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nome', 'ilike', "%{$q}%")
                        ->orWhere('email', 'ilike', "%{$q}%");
                });
            })
            ->orderBy('nome')
            ->get();

        $permissoes = Permissao::orderBy('descricao')->get();

        // Para mapear rapidamente permissões por gestor na view
        $map = [];
        foreach ($gestores as $g) {
            $map[$g->id] = $g->permissoes()->pluck('permissoes.id')->toArray();
        }

        return view('admin.diretor.dashboard', compact('diretor', 'gestores', 'permissoes', 'map', 'q'));
    }

    public function syncPermissoes(Request $request, $adminId)
    {
        $this->diretorLogado();

        $admin = Admin::findOrFail($adminId);

        if ($admin->isDiretor()) {
            return back()->withErrors(['permissoes' => 'Não é permitido alterar permissões do Diretor.']);
        }

        $ids = $request->input('permissoes', []);
        if (!is_array($ids)) $ids = [];

        // segurança: só ids que existem
        $idsValidos = Permissao::whereIn('id', $ids)->pluck('id')->toArray();

        $admin->permissoes()->sync($idsValidos);

        return back()->with('ok', 'Permissões atualizadas com sucesso.');
    }

    public function promoverDiretor(Request $request, $adminId)
    {
        $diretor = $this->diretorLogado();

        // opcional: permitir trocar diretor (se quiser) — aqui deixei bloqueado por segurança
        return back()->withErrors(['diretor' => 'A troca de Diretor está desativada por segurança.']);
    }
}
