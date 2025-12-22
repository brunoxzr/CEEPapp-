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
        return view('auth.login'); // sua view da área acadêmica
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        // 1️⃣ Tenta como ADMIN
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->senha, $admin->senha)) {
            session()->put('admin_id', $admin->id);
            return redirect()->route('admin.dashboard');
        }

        // 2️⃣ Tenta como ALUNO
        $aluno = Aluno::where('email', $request->email)->first();

        if ($aluno && Hash::check($request->senha, $aluno->senha)) {
            session()->put('aluno_id', $aluno->id);
            return redirect()->route('aluno.dashboard');
        }

        // 3️⃣ Falha
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.'
        ]);
    }
}
