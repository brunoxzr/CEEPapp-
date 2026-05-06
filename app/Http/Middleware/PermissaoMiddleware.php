<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class PermissaoMiddleware
{
    public function handle(Request $request, Closure $next, string $permissao)
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            return redirect()->route('login.unificado');
        }

        $admin = Admin::with('permissoes')->find($adminId);

        if (!$admin) {
            session()->forget('admin_id');
            return redirect()->route('login.unificado');
        }

        if ($admin->role === 'diretor') {
            return $next($request);
        }

        if (!$admin->temPermissao($permissao)) {
            abort(403, 'Você não possui permissão para acessar esta área.');
        }

        return $next($request);
    }
}