<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\SaebResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProtocolController extends Controller
{
    /**
     * Verifica se o gestor está autenticado
     */
    private function requireAdmin()
    {
        if (!session('admin_id')) {
            abort(403, 'Não autenticado como gestor.');
        }
    }

    /**
     * Exibir último protocolo gerado
     */
    public function protocolo()
    {
        $this->requireAdmin();

        $ultimo = DB::table('saeb_protocolos')
            ->where('admin_id', session('admin_id'))
            ->orderByDesc('id')
            ->first();

        if (!$ultimo) {
            return back()->withErrors(['msg' => 'Nenhum protocolo encontrado.']);
        }

        // Converter campos de data em Carbon
        $ultimo->created_at = Carbon::parse($ultimo->created_at);
        $ultimo->updated_at = Carbon::parse($ultimo->updated_at);

        $dados = json_decode($ultimo->dados, true) ?? [];

        // Lista de alunos cadastrados para dropdown
        $alunos = Aluno::orderBy('nome')->get();

        return view('admin.saeb_protocolo', compact('ultimo', 'dados', 'alunos'));
    }

    /**
     * Publicar protocolo como resultados oficiais
     */
    public function publicar(Request $request, $id)
    {
        $this->requireAdmin();

        $protocolo = DB::table('saeb_protocolos')->where('id', $id)->first();
        if (!$protocolo) {
            return back()->withErrors(['msg' => 'Protocolo não encontrado']);
        }

        $dados = $request->input('dados', []);

        foreach ($dados as $item) {
            if (empty($item['aluno_id'])) {
                // Se não foi vinculado aluno, pula
                continue;
            }

            // Verifica se o aluno existe
            $aluno = Aluno::find($item['aluno_id']);
            if (!$aluno) continue;

            // Cria resultado do SAEB
            SaebResultado::create([
                'aluno_id'   => $aluno->id,
                'disciplina' => $item['disciplina'] ?? 'N/D',
                'ano'        => $item['ano'] ?? date('Y'),
                'etapa'      => $item['etapa'] ?? 'Prova',
                'media'      => $item['media'] ?? 0,
                'detalhes'   => $item['bruto'] ?? [],
            ]);
        }

        DB::table('saeb_protocolos')
            ->where('id', $id)
            ->update(['publicado' => true]);

        return redirect()->route('admin.saeb')
            ->with('ok', 'Resultados SAEB publicados com sucesso.');
    }
}
