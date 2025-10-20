@include('layouts.header', ['title' => 'Gerenciar Usuários'])

<section class="max-w-6xl mx-auto px-4 mt-8 grid md:grid-cols-2 gap-6">
  <!-- Criar usuário -->
  <div class="bg-white rounded-xl shadow-soft p-6">
    <h2 class="text-xl font-bold">Criar Usuário</h2>

    @if(session('ok'))
      <div class="mt-3 p-2 text-sm bg-green-50 border border-green-200 text-green-700 rounded">{{ session('ok') }}</div>
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
        <span class="text-sm font-medium">Tipo de Conta</span>
        <select name="tipo" class="mt-1 w-full rounded border-slate-300">
          <option value="aluno">Aluno</option>
          <option value="admin">Gestor</option>
        </select>
      </label>

      <!-- Nome -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Nome</span>
        <input type="text" name="nome" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- E-mail -->
      <label class="col-span-2">
        <span class="text-sm font-medium">E-mail</span>
        <input type="email" name="email" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Senha -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Senha</span>
        <input type="password" name="senha" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Extra: só aparece se for aluno -->
      <div id="extraAluno" class="col-span-2 hidden">
        <label class="col-span-2">
          <span class="text-sm font-medium">Escola</span>
          <input type="text" name="escola" class="mt-1 w-full rounded border-slate-300" placeholder="CEEP ou Carrão">
        </label>

        <label class="col-span-2">
          <span class="text-sm font-medium">Turma</span>
          <select name="turma" class="mt-1 w-full rounded border-slate-300">
            <option value="">Selecione...</option>
            <optgroup label="1º Ano">
              <option value="1º DS">1º DS</option>
              <option value="1º EdF">1º EdF</option>
              <option value="1º Mec">1º Mec</option>
              <option value="1º Eletro">1º Eletro</option>
              <option value="1º Enf">1º Enf</option>
            </optgroup>
            <optgroup label="2º Ano">
              <option value="2º DS">2º DS</option>
              <option value="2º EdF">2º EdF</option>
              <option value="2º Mec">2º Mec</option>
              <option value="2º Eletro">2º Eletro</option>
              <option value="2º Enf">2º Enf</option>
            </optgroup>
            <optgroup label="3º Ano">
              <option value="3º DS">3º DS</option>
              <option value="3º EdF">3º EdF</option>
              <option value="3º Mec">3º Mec</option>
              <option value="3º Eletro">3º Eletro</option>
              <option value="3º Enf">3º Enf</option>
            </optgroup>
          </select>
        </label>
      </div>

      <div class="col-span-2">
        <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
          Criar Usuário
        </button>
      </div>
    </form>
  </div>

  <!-- Lista de usuários -->
  <div class="bg-white rounded-xl shadow-soft p-6 overflow-x-auto">
    <h2 class="text-xl font-bold mb-3">Usuários Existentes</h2>

    <!-- Gestores -->
    <h3 class="font-semibold mb-2">Gestores</h3>
    <table class="min-w-full text-sm mb-6">
      <thead>
        <tr class="bg-slate-100 text-slate-700">
          <th class="py-2 px-3 text-left">Nome</th>
          <th class="py-2 px-3 text-left">E-mail</th>
          <th class="py-2 px-3 text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $a)
        <tr class="border-b hover:bg-slate-50">
          <td class="py-2 px-3">{{ $a->nome }}</td>
          <td class="py-2 px-3">{{ $a->email }}</td>
          <td class="py-2 px-3 text-center space-x-2">
            <a href="{{ route('admin.usuarios.edit', ['id' => $a->id, 'tipo'=>'admin']) }}" class="text-blue-600 hover:underline">Editar</a>
            <form action="{{ route('admin.usuarios.delete', ['id'=>$a->id, 'tipo'=>'admin']) }}" method="POST" class="inline">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Excluir</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Alunos -->
    <h3 class="font-semibold mb-2">Alunos</h3>
    <table class="min-w-full text-sm">
      <thead>
        <tr class="bg-slate-100 text-slate-700">
          <th class="py-2 px-3 text-left">Nome</th>
          <th class="py-2 px-3 text-left">E-mail</th>
          <th class="py-2 px-3 text-left">Escola</th>
          <th class="py-2 px-3 text-left">Turma</th>
          <th class="py-2 px-3 text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($alunos as $al)
        <tr class="border-b hover:bg-slate-50">
          <td class="py-2 px-3">{{ $al->nome }}</td>
          <td class="py-2 px-3">{{ $al->email }}</td>
          <td class="py-2 px-3">{{ $al->escola }}</td>
          <td class="py-2 px-3">{{ $al->turma }}</td>
          <td class="py-2 px-3 text-center space-x-2">
            <a href="{{ route('admin.usuarios.edit', ['id' => $al->id, 'tipo'=>'aluno']) }}" class="text-blue-600 hover:underline">Editar</a>
            <form action="{{ route('admin.usuarios.delete', ['id'=>$al->id, 'tipo'=>'aluno']) }}" method="POST" class="inline">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Excluir</button>
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
