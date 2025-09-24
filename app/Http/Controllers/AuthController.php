<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ----- Aluno -----
    public function showAlunoLogin()
    {
        if (session('aluno_id')) {
            return redirect('/aluno/dashboard');
        }
        return view('auth.login');
    }

    public function loginAluno(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string|min:4'
        ]);

        $aluno = Aluno::where('email', $request->email)->first();
        if (!$aluno || !Hash::check($request->senha, $aluno->senha)) {
            return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
        }

        session(['aluno_id' => $aluno->id]);
        return redirect('/aluno/dashboard');
    }

    // ----- Admin -----
    public function showAdminLogin()
    {
        if (session('admin_id')) {
            return redirect('/admin/dashboard');
        }
        return view('auth.admin-login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string|min:6'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->senha, $admin->senha)) {
            return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
        }

        session(['admin_id' => $admin->id]);
        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('status', 'Sessão encerrada.');
    }
}
