<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AlunoAuthController extends Controller
{
    public function showLogin()
    {
        if (session('aluno_id')) {
            return redirect()->route('aluno.dashboard');
        }

        return view('auth.aluno_login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $email = strtolower(trim($data['email']));
        $throttleKey = 'aluno-login:' . sha1($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Aguarde alguns instantes e tente novamente.',
            ]);
        }

        $aluno = Aluno::where('email', $email)->first();

        if ($aluno && Hash::check($data['senha'], $aluno->senha)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            session()->forget(['admin_id', 'admin_role']);
            session(['aluno_id' => $aluno->id]);

            return redirect()->route('aluno.dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['email' => 'Credenciais invalidas.']);
    }
}
