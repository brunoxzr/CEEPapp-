<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UnifiedLoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ TENTA LOGIN COMO ADMIN / PROFESSOR / DIRETOR
        |--------------------------------------------------------------------------
        */
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->senha, $admin->senha)) {

            // sessão admin
            session()->forget('aluno_id');
            session()->put('admin_id', $admin->id);

            // 🔀 REDIRECIONAMENTO POR ROLE
            if ($admin->role === 'professor') {
                return redirect()->route('professor.dashboard');
            }

            // diretor / admin / outros
            return redirect()->route('admin.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ TENTA LOGIN COMO ALUNO
        |--------------------------------------------------------------------------
        */
        $aluno = Aluno::where('email', $request->email)->first();

        if ($aluno && Hash::check($request->senha, $aluno->senha)) {

            // sessão aluno
            session()->forget('admin_id');
            session()->put('aluno_id', $aluno->id);

            return redirect()->route('aluno.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ FALHA
        |--------------------------------------------------------------------------
        */
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.'
        ]);
    }
}
