@include('layouts.admin_nav', ['title' => 'Editar Professor'])


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
{{-- ================= DISTRIBUIÇÃO POR TURMA (DISCIPLINAS + AULAS/SEMANA) ================= --}}
<div>
  <h3 class="font-black text-lg mb-3">
    Disciplinas por turma <span class="text-sm text-slate-500">(o que o professor realmente leciona)</span>
  </h3>

  <p class="text-sm text-slate-500 mb-5">
    Aqui você define quais matérias ele dá em cada turma e quantas aulas por semana.
    É ISSO que o gerador usa pra distribuir.
  </p>

  <div class="space-y-4">
    @foreach($professor->turmas as $rel)
      @php $turma = $rel->turma; @endphp

      <div class="border rounded-2xl p-4 bg-slate-50">
        <div class="flex items-center justify-between">
          <h4 class="font-black text-slate-900">{{ $turma }}</h4>
          <span class="text-xs text-slate-500">Máx nesta turma: {{ $rel->carga_max ?? '—' }}</span>
        </div>

        <div class="mt-3 grid md:grid-cols-2 gap-3">
          @foreach($professor->disciplinas as $disc)
            @php
              // você vai preencher isso vindo do banco depois
              $key = $turma.'|'.$disc->id;
              $valor = $vinculos[$key] ?? null; // ex: aulas_semana
            @endphp

            <div class="border rounded-xl p-3 bg-white flex items-center justify-between gap-3">
              <div class="min-w-0">
                <p class="font-semibold text-slate-800 truncate">{{ $disc->nome }}</p>
                <p class="text-xs text-slate-500">Aulas/semana nesta turma</p>
              </div>

              <input type="number"
                     min="0"
                     max="10"
                     name="turma_disc[{{ $turma }}][{{ $disc->id }}]"
                     value="{{ $valor ?? 0 }}"
                     class="w-20 border rounded-lg px-2 py-1 text-center">
            </div>
          @endforeach
        </div>

        <p class="mt-2 text-xs text-slate-500">
          Dica: coloque 0 nas matérias que ele NÃO dá nessa turma.
        </p>
      </div>
    @endforeach
  </div>
</div>
<div>
  <h3 class="font-black text-lg mb-3">Aulas seguidas (regras)</h3>

  <div id="seqWrap" class="space-y-3">
    @foreach($professor->seqRules as $i => $rule)
      <div class="grid grid-cols-4 gap-3">
        <select name="seq_rules[{{ $i }}][disciplina_id]" class="border rounded-xl p-2" required>
          @foreach($professor->disciplinas as $d)
            <option value="{{ $d->id }}"
              {{ $rule->disciplina_id == $d->id ? 'selected' : '' }}>
              {{ $d->nome }}
            </option>
          @endforeach
        </select>

        <select name="seq_rules[{{ $i }}][turma]" class="border rounded-xl p-2">
          <option value="">Todas turmas</option>
          @foreach($professor->turmas as $t)
            <option value="{{ $t->turma }}"
              {{ $rule->turma === $t->turma ? 'selected' : '' }}>
              {{ $t->turma }}
            </option>
          @endforeach
        </select>

        <select name="seq_rules[{{ $i }}][dia]" class="border rounded-xl p-2">
          <option value="">Todos dias</option>
          @foreach(['Segunda','Terça','Quarta','Quinta','Sexta'] as $d)
            <option value="{{ $d }}"
              {{ $rule->dia_semana === $d ? 'selected' : '' }}>
              {{ $d }}
            </option>
          @endforeach
        </select>

        <input type="number"
               min="1"
               max="6"
               name="seq_rules[{{ $i }}][max]"
               value="{{ $rule->max_seguidas }}"
               class="border rounded-xl p-2">
      </div>
    @endforeach
  </div>

  <button type="button"
          class="mt-3 px-4 py-2 rounded-xl bg-slate-900 text-white font-bold"
          onclick="addSeqRule()">
    + Adicionar regra
  </button>
</div>

<script>
let seqIndex = 1;
function addSeqRule(){
  const wrap = document.getElementById('seqWrap');
  const html = `
    <div class="grid grid-cols-4 gap-3">
      <select name="seq_rules[${seqIndex}][disciplina_id]" class="border rounded-xl p-2" required>
        <option value="">Disciplina</option>
        @foreach($professor->disciplinas as $d)
          <option value="{{ $d->id }}">{{ $d->nome }}</option>
        @endforeach
      </select>

      <select name="seq_rules[${seqIndex}][turma]" class="border rounded-xl p-2">
        <option value="">Todas turmas</option>
        @foreach($professor->turmas as $t)
          <option value="{{ $t->turma }}">{{ $t->turma }}</option>
        @endforeach
      </select>

      <select name="seq_rules[${seqIndex}][dia]" class="border rounded-xl p-2">
        <option value="">Todos dias</option>
        @foreach(['Segunda','Terça','Quarta','Quinta','Sexta'] as $d)
          <option value="{{ $d }}">{{ $d }}</option>
        @endforeach
      </select>

      <input type="number" min="1" max="6"
             name="seq_rules[${seqIndex}][max]"
             class="border rounded-xl p-2"
             placeholder="Máx seguidas" required>
    </div>
  `;
  wrap.insertAdjacentHTML('beforeend', html);
  seqIndex++;
}
</script>

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
