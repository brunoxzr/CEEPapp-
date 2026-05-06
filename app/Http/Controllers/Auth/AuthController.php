<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showAlunoLogin()
    {
        if (session('aluno_id')) {
            return redirect()->route('aluno.dashboard');
        }

        return view('auth.login');
    }

    public function loginAluno(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $email = strtolower(trim($data['email']));
        $throttleKey = 'legacy-aluno-login:' . sha1($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Aguarde alguns instantes e tente novamente.',
            ]);
        }

        $aluno = Aluno::where('email', $email)->first();

        if (!$aluno || !Hash::check($data['senha'], $aluno->senha)) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['email' => 'Credenciais invalidas.']);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        session()->forget(['admin_id', 'admin_role']);
        session(['aluno_id' => $aluno->id]);

        return redirect()->route('aluno.dashboard');
    }

    public function showAdminLogin()
    {
        if (session('admin_id')) {
            $admin = Admin::find(session('admin_id'));

            if ($admin?->role === 'professor') {
                return redirect()->route('professor.dashboard');
            }

            if ($admin) {
                return redirect()->route('admin.dashboard');
            }
        }

        return view('auth.login');
    }

    public function loginAdmin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $email = strtolower(trim($data['email']));
        $throttleKey = 'legacy-admin-login:' . sha1($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Aguarde alguns instantes e tente novamente.',
            ]);
        }

        $admin = Admin::where('email', $email)->first();

        if (!$admin || !Hash::check($data['senha'], $admin->senha)) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['email' => 'Credenciais invalidas.']);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        session()->forget('aluno_id');
        session(['admin_id' => $admin->id, 'admin_role' => $admin->role]);

        return $admin->role === 'professor'
            ? redirect()->route('professor.dashboard')
            : redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Sessao encerrada.');
    }
}
