@include('layouts.admin_nav', ['title' => 'Editar Usuário'])
<main class="max-w-4xl mx-auto px-6 py-10">
  <div class="mb-6">
    <h1 class="text-3xl font-black text-red-800 mb-2">
      Editar {{ $tipo === 'aluno' ? 'Aluno' : 'Gestor' }}
    </h1>
    <p class="text-slate-600">
      Atualize as informações do usuário abaixo.
    </p>
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

    <form action="{{ route('admin.usuarios.update', ['tipo'=>$tipo, 'id'=>$user->id]) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      <div class="grid md:grid-cols-2 gap-6">
        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">Nome</span>
          <input type="text" name="nome" value="{{ old('nome', $user->nome) }}"
                 class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
        </label>

        <label class="block">
          <span class="text-sm font-semibold text-slate-700 mb-2 block">E-mail</span>
          <input type="email" name="email" value="{{ old('email', $user->email) }}"
                 class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
        </label>
      </div>

      <label class="block">
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Senha</span>
        <input type="password" name="senha" minlength="8" autocomplete="new-password"
               placeholder="Deixe em branco para não alterar"
               class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
        <p class="text-xs text-slate-500 mt-1">Deixe em branco para manter a senha atual</p>
      </label>

      @if($tipo === 'aluno')
        <div class="grid md:grid-cols-2 gap-6">
          <label class="block">
            <span class="text-sm font-semibold text-slate-700 mb-2 block">Escola</span>
            <input type="text" name="escola" value="{{ old('escola', $user->escola) }}"
                   class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
          </label>

          <label class="block">
            <span class="text-sm font-semibold text-slate-700 mb-2 block">Turma</span>
            <input type="text" name="turma" value="{{ old('turma', $user->turma) }}"
                   class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
          </label>
        </div>
      @endif

      <div class="flex gap-4 pt-4">
        <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
          Atualizar Usuário
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
