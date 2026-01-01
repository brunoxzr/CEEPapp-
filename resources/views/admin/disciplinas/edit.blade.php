@include('layouts.admin_nav', ['title' => 'Editar Disciplina'])

<main class="flex-1 bg-slate-50 py-10">
  <div class="max-w-3xl mx-auto px-6">

    <h1 class="text-2xl font-black text-red-800 mb-8">
      Editar Disciplina
    </h1>

    <form method="POST"
          action="{{ route('admin.disciplinas.update', $disciplina->id) }}"
          class="bg-white border rounded-2xl p-8 shadow-sm space-y-6">
      @csrf
      @method('PUT')

      <div>
        <label class="text-sm font-bold text-slate-700">Nome</label>
        <input
          type="text"
          name="nome"
          value="{{ $disciplina->nome }}"
          required
          class="mt-2 w-full border rounded-xl px-4 py-3 focus:border-red-600">
      </div>

      <div>
        <label class="text-sm font-bold text-slate-700">Código</label>
        <input
          type="text"
          name="codigo"
          value="{{ $disciplina->codigo }}"
          required
          class="mt-2 w-full border rounded-xl px-4 py-3 font-mono focus:border-red-600">
      </div>

      <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.disciplinas.index') }}"
           class="px-6 py-3 border rounded-xl font-semibold hover:bg-slate-100">
          Voltar
        </a>

        <button
          class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800">
          Atualizar
        </button>
      </div>
    </form>

  </div>
</main>
