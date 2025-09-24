@include('layouts.header', ['title' => 'Editar Usuário'])

<section class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-soft p-6">
  <h1 class="text-2xl font-bold mb-4">
    Editar {{ $tipo === 'aluno' ? 'Aluno' : 'Gestor' }}
  </h1>

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

  <form action="{{ route('admin.usuarios.update', ['tipo'=>$tipo, 'id'=>$user->id]) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <label class="block">
      <span class="text-sm font-medium">Nome</span>
      <input type="text" name="nome" value="{{ old('nome', $user->nome) }}"
             class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">E-mail</span>
      <input type="email" name="email" value="{{ old('email', $user->email) }}"
             class="w-full mt-1 rounded border-slate-300" required>
    </label>

    <label class="block">
      <span class="text-sm font-medium">Senha (deixe em branco para não alterar)</span>
      <input type="password" name="senha" class="w-full mt-1 rounded border-slate-300">
    </label>

    @if($tipo === 'aluno')
      <label class="block">
        <span class="text-sm font-medium">Escola</span>
        <input type="text" name="escola" value="{{ old('escola', $user->escola) }}"
               class="w-full mt-1 rounded border-slate-300">
      </label>

      <label class="block">
        <span class="text-sm font-medium">Turma</span>
        <input type="text" name="turma" value="{{ old('turma', $user->turma) }}"
               class="w-full mt-1 rounded border-slate-300">
      </label>
    @endif

    <button class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Atualizar
    </button>
  </form>
</section>

@include('layouts.footer')
