@include('layouts.admin_nav', ['title' => 'Editar Professor'])
@include('layouts.sidebar')

<main class="bg-slate-50 py-10">
  <div class="max-w-5xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-800 mb-2">
      {{ $professor->nome }}
    </h1>
    <p class="text-slate-600 mb-8">
      Disciplinas, carga horária e turmas atendidas
    </p>

    <form method="POST"
          action="{{ route('admin.professores.salvar', $professor->id) }}"
          class="bg-white border rounded-2xl p-6 shadow space-y-10">
      @csrf

      {{-- ================= DISCIPLINAS ================= --}}
      <div>
        <h3 class="font-black text-lg mb-3">Disciplinas</h3>

        <div class="grid sm:grid-cols-2 gap-4">
          @foreach($disciplinas as $d)
            <label class="flex items-center gap-3 p-4 border rounded-xl hover:bg-slate-50 cursor-pointer">
              <input type="checkbox"
                     class="disc-checkbox w-5 h-5 accent-red-700"
                     name="disciplinas[]"
                     value="{{ $d->id }}"
                     data-disc="{{ $d->id }}"
                     {{ $professor->disciplinas->contains($d->id) ? 'checked' : '' }}>

              <span class="font-semibold text-slate-800">
                {{ $d->nome }}
              </span>
            </label>
          @endforeach
        </div>
      </div>

      {{-- ================= CARGA POR DISCIPLINA ================= --}}
      <div>
        <h3 class="font-black text-lg mb-3">
          Carga horária máxima por disciplina
        </h3>

        <table class="w-full border text-sm">
          <thead class="bg-slate-100">
            <tr>
              <th class="border p-2 text-left">Disciplina</th>
              <th class="border p-2 w-40 text-center">Aulas/semana</th>
            </tr>
          </thead>
          <tbody>
            @foreach($disciplinas as $disc)
              @php
                $pivot = $professor->disciplinas->firstWhere('id', $disc->id)?->pivot;
                $checked = $professor->disciplinas->contains($disc->id);
              @endphp
              <tr>
                <td class="border p-2">{{ $disc->nome }}</td>
                <td class="border p-2 text-center">
                  <input
                    type="number"
                    min="1"
                    max="40"
                    name="carga[{{ $disc->id }}]"
                    data-carga="{{ $disc->id }}"
                    value="{{ $pivot->carga_horaria_max ?? '' }}"
                    class="w-24 border rounded px-2 py-1 text-center"
                    {{ $checked ? '' : 'disabled' }}>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- ================= TURMAS + CARGA ================= --}}
      <div>
        <h3 class="font-black text-lg mb-3">
          Turmas atendidas <span class="text-sm text-slate-500">(carga máxima)</span>
        </h3>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
          @foreach($turmas as $turma)
            @php
              $rel = $professor->turmas->firstWhere('turma', $turma);
            @endphp

            <div class="border rounded-xl p-4 space-y-2">
              <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox"
                       name="turmas[{{ $turma }}][ativo]"
                       class="turma-checkbox w-5 h-5 accent-emerald-600"
                       data-turma="{{ $turma }}"
                       {{ $rel ? 'checked' : '' }}>

                <span class="font-semibold text-slate-800">
                  {{ $turma }}
                </span>
              </label>

              <div class="pl-8">
                <label class="text-xs text-slate-500 block mb-1">
                  Máx. aulas nesta turma
                </label>

                <input
                  type="number"
                  min="1"
                  max="40"
                  name="turmas[{{ $turma }}][carga]"
                  data-carga-turma="{{ $turma }}"
                  value="{{ $rel->carga_max ?? '' }}"
                  class="w-24 border rounded px-2 py-1 text-sm"
                  {{ $rel ? '' : 'disabled' }}>
              </div>
            </div>
          @endforeach
        </div>

        <p class="text-xs text-slate-500 mt-3">
          ⚠️ O gerador respeita exatamente essa carga por turma.
        </p>
      </div>

      {{-- ================= AÇÕES ================= --}}
      <div class="flex justify-between items-center pt-6">
        <a href="{{ route('admin.professores') }}"
           class="text-sm font-bold text-slate-600 hover:underline">
          ← Voltar
        </a>

        <button
          type="submit"
          class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
          Salvar professor
        </button>
      </div>

    </form>
  </div>
</main>

{{-- ================= SCRIPT ================= --}}
<script>
/* DISCIPLINAS */
document.querySelectorAll('.disc-checkbox').forEach(cb => {
  const id = cb.dataset.disc;
  const input = document.querySelector(`[data-carga="${id}"]`);

  function sync() {
    if (cb.checked) {
      input.disabled = false;
      input.required = true;
    } else {
      input.disabled = true;
      input.required = false;
      input.value = '';
    }
  }

  cb.addEventListener('change', sync);
  sync();
});

/* TURMAS */
document.querySelectorAll('.turma-checkbox').forEach(cb => {
  const turma = cb.dataset.turma;
  const input = document.querySelector(`[data-carga-turma="${CSS.escape(turma)}"]`);

  function sync() {
    if (cb.checked) {
      input.disabled = false;
      input.required = true;
    } else {
      input.disabled = true;
      input.required = false;
      input.value = '';
    }
  }

  cb.addEventListener('change', sync);
  sync();
});
</script>
