@include('layouts.admin_nav', ['title' => 'Gestor — Dashboard'])
@include('layouts.sidebar')
    <section class="max-w-6xl mx-auto px-4 mt-8 grid md:grid-cols-2 gap-6">

    <!-- Criar usuário -->
    <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-yellow-400">
        <h2 class="text-xl font-black text-red-800">Criar Usuário</h2>

        @if(session('ok'))
        <div class="mt-3 p-2 text-sm bg-green-50 border border-green-200 text-green-700 rounded">
            {{ session('ok') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mt-3 p-2 text-sm bg-red-100 border border-red-200 text-red-700 rounded">
            <ul class="list-disc pl-5">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
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
                <option>1º DS</option>
                <option>1º EdF</option>
                <option>1º Mec</option>
                <option>1º Eletro</option>
                <option>1º Enf</option>
                </optgroup>

                <optgroup label="2º Ano">
                <option>2º DS</option>
                <option>2º EdF</option>
                <option>2º Mec</option>
                <option>2º Eletro</option>
                <option>2º Enf</option>
                </optgroup>

                <optgroup label="3º Ano">
                <option>3º DS</option>
                <option>3º EdF</option>
                <option>3º Mec</option>
                <option>3º Eletro</option>
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
    <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-red-700">
        <h2 class="text-xl font-black text-red-800 mb-3">Usuários Existentes</h2>

        <!-- Gestores -->
        <h3 class="font-semibold text-red-700 mb-2">Gestores</h3>
        <table class="min-w-full text-sm mb-6">
        <thead>
            <tr class="bg-red-50 text-red-700 border-b border-red-200">
            <th class="py-2 px-3 text-left">Nome</th>
            <th class="py-2 px-3 text-left">E-mail</th>
            <th class="py-2 px-3 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $a)
            <tr class="border-b border-red-100 hover:bg-red-50/40">
            <td class="py-2 px-3">{{ $a->nome }}</td>
            <td class="py-2 px-3">{{ $a->email }}</td>
            <td class="py-2 px-3 text-center space-x-2">
                <a href="{{ route('admin.usuarios.edit', ['id' => $a->id, 'tipo'=>'admin']) }}"
                class="text-yellow-600 font-semibold hover:underline">Editar</a>

                <form action="{{ route('admin.usuarios.delete', ['id'=>$a->id, 'tipo'=>'admin']) }}"
                    method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-700 font-semibold hover:underline">Excluir</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <!-- Alunos -->
        <h3 class="font-semibold text-red-700 mb-2">Alunos</h3>
        <table class="min-w-full text-sm">
        <thead>
            <tr class="bg-red-50 text-red-700 border-b border-red-200">
            <th class="py-2 px-3 text-left">Nome</th>
            <th class="py-2 px-3 text-left">E-mail</th>
            <th class="py-2 px-3 text-left">Escola</th>
            <th class="py-2 px-3 text-left">Turma</th>
            <th class="py-2 px-3 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $al)
            <tr class="border-b border-red-100 hover:bg-red-50/40">
            <td class="py-2 px-3">{{ $al->nome }}</td>
            <td class="py-2 px-3">{{ $al->email }}</td>
            <td class="py-2 px-3">{{ $al->escola }}</td>
            <td class="py-2 px-3">{{ $al->turma }}</td>
            <td class="py-2 px-3 text-center space-x-2">
                <a href="{{ route('admin.usuarios.edit', ['id' => $al->id, 'tipo'=>'aluno']) }}"
                class="text-yellow-600 font-semibold hover:underline">Editar</a>

                <form action="{{ route('admin.usuarios.delete', ['id'=>$al->id, 'tipo'=>'aluno']) }}"
                    method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-700 font-semibold hover:underline">Excluir</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>

    </div>
    </section>

    @include('layouts.footer')

    <script>
    const tipo = document.querySelector('select[name="tipo"]');
    const extra = document.getElementById('extraAluno');
    tipo.addEventListener('change', () => {
        extra.classList.toggle('hidden', tipo.value !== 'aluno');
    });
    </script>
