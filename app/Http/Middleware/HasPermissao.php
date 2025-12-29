<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class HasPermissao
{
    public function handle(Request $request, Closure $next, string $permissao)
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            abort(403, 'Não autenticado.');
        }

        $admin = Admin::with('permissoes')->find($adminId);

        if (!$admin) {
            abort(403, 'Administrador não encontrado.');
        }

        if (!adminPode($permissao)) {
            abort(403, 'Você não possui permissão: ' . $permissao);
        }

        return $next($request);
    }
}
