<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\AtividadeAluno;
use App\Models\Aluno;
use Carbon\Carbon;

class AlunoAtividadeController extends Controller
{
    /**
     * Recupera aluno autenticado
     */
    private function aluno()
    {
        $aluno = Aluno::find(session('aluno_id'));

        if (!$aluno) {
            abort(403);
        }

        return $aluno;
    }

    /**
     * LISTAR ATIVIDADES DO ALUNO
     */
    public function index()
    {
        $aluno = $this->aluno();

        $atividades = Atividade::where('turma', $aluno->turma)
            ->where('tipo', 'atividade')
            ->where('visivel_aluno', true)
            ->orderByDesc('created_at')
            ->get();

        return view('aluno.atividades.index', compact('atividades'));
    }

    /**
     * ENVIAR ATIVIDADE (LINK DRIVE)
     */
    public function enviar(Request $request, Atividade $atividade)
    {
        $aluno = $this->aluno();

        // 🔥 Segurança forte
        if (
            $atividade->turma !== $aluno->turma ||
            $atividade->tipo !== 'atividade' ||
            !$atividade->visivel_aluno
        ) {
            abort(403);
        }

        $request->validate([
            'link_drive' => 'required|url|starts_with:https://,http://'
        ]);

        // 🔥 Se já foi corrigida, bloqueia reenvio
        $registroExistente = AtividadeAluno::where('atividade_id', $atividade->id)
            ->where('aluno_id', $aluno->id)
            ->first();

        if ($registroExistente && $registroExistente->status === 'corrigido') {
            return back()->with('error', 'Esta atividade já foi corrigida pelo professor.');
        }

        // 🔥 Lógica automática de atraso
        if (!$atividade->data_limite) {
            $status = 'entregue';
        } else {
            $dataLimite = Carbon::parse($atividade->data_limite)->endOfDay();
            $status = now()->gt($dataLimite)
                ? 'atrasado'
                : 'entregue';
        }

        AtividadeAluno::updateOrCreate(
            [
                'atividade_id' => $atividade->id,
                'aluno_id'     => $aluno->id,
            ],
            [
                'link_drive'  => $request->link_drive,
                'status'      => $status,
                'entregue_em' => now(),
            ]
        );

        return back()->with('success', 'Atividade enviada com sucesso.');
    }

    /**
     * VER DETALHES DA ATIVIDADE
     */
    public function show(Atividade $atividade)
    {
        $aluno = $this->aluno();

        if (
            $atividade->turma !== $aluno->turma ||
            $atividade->tipo !== 'atividade' ||
            !$atividade->visivel_aluno
        ) {
            abort(403);
        }

        $entrega = AtividadeAluno::where('atividade_id', $atividade->id)
            ->where('aluno_id', $aluno->id)
            ->first();

        return view('aluno.atividades.show', compact('atividade', 'entrega'));
    }
}
