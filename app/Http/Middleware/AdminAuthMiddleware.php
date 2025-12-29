<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('admin_id');
        $admin = \App\Models\Admin::find($adminId);

        if (!$admin) {
            abort(403, 'Administrador não encontrado ou não autenticado.');
        }

        return $next($request);
    }
}
