@include('layouts.admin_nav', ['title' => 'Cadastrar Aluno'])
<main class="max-w-4xl mx-auto px-6 py-10">
  <div class="mb-6">
    <h1 class="text-3xl font-black text-red-800 mb-2">Cadastrar Novo Aluno</h1>
    <p class="text-slate-600">Preencha os dados abaixo para criar uma nova conta de aluno.</p>
  </div>

  <section class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">

    @if($errors->any())
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-700 rounded-lg">
        <ul class="list-disc pl-5 text-red-800 space-y-1">
          @foreach($errors->all() as $e)
            <li class="text-sm">{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('ok'))
      <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
        {{ session('ok') }}
      </div>
    @endif

    <form action="{{ route('admin.alunos.store') }}" method="POST" class="space-y-6">
      @csrf

      <div class="grid md:grid-cols-2 gap-6">
        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">Nome</span>
          <input type="text" name="nome" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
        </label>

        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">E-mail</span>
          <input type="email" name="email" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
        </label>
      </div>

      <label class="block">
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Senha</span>
        <input type="password" name="senha" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
      </label>

      <div class="grid md:grid-cols-2 gap-6">
        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">Escola</span>
          <input type="text" name="escola" placeholder="CEEP ou Carrão" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
        </label>

        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">Turma</span>
          <select name="turma" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
            <option value="">Selecione...</option>
            <optgroup label="1º Ano">
              <option value="1º DS">1º IA</option>
              <option value="1º EdF">1º EdF</option>
              <option value="1º Mec">1º Mec</option>
              <option value="1º Enf">1º Enf</option>
            <option value="1º Agro">1º Agro</option>
              <option value="1º Enf">1º Enf</option>
            </optgroup>
            <optgroup label="2º Ano">
              <option value="2º DS">2º DS</option>
              <option value="2º EdF">2º EdF</option>
              <option value="2º Mec">2º Mec</option>
              <option value="2º Agro">2º Agro</option>
            <option value="2º Agro2">2º Agro2</option>
              <option value="2º Enf">2º Enf</option>
            </optgroup>
            <optgroup label="3º Ano">
              <option value="3º DS">3º DS</option>
              <option value="3º EdF">3º EdF</option>
              <option value="3º Mec">3º Mec</option>
              <option value="3º Eletro">3º Eletro</option>
              <option value="3º Agro">3º Agro</option>
            </optgroup>
          </select>
        </label>
      </div>

      <div class="flex gap-4 pt-4">
        <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
          Cadastrar Aluno
        </button>
        <a href="{{ route('admin.usuarios') }}"
           class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
          Cancelar
        </a>
      </div>
    </form>
  </section>
</main>

@include('layouts.footer')
