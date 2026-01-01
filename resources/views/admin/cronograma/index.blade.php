@include('layouts.admin_nav', ['title' => 'Cronograma — Grade Visual'])

@php
  $aulasInfo = $aulas;
@endphp

<section class="max-w-7xl mx-auto px-4 mt-8 space-y-6">

{{-- ================= HEADER ================= --}}
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

<div class="flex gap-3">
  {{-- GERAR --}}
  <form method="POST" action="{{ route('admin.cronograma.gerar') }}">
    @csrf
    <button
      type="submit"
      class="px-4 py-2 rounded-xl font-black
             bg-emerald-600 text-white
             hover:bg-emerald-700
             active:scale-95 transition">
      Gerar cronograma automático
    </button>
  </form>

  {{-- APAGAR TUDO --}}
  <form method="POST"
        action="{{ route('admin.cronograma.apagarTudo') }}"
        onsubmit="return confirm('⚠️ Isso irá APAGAR TODO o cronograma de todas as turmas. Deseja continuar?')">
    @csrf
    @method('DELETE')

    <button
      type="submit"
      class="px-4 py-2 rounded-xl font-black
             bg-red-600 text-white
             hover:bg-red-700
             active:scale-95 transition">
      Apagar tudo
    </button>
  </form>
</div>


</div>

{{-- ================= BANCO DE BLOCOS ================= --}}
<div class="grid lg:grid-cols-3 gap-6">

  {{-- ====== BLOCOS ====== --}}
  <div class="lg:col-span-2 bg-white border rounded-2xl p-5 shadow-sm">
    <h2 class="text-lg font-black text-slate-900 mb-3">
      Blocos (Professores + Disciplinas)
    </h2>

    <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-3 max-h-[360px] overflow-auto">
      @forelse($professores as $p)
        @foreach($p->disciplinas as $d)
          @php
            $info = $p->cargaInfo($d);
          @endphp

          <div
            draggable="true"
            ondragstart="dragStart(event)"
            data-disciplina="{{ $d->nome }}"
            data-professor="{{ $p->nome }}"
            class="cursor-grab select-none border rounded-xl p-3 bg-slate-50 hover:bg-slate-100 active:cursor-grabbing">

            <p class="font-black text-red-800">{{ $d->nome }}</p>
            <p class="text-xs text-slate-600 mb-1">{{ $p->nome }}</p>

            {{-- INDICADOR DE CARGA --}}
            @if($info['max'])
              <div class="w-full h-2 bg-slate-200 rounded overflow-hidden">
                <div
                  class="h-2
                    {{ $info['percentual'] < 70 ? 'bg-emerald-500' :
                       ($info['percentual'] < 90 ? 'bg-amber-400' : 'bg-red-500') }}"
                  style="width: {{ $info['percentual'] }}%">
                </div>
              </div>
              <p class="text-[10px] text-slate-600 mt-1">
                {{ $info['usada'] }} / {{ $info['max'] }} aulas
              </p>
            @else
              <p class="text-[10px] text-slate-500 italic">
                {{ $info['usada'] }} aulas (sem limite)
              </p>
            @endif

          </div>
        @endforeach
      @empty
        <p class="text-sm text-slate-500">Nenhum professor com disciplinas.</p>
      @endforelse
    </div>

{{-- ================= GRADE DO CRONOGRAMA ================= --}}
<div class="bg-white border rounded-2xl p-4 shadow-sm overflow-x-auto mt-6">
  <table class="min-w-[1600px] w-full border text-sm">

    {{-- ===== CABEÇALHO ===== --}}
    <thead>
      {{-- LINHA 1 — DIAS --}}
      <tr class="bg-slate-200">
        <th rowspan="2"
            class="border p-2 w-[160px] font-black text-left">
          Turma
        </th>

        @foreach($dias as $diaNome)
          <th colspan="{{ count($aulasInfo) }}"
              class="border p-2 text-center font-black text-red-800">
            {{ $diaNome }}
          </th>
        @endforeach
      </tr>

      {{-- LINHA 2 — AULAS --}}
      <tr class="bg-slate-100">
        @foreach($dias as $_)
          @foreach($aulasInfo as $num => [$ini,$fim])
            <th class="border p-1 text-xs font-semibold text-slate-600">
              {{ $num }}ª
            </th>
          @endforeach
        @endforeach
      </tr>
    </thead>
<tbody>
@php
  /**
   * Agrupa turmas por ANO
   * Ex: "1º Agro" → ano = 1
   */
  $turmasPorAno = [];

  foreach ($turmas as $t) {
    preg_match('/^(\d+)/', $t, $m);
    $ano = $m[1] ?? 'X';
    $turmasPorAno[$ano][] = $t;
  }

  // cores por ano
  $coresAno = [
    '1' => 'bg-blue-50',
    '2' => 'bg-emerald-50',
    '3' => 'bg-amber-50',
    '4' => 'bg-violet-50',
  ];
@endphp

@foreach($turmasPorAno as $ano => $listaTurmas)

  {{-- LINHA DIVISÓRIA DO ANO --}}
  <tr>
    <td colspan="{{ 1 + count($dias)*count($aulasInfo) }}"
        class="border p-2 font-black text-slate-700 bg-slate-200">
      {{ $ano }}º Ano
    </td>
  </tr>

  {{-- TURMAS DO ANO --}}
  @foreach($listaTurmas as $t)
    <tr class="{{ $coresAno[$ano] ?? 'bg-slate-50' }}">

      {{-- COLUNA TURMA --}}
      <td class="border p-2 font-black">
        {{ $t }}
      </td>

      {{-- DIAS × AULAS --}}
      @foreach($dias as $diaNome)
        @foreach($aulasInfo as $num => [$ini,$fim])

          @php
            $slot = $map[$t.'|'.$num.'|'.$diaNome] ?? null;
          @endphp

          <td class="border h-20 p-1 align-top text-xs"
              data-dia="{{ $diaNome }}"
              data-turma="{{ $t }}"
              data-aula="{{ $num }}"
              data-inicio="{{ $ini }}"
              data-fim="{{ $fim }}"
              ondragover="allowDrop(event)"
              ondrop="dropCell(event)">

            @if($slot)
              <div draggable="true"
                   ondragstart="dragStart(event)"
                   data-from-dia="{{ $diaNome }}"
                   data-from-turma="{{ $t }}"
                   data-from-aula="{{ $num }}"
                   data-disciplina="{{ $slot->disciplina }}"
                   data-professor="{{ $slot->professor }}"
                   class="slotBlock bg-red-100 border border-red-300 rounded p-1 cursor-grab">

                <p class="font-black text-red-800 leading-tight">
                  {{ $slot->disciplina }}
                </p>
                <p class="text-[10px] text-red-700">
                  {{ $slot->professor }}
                </p>
              </div>
            @else
              <span class="text-[10px] text-slate-400 font-semibold">
                Solte
              </span>
            @endif

          </td>

        @endforeach
      @endforeach

    </tr>
  @endforeach

@endforeach
</tbody>


  </table>
</div>

  {{-- ====== LIXEIRA ====== --}}
  <div class="bg-white border rounded-2xl p-5 shadow-sm">
    <h2 class="text-lg font-black text-slate-900">Remover</h2>

    <div id="trash"
         ondragover="allowDrop(event)"
         ondrop="dropTrash(event)"
         class="mt-4 h-40 rounded-2xl border-2 border-dashed border-red-300
                flex items-center justify-center text-red-700 font-black bg-red-50/40">
      LIXEIRA
    </div>

    <div id="toast"
         class="hidden mt-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200
                text-emerald-800 text-sm font-semibold">
      Salvo.
    </div>
  </div>

</div><script>
/* =========================================================
   UTIL – HORÁRIO EM MINUTOS (REGRA DE OURO)
========================================================= */
function timeToMinutes(t) {
  if (!t) return null;
  t = String(t).trim();
  const [h, m] = t.split(':').map(Number);
  if (isNaN(h) || isNaN(m)) return null;
  return h * 60 + m;
}

/* =========================================================
   TOAST
========================================================= */
const toast = document.getElementById('toast');

function showToast(msg = 'Salvo.') {
  if (!toast) return;
  toast.textContent = msg;
  toast.classList.remove('hidden');
  clearTimeout(window.__toastTimer);
  window.__toastTimer = setTimeout(() => {
    toast.classList.add('hidden');
  }, 1600);
}

/* =========================================================
   DRAG BASICS
========================================================= */
function allowDrop(ev) {
  ev.preventDefault();
}

function dragStart(ev) {
  const el = ev.currentTarget;

  const payload = {
    disciplina: el.dataset.disciplina || '',
    professor: el.dataset.professor || '',
    from: {
      dia: el.dataset.fromDia || null,
      turma: el.dataset.fromTurma || null,
      aula: el.dataset.fromAula || null
    }
  };

  ev.dataTransfer.setData('application/json', JSON.stringify(payload));
  ev.dataTransfer.setData('text/plain', JSON.stringify(payload));
  ev.dataTransfer.effectAllowed = 'move';
}

window.allowDrop = allowDrop;
window.dragStart = dragStart;

/* =========================================================
   API
========================================================= */
async function apiSave(body) {
  const res = await fetch("{{ route('admin.cronograma.dragSave') }}", {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify(body)
  });

  if (!res.ok) throw new Error('Erro ao salvar');
  return res.json();
}

async function apiDelete(body) {
  const res = await fetch("{{ route('admin.cronograma.dragDelete') }}", {
    method: "DELETE",
    headers: {
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify(body)
  });

  if (!res.ok) throw new Error('Erro ao remover');
  return res.json();
}

/* =========================================================
   UTIL DOM
========================================================= */
function findCell(dia, turma, aula) {
  return document.querySelector(
    `td[data-dia="${CSS.escape(dia)}"][data-turma="${CSS.escape(turma)}"][data-aula="${aula}"]`
  );
}

function renderEmptyCell(cell) {
  if (!cell) return;
  cell.innerHTML = `<span class="text-xs text-slate-400 font-semibold">Solte aqui</span>`;
  cell.dataset.slot = '0';
  cell.dataset.professor = '';
  cell.dataset.disciplina = '';
}

function renderSlotInCell(cell, dia, turma, aula, disciplina, professor) {
  cell.dataset.slot = '1';
  cell.dataset.professor = professor;
  cell.dataset.disciplina = disciplina;

  cell.innerHTML = `
    <div draggable="true"
         ondragstart="dragStart(event)"
         data-from-dia="${dia}"
         data-from-turma="${turma}"
         data-from-aula="${aula}"
         data-disciplina="${disciplina}"
         data-professor="${professor}"
         class="slotBlock cursor-grab border rounded-xl p-2 bg-red-50 border-red-200">
      <p class="font-black text-red-800">${disciplina}</p>
      <p class="text-xs text-red-700">${professor}</p>
      <button type="button"
              class="mt-1 text-xs px-2 py-0.5 rounded bg-black/80 text-white"
              onclick="removeSlot('${dia}','${turma}',${aula},this)">✕</button>
    </div>
  `;
}

/* =========================================================
   BLOQUEIO REAL DE CONFLITO (REGRA FINAL)
   MESMO DIA + MESMO HORÁRIO (MINUTOS) + MESMO PROFESSOR
========================================================= */function hasRealConflict(dia, inicio, professor) {
  const iniMin = timeToMinutes(inicio);
  const prof = professor.trim().toLowerCase();

  let conflict = false;

  document.querySelectorAll('td[data-slot="1"]').forEach(td => {
    if (td.dataset.dia !== dia) return;

    const p = (td.dataset.professor || '').trim().toLowerCase();
    if (p !== prof) return;

    const iniTd = timeToMinutes(td.dataset.inicio);

    // 🔥 REGRA FINAL: MESMO INÍCIO = CONFLITO
    if (iniTd === iniMin) {
      conflict = true;
    }
  });

  return conflict;
}

/* =========================================================
   DROP NA CÉLULA
========================================================= */
async function dropCell(ev) {
  ev.preventDefault();

  const cell = ev.currentTarget;
  const raw =
    ev.dataTransfer.getData('application/json') ||
    ev.dataTransfer.getData('text/plain');

  if (!raw) return;

  let data;
  try { data = JSON.parse(raw); } catch { return; }

  if (cell.dataset.slot === '1') {
    showToast('Essa célula já está ocupada.');
    return;
  }

  const dia    = cell.dataset.dia;
  const turma  = cell.dataset.turma;
  const aula   = parseInt(cell.dataset.aula, 10);
  const inicio = cell.dataset.inicio;
  const fim    = cell.dataset.fim;

if (hasRealConflict(dia, inicio, data.professor)) {

    showToast('❌ Conflito: professor já está em outra turma neste horário.');
    cell.classList.add('ring-2','ring-red-500');
    setTimeout(() => cell.classList.remove('ring-2','ring-red-500'), 1500);
    return;
  }

  try {
    await apiSave({
      dia_semana: dia,
      turma,
      aula,
      inicio,
      fim,
      disciplina: data.disciplina,
      professor: data.professor
    });

    if (data.from?.dia && data.from?.turma && data.from?.aula) {
      await apiDelete({
        dia_semana: data.from.dia,
        turma: data.from.turma,
        aula: parseInt(data.from.aula, 10)
      });

      renderEmptyCell(
        findCell(data.from.dia, data.from.turma, data.from.aula)
      );
    }

    renderSlotInCell(cell, dia, turma, aula, data.disciplina, data.professor);
    showToast('Salvo.');
  } catch (e) {
    console.error(e);
    showToast('Erro ao salvar.');
  }
}

window.dropCell = dropCell;

/* =========================================================
   LIXEIRA
========================================================= */
async function dropTrash(ev) {
  ev.preventDefault();

  const raw =
    ev.dataTransfer.getData('application/json') ||
    ev.dataTransfer.getData('text/plain');

  if (!raw) return;

  let data;
  try { data = JSON.parse(raw); } catch { return; }

  if (!data.from?.dia) {
    showToast('Arraste da grade.');
    return;
  }

  try {
    await apiDelete({
      dia_semana: data.from.dia,
      turma: data.from.turma,
      aula: parseInt(data.from.aula, 10)
    });

    renderEmptyCell(
      findCell(data.from.dia, data.from.turma, data.from.aula)
    );

    showToast('Removido.');
  } catch (e) {
    console.error(e);
    showToast('Erro ao remover.');
  }
}

window.dropTrash = dropTrash;

/* =========================================================
   BOTÃO X
========================================================= */
async function removeSlot(dia, turma, aula, btn) {
  try {
    await apiDelete({ dia_semana: dia, turma, aula });
    renderEmptyCell(btn.closest('td'));
    showToast('Removido.');
  } catch (e) {
    console.error(e);
    showToast('Erro ao remover.');
  }
}

window.removeSlot = removeSlot;

/* =========================================================
   BOOTSTRAP
========================================================= */
window.addEventListener('load', () => {
  document.querySelectorAll('td[data-dia][data-inicio]').forEach(td => {
    const block = td.querySelector('.slotBlock');
    if (block) {
      td.dataset.slot = '1';
      td.dataset.professor = block.dataset.professor || '';
      td.dataset.disciplina = block.dataset.disciplina || '';
    } else {
      td.dataset.slot = '0';
    }
  });
});
</script>
