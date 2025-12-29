<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class DiretorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('admin_id');
        if (!$adminId) {
            abort(403, 'Não autenticado.');
        }

        $admin = Admin::findOrFail($adminId);

        if (!$admin->isDiretor()) {
            abort(403, 'Acesso restrito ao Diretor.');
        }

        return $next($request);
    }
}
