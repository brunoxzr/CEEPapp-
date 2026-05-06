<?php

namespace App\Http\Middleware;

use App\Models\Aluno;
use Closure;
use Illuminate\Http\Request;

class AlunoAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('aluno_id') || !Aluno::find(session('aluno_id'))) {
            return redirect()->route('login.unificado');
        }

        return $next($request);
    }
}
