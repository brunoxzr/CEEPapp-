<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmartAgroInscricao;

class SmartAgroController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Página pública do formulário
    |--------------------------------------------------------------------------
    */
public function index()
{
    $anos = [
        "1º Ano" => ['1º IA','1º EDF','1º MEC','1º Agro'],
        "2º Ano" => ['2º DS','2º EDF','2º MEC','2º Agro A','2º Agro E', '2º Enf'],
        "3º Ano" => ['3º DS','3º EDF','3º MEC','3º Eletro','3º Agro'],
    ];

    $turmas = collect($anos)->flatten()->values();

    return view('smart_agro.inscricoes', compact('turmas'));
}
public function selecionados()
{
    $selecionados = SmartAgroInscricao::where('status', 'selecionado')
        ->orderByDesc('nota_total')
        ->get();

    return view('smart_agro.selecionados', compact('selecionados'));
}


    /*
    |--------------------------------------------------------------------------
    | Salvar inscrição
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'aluno_nome' => 'required|string|max:255',
            'aluno_email' => 'required|email|max:255',
            'turma' => 'required|string|max:100',
            'ano' => 'required|string|max:10',
            'professor_orientador' => 'required|string|max:255',
            'titulo_projeto' => 'required|string|max:255',
            'area' => 'required|string|max:100',
            'problema' => 'required|string',
            'solucao' => 'required|string',
            'potencial_startup' => 'required|string',
            'diferencial' => 'required|string',
        ]);

        // Montar array de integrantes (máximo 4)
        $integrantes = [];

        for ($i = 1; $i <= 4; $i++) {
            if ($request->filled("integrante_$i")) {
                $integrantes[] = $request->input("integrante_$i");
            }
        }

        SmartAgroInscricao::create([
            'aluno_nome' => $request->aluno_nome,
            'aluno_email' => $request->aluno_email,
            'aluno_telefone' => $request->aluno_telefone,
            'turma' => $request->turma,
            'ano' => $request->ano,
            'professor_orientador' => $request->professor_orientador,
            'titulo_projeto' => $request->titulo_projeto,
            'area' => $request->area,
            'problema' => $request->problema,
            'solucao' => $request->solucao,
            'potencial_startup' => $request->potencial_startup,
            'diferencial' => $request->diferencial,
            'integrantes' => $integrantes,
            'status' => 'pendente'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Inscrição enviada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | Painel Admin - Listar inscrições
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $inscricoes = SmartAgroInscricao::orderBy('created_at', 'desc')->get();

        return view('admin.smart_agro.index', compact('inscricoes'));
    }

    /*
    |--------------------------------------------------------------------------
    | Avaliar inscrição
    |--------------------------------------------------------------------------
    */
    public function avaliar(Request $request, $id)
    {
        $inscricao = SmartAgroInscricao::findOrFail($id);

        $request->validate([
            'nota_inovacao' => 'required|integer|min:0|max:10',
            'nota_aplicabilidade' => 'required|integer|min:0|max:10',
            'nota_mercado' => 'required|integer|min:0|max:10',
            'nota_clareza' => 'required|integer|min:0|max:10',
            'nota_viabilidade' => 'required|integer|min:0|max:10',
        ]);

        $total =
            $request->nota_inovacao +
            $request->nota_aplicabilidade +
            $request->nota_mercado +
            $request->nota_clareza +
            $request->nota_viabilidade;

        $inscricao->update([
            'nota_inovacao' => $request->nota_inovacao,
            'nota_aplicabilidade' => $request->nota_aplicabilidade,
            'nota_mercado' => $request->nota_mercado,
            'nota_clareza' => $request->nota_clareza,
            'nota_viabilidade' => $request->nota_viabilidade,
            'nota_total' => $total,
        ]);

        return back()->with('success', 'Avaliação registrada.');
    }

    /*
    |--------------------------------------------------------------------------
    | Selecionar ou recusar
    |--------------------------------------------------------------------------
    */
    public function alterarStatus($id, $status)
    {
        $inscricao = SmartAgroInscricao::findOrFail($id);

        if (!in_array($status, ['selecionado', 'recusado'])) {
            abort(403);
        }

        $inscricao->update([
            'status' => $status
        ]);

        return back()->with('success', 'Status atualizado.');
    }
    public function adminShow($id)
{
    $inscricao = SmartAgroInscricao::findOrFail($id);

    return view('admin.smart_agro.show', compact('inscricao'));
}

}
