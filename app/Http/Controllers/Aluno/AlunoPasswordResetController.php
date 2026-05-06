<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AlunoPasswordResetController extends Controller
{
    public function sendLink(Request $request)
    {
        $alunoId = session('aluno_id');

        if (!$alunoId) {
            abort(403);
        }

        $aluno = Aluno::findOrFail($alunoId);
        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $aluno->email, 'tipo' => 'aluno'],
            ['token' => hash('sha256', $token), 'created_at' => now()]
        );

        $link = url('/senha/redefinir/' . $token);

        app()->terminating(function () use ($aluno, $link) {
            Mail::send(
                'emails.reset-senha',
                ['usuario' => $aluno, 'link' => $link],
                function ($m) use ($aluno) {
                    $m->to($aluno->email)
                        ->subject('Redefinicao de senha - CEEP Assai');
                }
            );
        });

        return redirect()->route('senha.email.enviado');
    }

    public function showResetForm($token)
    {
        abort_unless(is_string($token) && strlen($token) === 64, 404);

        $tokenHash = hash('sha256', $token);

        $registro = DB::table('password_resets')
            ->where('token', $tokenHash)
            ->first();

        if (!$registro || Carbon::parse($registro->created_at)->addMinutes(60)->isPast()) {
            if ($registro) {
                DB::table('password_resets')->where('token', $tokenHash)->delete();
            }

            abort(404);
        }

        return view('auth.reset-senha', compact('token'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string|size:64',
            'password' => 'required|min:8|confirmed',
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

        $aluno = Aluno::where('email', $registro->email)->firstOrFail();

        $aluno->forceFill([
            'senha' => Hash::make($request->password),
        ])->save();

        DB::table('password_resets')
            ->where('email', $aluno->email)
            ->where('tipo', 'aluno')
            ->delete();

        return redirect()
            ->route('login.unificado')
            ->with('success', 'Senha redefinida com sucesso.');
    }
}
