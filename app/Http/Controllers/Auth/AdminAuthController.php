<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
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

        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $email = strtolower(trim($data['email']));
        $throttleKey = 'admin-login:' . sha1($email . '|' . $request->ip());

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

        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['email' => 'Credenciais invalidas.']);
    }
}
