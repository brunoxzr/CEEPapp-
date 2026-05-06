<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class UnifiedLoginController extends Controller
{
    public function show()
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $email = strtolower(trim($data['email']));
        $throttleKey = 'login:' . sha1($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Aguarde alguns instantes e tente novamente.',
            ]);
        }

        $admin = Admin::where('email', $email)->first();

        if ($admin && Hash::check($data['senha'], $admin->senha)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            session()->forget('aluno_id');
            session(['admin_id' => $admin->id, 'admin_role' => $admin->role]);

            return $admin->role === 'professor'
                ? redirect()->route('professor.dashboard')
                : redirect()->route('admin.dashboard');
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

        return back()->withErrors([
            'email' => 'E-mail ou senha invalidos.',
        ]);
    }

    private function redirectAuthenticated()
    {
        if (session('aluno_id')) {
            return redirect()->route('aluno.dashboard');
        }

        if (session('admin_id')) {
            $admin = Admin::find(session('admin_id'));

            if ($admin?->role === 'professor') {
                return redirect()->route('professor.dashboard');
            }

            if ($admin) {
                return redirect()->route('admin.dashboard');
            }

            session()->forget(['admin_id', 'admin_role']);
        }

        return null;
    }
}
