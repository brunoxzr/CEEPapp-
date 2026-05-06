<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class ProfessorAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Admin::find(session('admin_id'));

        if (!$admin) {
            return redirect()->route('login.unificado');
        }

        if ($admin->role !== 'professor') {
            abort(403, 'Acesso restrito a professores.');
        }

        session(['admin_role' => $admin->role]);

        return $next($request);
    }
}
