<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UnifiedLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        // 🔎 Tenta ADMIN primeiro
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->senha, $admin->senha)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        // 🔎 Depois ALUNO
        $aluno = Aluno::where('email', $request->email)->first();
        if ($aluno && Hash::check($request->senha, $aluno->senha)) {
            session(['aluno_id' => $aluno->id]);
            return redirect()->route('aluno.dashboard');
        }

        return back()->withErrors(['Credenciais inválidas.']);
    }
}
