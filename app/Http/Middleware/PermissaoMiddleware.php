<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;

class PermissaoMiddleware
{
    public function handle($request, Closure $next, string $permissao)
    {
        $adminId = session('admin_id');

        if (!$adminId) {
            abort(403, 'Não autenticado.');
        }

        $admin = Admin::findOrFail($adminId);

        if (!$admin->temPermissao($permissao)) {
            abort(403, 'Sem permissão.');
        }

        return $next($request);
    }
}
