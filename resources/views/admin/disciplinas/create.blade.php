@include('layouts.admin_nav', ['title' => 'Nova Disciplina'])
@include('layouts.sidebar')

<main class="flex-1 bg-slate-50 py-10">
  <div class="max-w-3xl mx-auto px-6">

    <h1 class="text-2xl font-black text-red-800 mb-8">
      Nova Disciplina
    </h1>

    <form method="POST"
          action="{{ route('admin.disciplinas.store') }}"
          class="bg-white border rounded-2xl p-8 shadow-sm space-y-6">
      @csrf

      <div>
        <label class="text-sm font-bold text-slate-700">Nome</label>
        <input
          type="text"
          name="nome"
          required
          class="mt-2 w-full border rounded-xl px-4 py-3 focus:border-red-600"
          placeholder="Ex: Matemática">
      </div>

      <div>
        <label class="text-sm font-bold text-slate-700">Código</label>
        <input
          type="text"
          name="codigo"
          required
          class="mt-2 w-full border rounded-xl px-4 py-3 font-mono focus:border-red-600"
          placeholder="Ex: MAT">
      </div>

      <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.disciplinas.index') }}"
           class="px-6 py-3 border rounded-xl font-semibold hover:bg-slate-100">
          Cancelar
        </a>

        <button
          class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800">
          Salvar
        </button>
      </div>
    </form>

  </div>
</main>
