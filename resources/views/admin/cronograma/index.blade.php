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


</div>
<script>
/* =========================================================
   CONFIG
========================================================= */
const ROUTES = {
  save: "{{ route('admin.cronograma.dragSave') }}",
  delete: "{{ route('admin.cronograma.dragDelete') }}"
};

/* =========================================================
   UTIL – HORÁRIO EM MINUTOS
========================================================= */
function timeToMinutes(t) {
  if (!t) return null;
  const [h, m] = String(t).trim().split(':').map(Number);
  if (isNaN(h) || isNaN(m)) return null;
  return h * 60 + m;
}

/* =========================================================
   TOAST (STATUS REAL)
========================================================= */
const toast = document.getElementById('toast');

function showToast(msg, type = 'ok') {
  if (!toast) return;

  toast.textContent = msg;
  toast.classList.remove('hidden');

  toast.className =
    'mt-4 p-3 rounded-xl border text-sm font-semibold ' +
    (type === 'ok'
      ? 'bg-emerald-50 border-emerald-200 text-emerald-800'
      : type === 'warn'
      ? 'bg-amber-50 border-amber-200 text-amber-800'
      : 'bg-red-50 border-red-200 text-red-800');

  clearTimeout(window.__toastTimer);
  window.__toastTimer = setTimeout(() => {
    toast.classList.add('hidden');
  }, 2200);
}

/* =========================================================
   API (RESPEITA ERRO DO BACKEND)
========================================================= */
async function apiRequest(url, method, body) {
  const res = await fetch(url, {
    method,
    headers: {
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify(body)
  });

  let json = {};
  try { json = await res.json(); } catch {}

  if (!res.ok) {
    throw new Error(json.message || 'Erro inesperado.');
  }

  return json;
}

const apiSave   = body => apiRequest(ROUTES.save,   'POST', body);
const apiDelete = body => apiRequest(ROUTES.delete, 'DELETE', body);

/* =========================================================
   DRAG & DROP – BÁSICO
========================================================= */
function allowDrop(ev) {
  ev.preventDefault();
}
window.allowDrop = allowDrop;

function dragStart(ev) {
  const el = ev.currentTarget;

  if (!el.dataset.disciplina || !el.dataset.professor) {
    showToast('Bloco inválido.', 'error');
    return;
  }

  const payload = {
    disciplina: el.dataset.disciplina,
    professor: el.dataset.professor,
    from: {
      dia: el.dataset.fromDia || null,
      turma: el.dataset.fromTurma || null,
      aula: el.dataset.fromAula || null
    }
  };

  ev.dataTransfer.setData('application/json', JSON.stringify(payload));
  ev.dataTransfer.effectAllowed = 'move';
}
window.dragStart = dragStart;

/* =========================================================
   DOM HELPERS
========================================================= */
function findCell(dia, turma, aula) {
  return document.querySelector(
    `td[data-dia="${CSS.escape(dia)}"][data-turma="${CSS.escape(turma)}"][data-aula="${aula}"]`
  );
}

function renderEmptyCell(cell) {
  if (!cell) return;
  cell.dataset.slot = '0';
  cell.dataset.professor = '';
  cell.dataset.disciplina = '';
  cell.innerHTML = `<span class="text-[10px] text-slate-400 font-semibold">Solte aqui</span>`;
}

function renderSlot(cell, data) {
  cell.dataset.slot = '1';
  cell.dataset.professor = data.professor;
  cell.dataset.disciplina = data.disciplina;

  cell.innerHTML = `
    <div draggable="true"
         ondragstart="dragStart(event)"
         data-from-dia="${data.dia}"
         data-from-turma="${data.turma}"
         data-from-aula="${data.aula}"
         data-disciplina="${data.disciplina}"
         data-professor="${data.professor}"
         class="slotBlock cursor-grab border rounded-xl p-2 bg-red-50 border-red-200">
      <p class="font-black text-red-800">${data.disciplina}</p>
      <p class="text-xs text-red-700">${data.professor}</p>
      <button type="button"
              class="mt-1 text-xs px-2 py-0.5 rounded bg-black/80 text-white"
              onclick="removeSlot('${data.dia}','${data.turma}',${data.aula},this)">✕</button>
    </div>
  `;
}

function pulse(cell, ok = true) {
  const cls = ok ? 'ring-emerald-500' : 'ring-red-500';
  cell.classList.add('ring-2', cls);
  setTimeout(() => cell.classList.remove('ring-2', cls), 1200);
}

/* =========================================================
   CONFLITO LOCAL (UX)
========================================================= */
function hasConflict(dia, inicio, professor) {
  const iniMin = timeToMinutes(inicio);
  professor = professor.toLowerCase();

  return [...document.querySelectorAll('td[data-slot="1"]')].some(td => {
    return (
      td.dataset.dia === dia &&
      td.dataset.professor?.toLowerCase() === professor &&
      timeToMinutes(td.dataset.inicio) === iniMin
    );
  });
}

/* =========================================================
   DROP NA CÉLULA
========================================================= */
async function dropCell(ev) {
  ev.preventDefault();
  const cell = ev.currentTarget;

  if (cell.dataset.slot === '1') {
    showToast('Célula já ocupada.', 'warn');
    pulse(cell, false);
    return;
  }

  let data;
  try {
    data = JSON.parse(ev.dataTransfer.getData('application/json'));
  } catch {
    return;
  }

  const dia    = cell.dataset.dia;
  const turma  = cell.dataset.turma;
  const aula   = parseInt(cell.dataset.aula, 10);
  const inicio = cell.dataset.inicio;
  const fim    = cell.dataset.fim;

  if (hasConflict(dia, inicio, data.professor)) {
    showToast('Conflito: professor já está em outra turma.', 'error');
    pulse(cell, false);
    return;
  }

  try {
    await apiSave({ dia_semana: dia, turma, aula, inicio, fim, ...data });

    if (data.from?.dia) {
      await apiDelete({
        dia_semana: data.from.dia,
        turma: data.from.turma,
        aula: parseInt(data.from.aula)
      });
      renderEmptyCell(findCell(data.from.dia, data.from.turma, data.from.aula));
    }

    renderSlot(cell, { dia, turma, aula, ...data });
    showToast('Salvo com sucesso.');
    pulse(cell, true);

  } catch (e) {
    showToast(e.message, 'error');
    pulse(cell, false);
  }
}
window.dropCell = dropCell;
/* =========================================================
   LIXEIRA (DROP)
========================================================= */
async function dropTrash(ev) {
  ev.preventDefault();

  let data;
  try {
    data = JSON.parse(ev.dataTransfer.getData('application/json'));
  } catch {
    return;
  }

  if (!data?.from?.dia || !data?.from?.turma || !data?.from?.aula) {
    showToast('Arraste um bloco que já esteja na grade.', 'warn');
    return;
  }

  try {
    await apiDelete({
      dia_semana: data.from.dia,
      turma: data.from.turma,
      aula: parseInt(data.from.aula, 10)
    });

    const fromCell = findCell(data.from.dia, data.from.turma, data.from.aula);
    renderEmptyCell(fromCell);

    showToast('Removido.', 'ok');
    if (fromCell) pulse(fromCell, true);
  } catch (e) {
    showToast(e.message || 'Erro ao remover.', 'error');
  }
}
window.dropTrash = dropTrash;

/* =========================================================
   BOTÃO X (REMOVER)
========================================================= */
async function removeSlot(dia, turma, aula, btn) {
  try {
    await apiDelete({
      dia_semana: dia,
      turma: turma,
      aula: parseInt(aula, 10)
    });

    const td = btn?.closest('td');
    renderEmptyCell(td);

    showToast('Removido.', 'ok');
    if (td) pulse(td, true);
  } catch (e) {
    showToast(e.message || 'Erro ao remover.', 'error');
  }
}
window.removeSlot = removeSlot;

/* =========================================================
   BOOTSTRAP (SYNC DATASETS + PLACEHOLDER)
========================================================= */
function bootstrapSlots() {
  document.querySelectorAll('td[data-dia][data-inicio]').forEach(td => {
    const block = td.querySelector('.slotBlock');

    if (block) {
      td.dataset.slot = '1';
      td.dataset.professor = block.dataset.professor || '';
      td.dataset.disciplina = block.dataset.disciplina || '';
    } else {
      renderEmptyCell(td);
    }
  });
}

/* =========================================================
   (OPCIONAL) HOOK PARA AULAS SEGUIDAS / RESTRIÇÕES
   - Deixe o backend bloquear e retornar 422 com message
   - Aqui a gente só melhora UX: marcar células do professor
========================================================= */
function getSlotsOfProfessorOnDay(professor, dia) {
  professor = professor.toLowerCase();
  return [...document.querySelectorAll('td[data-slot="1"]')].filter(td => {
    return td.dataset.dia === dia && (td.dataset.professor || '').toLowerCase() === professor;
  });
}

function countConsecutiveAulas(aulasNums) {
  // recebe array de ints (ex: [1,2,3,5]) e retorna maior sequência (3)
  aulasNums.sort((a,b)=>a-b);
  let best = 1, cur = 1;

  for (let i = 1; i < aulasNums.length; i++) {
    if (aulasNums[i] === aulasNums[i-1] + 1) {
      cur++;
      best = Math.max(best, cur);
    } else {
      cur = 1;
    }
  }
  return aulasNums.length ? best : 0;
}

/* =========================================================
   START
========================================================= */
window.addEventListener('load', () => {
  bootstrapSlots();
});
</script>
