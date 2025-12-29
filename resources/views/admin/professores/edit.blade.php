@include('layouts.admin_nav', ['title' => 'Editar Professor'])
@include('layouts.sidebar')

<main class="bg-slate-50 py-10">
  <div class="max-w-3xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-800 mb-2">
      {{ $professor->nome }}
    </h1>
    <p class="text-slate-600 mb-8">
      Atribuição de disciplinas
    </p>

    <form method="POST"
          action="{{ route('admin.professores.salvar', $professor->id) }}"
          class="bg-white border rounded-2xl p-6 shadow">
      @csrf

      <div class="grid sm:grid-cols-2 gap-4">
        @foreach($disciplinas as $d)
          <label class="flex items-center gap-3 p-4 border rounded-xl hover:bg-slate-50 cursor-pointer">
            <input type="checkbox"
                   name="disciplinas[]"
                   value="{{ $d->id }}"
                   class="w-5 h-5 accent-red-700"
                   {{ $professor->disciplinas->contains($d->id) ? 'checked' : '' }}>
            <span class="font-semibold text-slate-800">
              {{ $d->nome }}
            </span>
          </label>
        @endforeach
      </div>

      <div class="mt-6 flex justify-between items-center">
        <a href="{{ route('admin.professores') }}"
           class="text-sm font-bold text-slate-600 hover:underline">
          ← Voltar
        </a>

        <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
          Salvar disciplinas
        </button>
      </div>
    </form>

  </div>
</main>
