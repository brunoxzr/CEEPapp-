<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AlunoPasswordResetController extends Controller
{
    /**
     * Envia o link de redefinição para o e-mail do aluno logado
     */
    public function sendLink(Request $request)
    {
        $alunoId = session('aluno_id');

        if (!$alunoId) {
            abort(403);
        }

        $aluno = Aluno::findOrFail($alunoId);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $aluno->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $link = url('/senha/redefinir/' . $token);

        Mail::send(
            'emails.reset-senha',
            compact('aluno', 'link'),
            function ($m) use ($aluno) {
                $m->to($aluno->email)
                  ->subject('Redefinição de senha — CEEP Assaí');
            }
        );

        // redireciona para a tela informativa
        return redirect()->route('senha.email.enviado');
    }

    /**
     * Exibe o formulário de redefinição
     */
    public function showResetForm($token)
    {
        $registro = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (
            !$registro ||
            Carbon::parse($registro->created_at)->addMinutes(60)->isPast()
        ) {
            abort(404);
        }

        return view('auth.reset-senha', compact('token'));
    }

    /**
     * Salva a nova senha
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $registro = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$registro) {
            abort(404);
        }

        $aluno = Aluno::where('email', $registro->email)->firstOrFail();

        // 🔥 ATUALIZA NO CAMPO CORRETO (senha)
        $aluno->forceFill([
            'senha' => Hash::make($request->password),
        ])->save();

        // remove o token após uso
        DB::table('password_resets')
            ->where('email', $aluno->email)
            ->delete();

        return redirect('/area-academica')
            ->with('success', 'Senha redefinida com sucesso.');
    }
}
