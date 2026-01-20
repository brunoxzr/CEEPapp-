@include('layouts.admin_nav', ['title' => 'Gerenciar Usuários'])
<main class="max-w-7xl mx-auto px-6 py-10">
  <div class="mb-8">
    <h1 class="text-3xl font-black text-red-800 mb-2">Gerenciar Usuários</h1>
    <p class="text-slate-600">Crie e gerencie contas de alunos e gestores do sistema.</p>
  </div>

  <section class="grid md:grid-cols-2 gap-8">

    <!-- Criar usuário -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-yellow-400">
        <h2 class="text-xl font-black text-red-800 mb-6">Criar Usuário</h2>

        @if(session('ok'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
            {{ session('ok') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-red-800 space-y-1">
            @foreach($errors->all() as $e)
                <li class="text-sm">{{ $e }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.usuarios.store') }}" method="POST" class="grid grid-cols-2 gap-4 mt-4">
        @csrf

        <!-- Tipo de conta -->
        <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">Tipo de Conta</span>
            <select name="tipo"
            class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
            <option value="aluno">Aluno</option>
            <option value="admin">Gestor</option>
            </select>
        </label>

        <!-- Nome -->
        <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">Nome</span>
            <input type="text" name="nome" required
            class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
        </label>

        <!-- E-mail -->
        <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">E-mail</span>
            <input type="email" name="email" required
            class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
        </label>

        <!-- Senha -->
        <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">Senha</span>
            <input type="password" name="senha" required
            class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
        </label>

        <!-- Extra aluno -->
        <div id="extraAluno" class="col-span-2 hidden">
            <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">Escola</span>
            <input type="text" name="escola"
                class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                placeholder="CEEP">
            </label>

            <label class="col-span-2">
            <span class="text-sm font-semibold text-red-800">Turma</span>
            <select name="turma"
                class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                <option value="">Selecione...</option>

                <optgroup label="1º Ano">
                <option>1º IA</option>
                <option>1º EDF</option>
                <option>1º MEC</option>
                <option>1º Agro</option>
                </optgroup>

                <optgroup label="2º Ano">
                <option>2º DS</option>
                <option>2º EDF</option>
                <option>2º MEC</option>
                <option>2º Agro</option>
                <option>2º Agro2</option>
                </optgroup>

                <optgroup label="3º Ano">
                <option>3º DS</option>
                <option>3º EDF</option>
                <option>3º MEC</option>
                <option>3º Eletro</option>
                <option>3º Agro</option>
                <option>3º Enf</option>
                </optgroup>
            </select>
            </label>
        </div>

        <div class="col-span-2">
            <button
            class="px-4 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition border border-yellow-500">
            Criar Usuário
            </button>
        </div>
        </form>
    </div>

    <!-- Lista de usuários -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-red-700">
        <h2 class="text-xl font-black text-red-800 mb-6">Usuários Existentes</h2>

        <!-- Gestores -->
        <h3 class="font-bold text-red-800 mb-4 text-lg">Gestores</h3>
        <div class="overflow-x-auto rounded-lg border border-slate-200 mb-8">
          <table class="min-w-full text-sm">
            <thead class="bg-red-50 text-red-800">
              <tr>
                <th class="py-3 px-4 text-left font-semibold">Nome</th>
                <th class="py-3 px-4 text-left font-semibold">E-mail</th>
                <th class="py-3 px-4 text-center font-semibold">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @foreach($admins as $a)
              <tr class="hover:bg-red-50/40 transition">
                <td class="py-3 px-4 font-medium text-slate-800">{{ $a->nome }}</td>
                <td class="py-3 px-4 text-slate-700">{{ $a->email }}</td>
                <td class="py-3 px-4 text-center space-x-3">
                  <a href="{{ route('admin.usuarios.edit', ['id' => $a->id, 'tipo'=>'admin']) }}"
                    class="text-yellow-600 font-semibold hover:text-yellow-700 hover:underline">Editar</a>
                  <form action="{{ route('admin.usuarios.delete', ['id'=>$a->id, 'tipo'=>'admin']) }}"
                      method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-700 font-semibold hover:text-red-800 hover:underline">Excluir</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Alunos -->
        <h3 class="font-bold text-red-800 mb-4 text-lg">Alunos</h3>
        <div class="overflow-x-auto rounded-lg border border-slate-200">
          <table class="min-w-full text-sm">
            <thead class="bg-red-50 text-red-800">
              <tr>
                <th class="py-3 px-4 text-left font-semibold">Nome</th>
                <th class="py-3 px-4 text-left font-semibold">E-mail</th>
                <th class="py-3 px-4 text-left font-semibold">Escola</th>
                <th class="py-3 px-4 text-left font-semibold">Turma</th>
                <th class="py-3 px-4 text-center font-semibold">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @foreach($alunos as $al)
              <tr class="hover:bg-red-50/40 transition">
                <td class="py-3 px-4 font-medium text-slate-800">{{ $al->nome }}</td>
                <td class="py-3 px-4 text-slate-700">{{ $al->email }}</td>
                <td class="py-3 px-4 text-slate-700">{{ $al->escola }}</td>
                <td class="py-3 px-4 text-slate-700">{{ $al->turma }}</td>
                <td class="py-3 px-4 text-center space-x-3">
                  <a href="{{ route('admin.usuarios.edit', ['id' => $al->id, 'tipo'=>'aluno']) }}"
                    class="text-yellow-600 font-semibold hover:text-yellow-700 hover:underline">Editar</a>
                  <form action="{{ route('admin.usuarios.delete', ['id'=>$al->id, 'tipo'=>'aluno']) }}"
                      method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-700 font-semibold hover:text-red-800 hover:underline">Excluir</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

    </div>
  </section>
</main>

@include('layouts.footer')

    <script>
    const tipo = document.querySelector('select[name="tipo"]');
    const extra = document.getElementById('extraAluno');
    tipo.addEventListener('change', () => {
        extra.classList.toggle('hidden', tipo.value !== 'aluno');
    });
    </script>
