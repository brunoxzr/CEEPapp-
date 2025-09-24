@include('layouts.header', ['title' => 'Cadastrar Aluno'])

<section class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-soft p-6">
  <h1 class="text-2xl font-bold mb-4">Cadastrar Novo Aluno</h1>

  @if($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('ok'))
    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
      {{ session('ok') }}
    </div>
  @endif

  <form action="{{ route('admin.alunos.store') }}" method="POST" class="space-y-4">
    @csrf
    <label class="block">
      <span class="text-sm font-medium">Nome</span>
      <input type="text" name="nome" class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">E-mail</span>
      <input type="email" name="email" class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">Senha</span>
      <input type="password" name="senha" class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">Escola</span>
      <input type="text" name="escola" placeholder="CEEP ou Carrão" class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">Turma</span>
      <select name="turma" class="w-full mt-1 rounded border-slate-300" required>
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

    <button class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Cadastrar</button>
  </form>
</section>

@include('layouts.footer')
