<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\SaebResultado;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

class SaebController extends Controller
{
    // Página admin - upload
    public function index()
    {
        if (!session('admin_id')) abort(403);

        $resultados = SaebResultado::with('aluno')->orderByDesc('created_at')->paginate(20);
        return view('admin.saeb', compact('resultados'));
    }

    public function upload(Request $request)
    {
        if (!session('admin_id')) abort(403);

        $request->validate([
            'arquivo' => 'required|mimes:xls,xlsx,csv'
        ]);

        $file = $request->file('arquivo');

        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
        } catch (ReaderException $e) {
            return back()->withErrors(['msg' => 'Erro ao abrir a planilha: ' . $e->getMessage()]);
        }

        $sheet = $spreadsheet->getActiveSheet();
        $rows  = $sheet->toArray(null, true, true, true);

        if (empty($rows) || count($rows) < 2) {
            return back()->withErrors(['msg' => 'A planilha está vazia ou não possui dados válidos.']);
        }

        // Normalizar cabeçalhos
        $headerRaw = array_values($rows[1]);
        unset($rows[1]);

        $header = [];
        foreach ($headerRaw as $h) {
            $hNorm = strtolower(trim($h));
            if (str_contains($hNorm, 'aluno') || str_contains($hNorm, 'estudante') || str_contains($hNorm, 'nome')) {
                $header[] = 'Aluno';
            } elseif (str_contains($hNorm, 'curricular') || str_contains($hNorm, 'disciplina') || str_contains($hNorm, 'área')) {
                $header[] = 'Componente Curricular';
            } elseif ($hNorm == 'ano' || str_contains($hNorm, 'ano')) {
                $header[] = 'Ano';
            } elseif (str_contains($hNorm, 'avalia')) {
                $header[] = 'Avaliação';
            } else {
                $header[] = $h; // mantém como está (H1, H2, etc.)
            }
        }

        $dados = [];

        foreach ($rows as $row) {
            $values = array_values($row);
            if (count($values) < count($header)) continue;

            $data = @array_combine($header, $values);
            if (!$data || empty($data['Aluno'])) continue;

            $nomeAluno  = trim($data['Aluno']);
            $disciplina = $data['Componente Curricular'] ?? 'N/D';
            $ano        = isset($data['Ano']) && is_numeric($data['Ano']) ? (int)$data['Ano'] : date('Y');
            $etapa      = $data['Avaliação'] ?? 'Prova';

            // Calcular habilidades
            $habilidades = [];
            $acertos = 0;
            $total   = 0;

            foreach ($data as $col => $val) {
                if (str_starts_with($col, 'H') && !empty($val)) {
                    $partes = explode('/', str_replace(' ', '', $val));
                    if (count($partes) == 2) {
                        [$ac, $tot] = array_map('intval', $partes);
                        $habilidades[$col] = $val;
                        $acertos += $ac;
                        $total   += $tot;
                    }
                }
            }

            $media = $total > 0 ? round(($acertos / $total) * 10, 2) : 0;

            $dados[] = [
                'aluno_nome' => $nomeAluno,
                'disciplina' => $disciplina,
                'ano'        => $ano,
                'etapa'      => $etapa,
                'media'      => $media,
                'bruto'      => $habilidades,
            ];
        }

        if (empty($dados)) {
            return back()->withErrors(['msg' => 'Nenhuma linha válida encontrada na planilha.']);
        }

        // Guarda em sessão para mapear
        session(['saeb_dados' => $dados]);

        $alunos = Aluno::orderBy('nome')->get();

        return view('admin.saeb_mapear', compact('dados', 'alunos'));
    }

    // Salvar após mapear
    public function mapearAlunos(Request $request)
    {
        if (!session('admin_id')) abort(403);

        $dados = session('saeb_dados');
        if (!$dados) {
            return redirect()->route('admin.saeb')->withErrors(['msg' => 'Nenhum dado carregado.']);
        }

        foreach ($dados as $i => $linha) {
            $alunoId   = $request->input("mapear.$i");
            $tipoProva = $request->input("tipo.$i"); // Novo campo

            if (!$alunoId || !$tipoProva) continue;

            SaebResultado::create([
                'aluno_id'   => $alunoId,
                'disciplina' => $linha['disciplina'],
                'ano'        => $linha['ano'],
                'etapa'      => $linha['etapa'],
                'media'      => $linha['media'],
                'tipo'       => $tipoProva, // Salva tipo (LP1, LP2, MT1, etc.)
                'dados'      => json_encode($linha['bruto']),
            ]);
        }

        session()->forget('saeb_dados');

        return redirect()->route('admin.saeb')->with('ok', 'Resultados SAEB salvos com sucesso!');
    }


    // Página do aluno
    public function alunoResultados()
    {
        if (!session('aluno_id')) abort(403);

        $resultados = SaebResultado::where('aluno_id', session('aluno_id'))
            ->orderByDesc('ano')
            ->orderByDesc('created_at')
            ->get();

        return view('aluno.saeb', compact('resultados'));
    }
}
