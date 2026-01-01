<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlunoAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('aluno_id')) {
            return redirect('/login-aluno'); // ou abort(403)
        }

        return $next($request);
    }
}
