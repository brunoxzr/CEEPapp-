<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aluno;
use App\Models\Boletim;
use App\Models\Cronograma;
use App\Models\SaebResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function requireAdmin()
    {
        if (!session('admin_id')) {
            abort(403, 'Não autenticado como gestor.');
        }
        return Admin::findOrFail(session('admin_id'));
    }

    // ---------------- Dashboard ----------------
    public function dashboard()
    {
        $this->requireAdmin();

        $totAlunos   = Aluno::count();
        $totBoletins = Boletim::count();
        $hoje        = Cronograma::where('data', now()->toDateString())->count();
        $recentes    = Boletim::with('aluno')->orderByDesc('created_at')->take(8)->get();

        $totSaeb      = SaebResultado::count();
        $recentesSaeb = SaebResultado::with('aluno')->orderByDesc('created_at')->take(8)->get();

        return view('admin.dashboard', compact(
            'totAlunos', 'totBoletins', 'hoje',
            'recentes', 'totSaeb', 'recentesSaeb'
        ));
    }

    // ---------------- Cronograma ----------------
    public function cronograma()
    {
        $this->requireAdmin();

        $itens = Cronograma::orderByDesc('data')->paginate(20);

        return view('admin.cronograma', compact('itens'));
    }

    public function storeCronograma(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'data'        => 'required|date',
            'turma'       => 'required|string|max:50',
            'disciplina'  => 'required|string|max:150',
            'professor'   => 'required|string|max:150',
            'inicio'      => 'required',
            'fim'         => 'required',
            'sala'        => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        Cronograma::create($data);
        return back()->with('ok', 'Aula adicionada ao cronograma.');
    }

    // ---------------- Boletins ----------------
    public function boletins()
    {
        $this->requireAdmin();

        $boletins = Boletim::with('aluno')->orderByDesc('created_at')->paginate(20);
        $alunos   = Aluno::orderBy('nome')->get();

        return view('admin.boletins', compact('boletins', 'alunos'));
    }

    public function storeBoletim(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'aluno_id'    => 'required|exists:alunos,id',
            'disciplina'  => 'required|string|max:100',
            'ano'         => 'required|integer|min:2000|max:2100',
            'tipo'        => 'required|string|max:50',
            'origem'      => 'required|in:manual,saeb',
            'nota'        => 'nullable|numeric|min:0|max:10',
            'etapa'       => 'nullable|string|max:50',
            'observacoes' => 'nullable|string'
        ]);

        if ($data['origem'] === 'saeb') {
            $saeb = SaebResultado::where('aluno_id', $data['aluno_id'])
                ->where('disciplina', $data['disciplina'])
                ->where('ano', $data['ano'])
                ->orderByDesc('created_at')
                ->first();

            if (!$saeb) {
                return back()->withErrors([
                    'saeb' => 'Nenhum resultado SAEB encontrado para este aluno/ano/disciplina.'
                ]);
            }

            $data['nota'] = $saeb->media;
            $data['tipo'] = 'SAEB';
        }

        Boletim::create($data);
        return back()->with('ok', 'Boletim registrado.');
    }

    // ---------------- Usuários ----------------
    public function usuarios()
    {
        $this->requireAdmin();

        $alunos = Aluno::orderBy('nome')->get();
        $admins = Admin::orderBy('nome')->get();

        return view('admin.usuarios', compact('alunos', 'admins'));
    }

    public function storeUsuario(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'tipo'   => 'required|in:aluno,admin',
            'nome'   => 'required|string|max:100',
            'email'  => 'required|email|unique:alunos,email|unique:admins,email',
            'senha'  => 'required|string|min:4',
            'escola' => 'nullable|string|max:50',
            'turma'  => 'nullable|string|max:50',
        ]);

        if ($data['tipo'] === 'aluno') {
            Aluno::create([
                'nome'   => $data['nome'],
                'email'  => $data['email'],
                'senha'  => Hash::make($data['senha']),
                'escola' => $data['escola'] ?? 'CEEP',
                'turma'  => $data['turma'] ?? null,
            ]);
        } else {
            Admin::create([
                'nome'  => $data['nome'],
                'email' => $data['email'],
                'senha' => Hash::make($data['senha']),
            ]);
        }

        return back()->with('ok', 'Usuário criado com sucesso!');
    }

    public function editUsuario($tipo, $id)
    {
        $this->requireAdmin();

        $user = $tipo === 'aluno' ? Aluno::findOrFail($id) : Admin::findOrFail($id);

        return view('admin.edit_usuario', compact('user', 'tipo'));
    }

    public function updateUsuario(Request $request, $tipo, $id)
    {
        $this->requireAdmin();

        if ($tipo === 'aluno') {
            $user = Aluno::findOrFail($id);
            $data = $request->validate([
                'nome'   => 'required|string|max:100',
                'email'  => 'required|email|unique:alunos,email,' . $id,
                'senha'  => 'nullable|string|min:4',
                'escola' => 'nullable|string|max:50',
                'turma'  => 'nullable|string|max:50',
            ]);
        } else {
            $user = Admin::findOrFail($id);
            $data = $request->validate([
                'nome'  => 'required|string|max:100',
                'email' => 'required|email|unique:admins,email,' . $id,
                'senha' => 'nullable|string|min:4',
            ]);
        }

        if (!empty($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        } else {
            unset($data['senha']);
        }

        $user->update($data);

        return redirect()->route('admin.usuarios')->with('ok', 'Usuário atualizado com sucesso!');
    }

    public function deleteUsuario($tipo, $id)
    {
        $this->requireAdmin();

        if ($tipo === 'aluno') {
            Aluno::findOrFail($id)->delete();
        } else {
            Admin::findOrFail($id)->delete();
        }

        return back()->with('ok', 'Usuário excluído com sucesso!');
    }

    // ---------------- Criar Aluno direto ----------------
    public function createAluno()
    {
        $this->requireAdmin();
        return view('admin.create_aluno');
    }

    public function storeAluno(Request $request)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'nome'   => 'required|string|max:100',
            'email'  => 'required|email|unique:alunos,email',
            'senha'  => 'required|string|min:4',
            'escola' => 'required|string|max:50',
            'turma'  => 'required|string|max:50',
        ]);

        Aluno::create([
            'nome'   => $data['nome'],
            'email'  => $data['email'],
            'senha'  => Hash::make($data['senha']),
            'escola' => $data['escola'],
            'turma'  => $data['turma'],
        ]);

        return redirect()->route('admin.usuarios')->with('ok', 'Aluno criado com sucesso!');
    }
}
