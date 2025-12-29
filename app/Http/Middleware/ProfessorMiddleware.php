<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;

class ProfessorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session('admin_id')) {
            abort(403);
        }

        $admin = Admin::find(session('admin_id'));

        if (!$admin || $admin->role !== 'professor') {
            abort(403);
        }

        return $next($request);
    }
}
