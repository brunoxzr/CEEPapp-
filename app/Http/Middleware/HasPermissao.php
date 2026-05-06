<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class HasPermissao
{
    public function handle(Request $request, Closure $next, string $permissao)
    {
        $admin = Admin::with('permissoes')->find(session('admin_id'));

        if (!$admin) {
            return redirect()->route('login.unificado');
        }

        if (!$admin->temPermissao($permissao)) {
            abort(403, 'Sem permissao: ' . $permissao);
        }

        return $next($request);
    }
}
