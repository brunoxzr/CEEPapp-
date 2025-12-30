@include('layouts.admin_nav', ['title' => 'Cronograma — Grade Visual'])
@include('layouts.sidebar')

@php
  $aulasInfo = $aulas;
@endphp

<section class="max-w-7xl mx-auto px-4 mt-8 space-y-6">

{{-- ================= HEADER ================= --}}
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

  <div>
    <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Cronograma</p>
    <h1 class="text-2xl md:text-3xl font-black text-red-800 mt-1">
      Grade por Turma (Arrastar e Soltar)
    </h1>
    <p class="text-sm text-slate-600 mt-1">
      Selecione o <b>Ano</b> e o <b>Dia</b>. Arraste blocos ou gere automaticamente.
    </p>
  </div>

  <form method="POST" action="{{ route('admin.cronograma.gerar') }}">
    @csrf
    <input type="hidden" name="ano" value="{{ $ano }}">
    <input type="hidden" name="dia" value="{{ $dia }}">

    <button
      type="submit"
      class="px-4 py-2 rounded-xl font-black
             bg-emerald-600 text-white
             hover:bg-emerald-700
             active:scale-95 transition">
      Gerar cronograma automático
    </button>
  </form>
</div>

{{-- ================= FILTROS ================= --}}
<div class="bg-white border rounded-2xl p-5 shadow-sm">
  <div class="flex flex-wrap gap-2">
    @foreach($anos as $kAno => $_)
      <a href="{{ route('admin.cronograma.index', ['ano'=>$kAno,'dia'=>$dia]) }}"
         class="px-3 py-2 rounded-xl font-bold text-sm border
         {{ $ano === $kAno ? 'bg-red-700 text-white border-red-700' : 'bg-white text-red-800 border-red-200 hover:bg-red-50' }}">
        {{ $kAno }}
      </a>
    @endforeach

    @foreach($dias as $d)
      <a href="{{ route('admin.cronograma.index', ['ano'=>$ano,'dia'=>$d]) }}"
         class="px-3 py-2 rounded-xl font-bold text-sm border
         {{ $dia === $d ? 'bg-yellow-400 text-red-900 border-yellow-400' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
        {{ $d }}
      </a>
    @endforeach
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
      <table class="min-w-[980px] w-full border text-sm">
        <thead>
          <tr class="bg-slate-100">
            <th class="border p-2 w-[120px]">Horário</th>
            @foreach($turmas as $t)
              <th class="border p-2 text-center font-black text-red-800">
                {{ $t }}
              </th>
            @endforeach
          </tr>
        </thead>

        <tbody>
          @foreach($aulasInfo as $num => [$ini,$fim])
            <tr>
              <td class="border p-2 font-black">
                {{ $num }}ª Aula
                <div class="text-xs text-slate-500">{{ $ini }}–{{ $fim }}</div>
              </td>

              @foreach($turmas as $t)
                @php
                  $slot = $map[$t.'|'.$num] ?? null;
                @endphp

                <td class="border h-24 p-2 align-top"
                    data-dia="{{ $dia }}"
                    data-turma="{{ $t }}"
                    data-aula="{{ $num }}"
                    data-inicio="{{ $ini }}"
                    data-fim="{{ $fim }}"
                    ondragover="allowDrop(event)"
                    ondrop="dropCell(event)">

                  @if($slot)
                    <div draggable="true"
                         ondragstart="dragStart(event)"
                         data-from-dia="{{ $dia }}"
                         data-from-turma="{{ $t }}"
                         data-from-aula="{{ $num }}"
                         data-disciplina="{{ $slot->disciplina }}"
                         data-professor="{{ $slot->professor }}"
                         class="slotBlock bg-red-50 border border-red-200 rounded-xl p-2 cursor-grab">

                      <p class="font-black text-red-800">{{ $slot->disciplina }}</p>
                      <p class="text-xs text-red-700">{{ $slot->professor }}</p>
                    </div>
                  @else
                    <span class="text-xs text-slate-400 font-semibold">
                      Solte aqui
                    </span>
                  @endif

                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
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
