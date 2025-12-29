<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;

class ProfessorAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            abort(403, 'Não autenticado.');
        }

        $admin = Admin::find($adminId);

        if (!$admin || $admin->role !== 'professor') {
            abort(403, 'Acesso restrito a professores.');
        }

        return $next($request);
    }
}
