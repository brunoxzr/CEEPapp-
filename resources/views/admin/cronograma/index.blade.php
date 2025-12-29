@include('layouts.admin_nav', ['title' => 'Cronograma — Grade Visual'])
@include('layouts.sidebar')

@php
  $aulasInfo = $aulas;
@endphp


<section class="max-w-7xl mx-auto px-4 mt-8 space-y-6">

  {{-- ================= HEADER ================= --}}
  <div class="bg-white border rounded-2xl p-5 shadow-sm">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Cronograma</p>
        <h1 class="text-2xl md:text-3xl font-black text-red-800 mt-1">
          Grade por Turma (Arrastar e Soltar)
        </h1>
        <p class="text-sm text-slate-600 mt-1">
          Selecione o <b>Ano</b> e o <b>Dia</b>. Arraste blocos para preencher a grade.
        </p>
      </div>

      <div class="flex flex-wrap gap-2">
        {{-- ANOS --}}
        @foreach($anos as $kAno => $_)
          <a href="{{ route('admin.cronograma.index', ['ano'=>$kAno,'dia'=>$dia]) }}"
             class="px-3 py-2 rounded-xl font-bold text-sm border
             {{ $ano === $kAno ? 'bg-red-700 text-white border-red-700' : 'bg-white text-red-800 border-red-200 hover:bg-red-50' }}">
            {{ $kAno }}
          </a>
        @endforeach

        {{-- DIAS --}}
        @foreach($dias as $d)
          <a href="{{ route('admin.cronograma.index', ['ano'=>$ano,'dia'=>$d]) }}"
             class="px-3 py-2 rounded-xl font-bold text-sm border
             {{ $dia === $d ? 'bg-yellow-400 text-red-900 border-yellow-400' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50' }}">
            {{ $d }}
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ================= BANCO DE BLOCOS ================= --}}
  <div class="grid lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white border rounded-2xl p-5 shadow-sm">
      <h2 class="text-lg font-black text-slate-900 mb-3">
        Blocos (Professores + Disciplinas)
      </h2>

      <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-3 max-h-[360px] overflow-auto">
        @forelse($professores as $p)
          @foreach($p->disciplinas as $d)
            <div
              draggable="true"
              ondragstart="dragStart(event)"
              data-disciplina="{{ $d->nome }}"
              data-professor="{{ $p->nome }}"
              class="cursor-grab select-none border rounded-xl p-3 bg-slate-50 hover:bg-slate-100">
              <p class="font-black text-red-800">{{ $d->nome }}</p>
              <p class="text-xs text-slate-600">{{ $p->nome }}</p>
            </div>
          @endforeach
        @empty
          <p class="text-sm text-slate-500">Nenhum professor com disciplinas.</p>
        @endforelse
      </div>
    </div>

    {{-- LIXEIRA --}}
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
  </div>

  {{-- ================= GRADE ================= --}}
  <div class="bg-white border rounded-2xl p-4 shadow-sm overflow-x-auto">
    <table class="min-w-[980px] w-full border text-sm">
      <thead>
        <tr class="bg-slate-100">
          <th class="border p-2 w-[120px]">Horário</th>
          @foreach($turmas as $t)
            <th class="border p-2 text-center font-black text-red-800">{{ $t }}</th>
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
              @php $slot = $map[$t.'|'.$num] ?? null; @endphp

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
                       class="bg-red-50 border border-red-200 rounded-xl p-2 cursor-grab">
                    <p class="font-black text-red-800">{{ $slot->disciplina }}</p>
                    <p class="text-xs text-red-700">{{ $slot->professor }}</p>
                  </div>
                @else
                  <span class="text-xs text-slate-400">Solte aqui</span>
                @endif
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</section>

@include('layouts.footer')
<script>
  // =============================
  //  CONFIG
  // =============================
  const toast = document.getElementById('toast');
  const trash = document.getElementById('trash');

  function showToast(msg = 'Salvo.') {
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.remove('hidden');
    clearTimeout(window.__toastTimer);
    window.__toastTimer = setTimeout(() => toast.classList.add('hidden'), 1400);
  }

  function allowDrop(ev) { ev.preventDefault(); }

  // =============================
  //  CORES POR DISCIPLINA (HASH)
  //  - sempre a mesma cor pra mesma disciplina
  // =============================
  const PALETTE = [
    'border-sky-200 bg-sky-50 text-sky-900',
    'border-emerald-200 bg-emerald-50 text-emerald-900',
    'border-violet-200 bg-violet-50 text-violet-900',
    'border-amber-200 bg-amber-50 text-amber-900',
    'border-rose-200 bg-rose-50 text-rose-900',
    'border-cyan-200 bg-cyan-50 text-cyan-900',
    'border-lime-200 bg-lime-50 text-lime-900',
    'border-fuchsia-200 bg-fuchsia-50 text-fuchsia-900',
  ];

  function hashStr(str='') {
    let h = 0;
    for (let i=0; i<str.length; i++) h = (h*31 + str.charCodeAt(i)) >>> 0;
    return h;
  }

  function classForDisciplina(disciplina) {
    const idx = hashStr(String(disciplina || '').toLowerCase()) % PALETTE.length;
    return PALETTE[idx];
  }

  // =============================
  //  DRAG START (banco ou célula)
  // =============================
  function dragStart(ev) {
    const el = ev.currentTarget;

    const payload = {
      disciplina: el.dataset.disciplina || '',
      professor: el.dataset.professor || '',
      from: {
        dia: el.dataset.fromDia || null,
        turma: el.dataset.fromTurma || null,
        aula: el.dataset.fromAula || null,
      }
    };

    ev.dataTransfer.setData("application/json", JSON.stringify(payload));
  }
  window.dragStart = dragStart;
  window.allowDrop = allowDrop;

  // =============================
  //  API
  // =============================
  async function apiSave(body) {
    const res = await fetch("{{ route('admin.cronograma.dragSave') }}", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Content-Type": "application/json",
        "Accept": "application/json",
      },
      body: JSON.stringify(body)
    });

    if (!res.ok) throw new Error('Falha ao salvar');
    return res.json();
  }

  async function apiDelete(body) {
    const res = await fetch("{{ route('admin.cronograma.dragDelete') }}", {
      method: "DELETE",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Content-Type": "application/json",
        "Accept": "application/json",
      },
      body: JSON.stringify(body)
    });

    if (!res.ok) throw new Error('Falha ao remover');
    return res.json();
  }

  // =============================
  //  UTIL
  // =============================
  function escapeHtml(str) {
    return String(str || '')
      .replaceAll('&', '&amp;')
      .replaceAll('<', '&lt;')
      .replaceAll('>', '&gt;')
      .replaceAll('"', '&quot;')
      .replaceAll("'", '&#039;');
  }

  function findCell(dia, turma, aula) {
    return document.querySelector(`td[data-dia="${CSS.escape(dia)}"][data-turma="${CSS.escape(turma)}"][data-aula="${CSS.escape(String(aula))}"]`);
  }

  function renderEmptyCell(cell) {
    if (!cell) return;
    cell.innerHTML = `<span class="text-xs text-slate-400 font-semibold">Solte aqui</span>`;
    cell.dataset.professor = '';
    cell.dataset.disciplina = '';
    cell.dataset.slot = '0';
  }

  function renderSlotInCell(cell, dia, turma, aula, disciplina, professor) {
    const color = classForDisciplina(disciplina);

    cell.dataset.professor = professor || '';
    cell.dataset.disciplina = disciplina || '';
    cell.dataset.slot = '1';

    cell.innerHTML = `
      <div draggable="true"
           ondragstart="dragStart(event)"
           data-from-dia="${escapeHtml(dia)}"
           data-from-turma="${escapeHtml(turma)}"
           data-from-aula="${escapeHtml(String(aula))}"
           data-disciplina="${escapeHtml(disciplina)}"
           data-professor="${escapeHtml(professor)}"
           class="slotBlock cursor-grab active:cursor-grabbing select-none
                  border rounded-xl p-2 ${color}">
        <div class="flex items-start justify-between gap-2">
          <div>
            <p class="font-black leading-tight">${escapeHtml(disciplina)}</p>
            <p class="text-xs opacity-80">${escapeHtml(professor)}</p>
          </div>
          <button type="button"
                  class="text-xs font-black px-2 py-1 rounded-lg bg-black/80 text-white hover:bg-black"
                  onclick="removeSlot('${escapeHtml(dia)}','${escapeHtml(turma)}','${escapeHtml(String(aula))}', this)"
                  title="Remover">✕</button>
        </div>
      </div>
    `;
  }

  // =============================
  //  CONFLITO VISUAL
  //  Regra: mesmo PROFESSOR na mesma AULA (num) em mais de 1 turma = conflito
  // =============================
  function markConflicts() {
    // limpa estilos
    document.querySelectorAll('td[data-aula]').forEach(td => {
      td.classList.remove('ring-2','ring-red-500','bg-red-50/60');
      td.removeAttribute('data-conflict');
    });

    // agrupa por aula -> professor -> cells
    const buckets = {}; // { aulaNum: { professor: [td, td] } }

    document.querySelectorAll('td[data-aula]').forEach(td => {
      if (td.dataset.slot !== '1') return;
      const aula = td.dataset.aula;
      const prof = (td.dataset.professor || '').trim().toLowerCase();
      if (!prof) return;

      buckets[aula] ??= {};
      buckets[aula][prof] ??= [];
      buckets[aula][prof].push(td);
    });

    // marca conflito
    Object.keys(buckets).forEach(aula => {
      const byProf = buckets[aula];
      Object.keys(byProf).forEach(prof => {
        const list = byProf[prof];
        if (list.length > 1) {
          list.forEach(td => {
            td.classList.add('ring-2','ring-red-500','bg-red-50/60');
            td.dataset.conflict = '1';
          });
        }
      });
    });
  }

  // =============================
  //  DROP NA CÉLULA (salva e move)
  // =============================
  async function dropCell(ev) {
    ev.preventDefault();

    const cell = ev.currentTarget;
    const json = ev.dataTransfer.getData("application/json");
    if (!json) return;

    const data = JSON.parse(json);

    // bloqueia se já tem um bloco
    if (cell.dataset.slot === '1') {
      showToast('Essa célula já está ocupada.');
      return;
    }

    const dia = cell.dataset.dia;
    const turma = cell.dataset.turma;
    const aula = parseInt(cell.dataset.aula, 10);
    const inicio = cell.dataset.inicio;
    const fim = cell.dataset.fim;

    try {
// 🔴 BLOQUEIO DE CONFLITO (mesmo professor na mesma aula)
const aulaNum = String(aula);
const profKey = (data.professor || '').trim().toLowerCase();

let conflito = false;
document.querySelectorAll(`td[data-aula="${aulaNum}"]`).forEach(td => {
  if (td.dataset.slot === '1') {
    const p = (td.dataset.professor || '').trim().toLowerCase();
    if (p && p === profKey) conflito = true;
  }
});

if (conflito) {
  showToast('Conflito: professor já está nessa aula.');
  cell.classList.add('ring-2','ring-red-500','bg-red-50/60');
  setTimeout(() => {
    cell.classList.remove('ring-2','ring-red-500','bg-red-50/60');
  }, 1200);
  return;
}

// salvar destino
await apiSave({
  dia_semana: dia,
  turma,
  aula,
  inicio,
  fim,
  disciplina: data.disciplina,
  professor: data.professor,
});


      // se veio de outra célula, remove origem (MOVE)
      if (data.from?.dia && data.from?.turma && data.from?.aula) {
        await apiDelete({
          dia_semana: data.from.dia,
          turma: data.from.turma,
          aula: parseInt(data.from.aula, 10),
        });

        const originCell = findCell(data.from.dia, data.from.turma, data.from.aula);
        renderEmptyCell(originCell);
      }

      renderSlotInCell(cell, dia, turma, aula, data.disciplina, data.professor);

      markConflicts();
      showToast('Salvo.');
    } catch (e) {
      console.error(e);
      showToast('Erro ao salvar.');
    }
  }
  window.dropCell = dropCell;

  // =============================
  //  LIXEIRA (remove do backend e do DOM)
  // =============================
  async function dropTrash(ev) {
    ev.preventDefault();

    const json = ev.dataTransfer.getData("application/json");
    if (!json) return;

    const data = JSON.parse(json);

    if (!data.from?.dia || !data.from?.turma || !data.from?.aula) {
      showToast('Arraste um bloco da grade para remover.');
      return;
    }

    try {
      await apiDelete({
        dia_semana: data.from.dia,
        turma: data.from.turma,
        aula: parseInt(data.from.aula, 10),
      });

      const cell = findCell(data.from.dia, data.from.turma, data.from.aula);
      renderEmptyCell(cell);

      markConflicts();
      showToast('Removido.');
    } catch (e) {
      console.error(e);
      showToast('Erro ao remover.');
    }
  }
  window.dropTrash = dropTrash;

  // botão X do bloco
  async function removeSlot(dia, turma, aula, btn) {
    try {
      await apiDelete({
        dia_semana: dia,
        turma,
        aula: parseInt(aula, 10),
      });

      const cell = btn.closest('td');
      renderEmptyCell(cell);

      markConflicts();
      showToast('Removido.');
    } catch (e) {
      console.error(e);
      showToast('Erro ao remover.');
    }
  }
  window.removeSlot = removeSlot;

  // =============================
  //  INICIALIZA
  //  - marca slots que já vieram do backend
  // =============================
  function bootstrapSlots() {
    document.querySelectorAll('td[data-aula]').forEach(td => {
      const hasBlock = td.querySelector('.slotBlock') || td.querySelector('[draggable="true"]');
      if (hasBlock) {
        // tenta ler do bloco (blade já colocou data-*)
        const block = hasBlock;
        td.dataset.slot = '1';
        td.dataset.professor = block.dataset.professor || '';
        td.dataset.disciplina = block.dataset.disciplina || '';

        // aplica cor por disciplina
        const disc = td.dataset.disciplina;
        const color = classForDisciplina(disc);
        block.classList.add(...color.split(' '));
        block.classList.add('border','rounded-xl','p-2');
      } else {
        td.dataset.slot = '0';
      }
    });

    markConflicts();
  }

  window.addEventListener('load', bootstrapSlots);
</script>
