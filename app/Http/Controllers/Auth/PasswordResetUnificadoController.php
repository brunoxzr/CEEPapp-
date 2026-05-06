<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Aluno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetUnificadoController extends Controller
{
    public function solicitar()
    {
        return view('auth.esqueci-senha');
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower(trim($request->email));
        $throttleKey = 'password-reset:' . sha1($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas. Aguarde alguns instantes e tente novamente.',
            ]);
        }

        RateLimiter::hit($throttleKey, 300);

        $aluno = Aluno::whereRaw('LOWER(email) = ?', [$email])->first();
        $admin = Admin::whereRaw('LOWER(email) = ?', [$email])->first();

        if (!$aluno && !$admin) {
            return redirect()->route('senha.email.enviado');
        }

        $usuario = $aluno ?: $admin;
        $tipo = $aluno ? 'aluno' : 'admin';
        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email, 'tipo' => $tipo],
            ['token' => hash('sha256', $token), 'created_at' => now()]
        );

        $link = url('/senha/redefinir/' . $token);

        app()->terminating(function () use ($usuario, $link) {
            Mail::send(
                'emails.reset-senha',
                ['usuario' => $usuario, 'link' => $link],
                function ($m) use ($usuario) {
                    $m->to($usuario->email)
                        ->subject('Redefinicao de senha - CEEP Assai');
                }
            );
        });

        return redirect()->route('senha.email.enviado');
    }

    public function enviado()
    {
        return view('auth.email-enviado');
    }

    public function formulario($token)
    {
        abort_unless(is_string($token) && strlen($token) === 64, 404);

        $tokenHash = hash('sha256', $token);

        $registro = DB::table('password_resets')
            ->where('token', $tokenHash)
            ->first();

        if (!$registro) {
            abort(404);
        }

        if (Carbon::parse($registro->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_resets')->where('token', $tokenHash)->delete();
            abort(404);
        }

        return view('auth.reset-senha', compact('token'));
    }

    public function redefinir(Request $request)
    {
        $request->validate([
            'token' => 'required|string|size:64',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Informe a nova senha.',
            'password.min' => 'A senha precisa ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas nao conferem.',
        ]);

        $tokenHash = hash('sha256', $request->token);

        $registro = DB::table('password_resets')
            ->where('token', $tokenHash)
            ->first();

        if (!$registro) {
            abort(404);
        }

        if (Carbon::parse($registro->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_resets')->where('token', $tokenHash)->delete();
            abort(404);
        }

        $usuario = $registro->tipo === 'admin'
            ? Admin::whereRaw('LOWER(email) = ?', [strtolower($registro->email)])->firstOrFail()
            : Aluno::whereRaw('LOWER(email) = ?', [strtolower($registro->email)])->firstOrFail();

        $usuario->forceFill([
            'senha' => Hash::make($request->password),
        ])->save();

        DB::table('password_resets')
            ->where('email', $registro->email)
            ->where('tipo', $registro->tipo)
            ->delete();

        return redirect()
            ->route('login.unificado')
            ->with('success', 'Senha redefinida com sucesso. Faca login com a nova senha.');
    }
}
