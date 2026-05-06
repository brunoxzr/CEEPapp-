<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class ProfessorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            return redirect()->route('login.unificado');
        }

        $admin = Admin::find($adminId);

        if (!$admin) {
            session()->forget('admin_id');
            return redirect()->route('login.unificado');
        }

        if ($admin->role !== 'professor') {
            abort(403, 'Acesso restrito a professores.');
        }

        return $next($request);
    }
}