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
        <h3 class="mt-6 font-black text-lg">Carga horária por disciplina</h3>

<table class="w-full mt-3 border text-sm">
  <thead class="bg-slate-100">
    <tr>
      <th class="border p-2">Disciplina</th>
      <th class="border p-2 w-40">Máx. aulas/semana</th>
    </tr>
  </thead>

  <tbody>
    @foreach($disciplinas as $disc)
      @php
        $pivot = $professor->disciplinas->firstWhere('id', $disc->id)?->pivot;
      @endphp
      <tr>
        <td class="border p-2">{{ $disc->nome }}</td>
        <td class="border p-2 text-center">
          <input
            type="number"
            name="carga[{{ $disc->id }}]"
            min="0"
            max="40"
            value="{{ $pivot->carga_horaria_max ?? '' }}"
            class="w-20 border rounded px-2 py-1 text-center">
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

      </div>
    </form>

  </div>
</main>
