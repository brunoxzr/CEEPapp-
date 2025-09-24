<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlunoAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.aluno_login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $aluno = Aluno::where('email', $data['email'])->first();

        if ($aluno && Hash::check($data['senha'], $aluno->senha)) {
            session(['aluno_id' => $aluno->id]);
            return redirect()->route('aluno.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }
}
