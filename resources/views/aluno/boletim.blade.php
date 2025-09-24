<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.header', ['title' => 'Boletim do Aluno'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <div class="bg-white rounded-xl shadow-soft p-6">
    <div class="flex items-start justify-between gap-4">
      <div>
        <h2 class="text-xl font-bold">Boletim — {{ $aluno->nome }}</h2>
        <p class="text-sm text-slate-600">Turma: {{ $aluno->turma ?? '—' }} • Escola: {{ $aluno->escola }}</p>
      </div>
      <button id="btnExport" class="px-3 py-2 rounded bg-slate-800 text-white hover:bg-slate-900">Exportar CSV</button>
    </div>

    <div class="mt-6 overflow-x-auto">
      <table id="tBoletim" class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Nota</th>
            <th class="py-2 px-3 text-left">Tipo</th>
            <th class="py-2 px-3 text-left">Etapa</th>
            <th class="py-2 px-3 text-left">Ano</th>
          </tr>
        </thead>
        <tbody>
          @foreach($boletins as $b)
          <tr class="border-b hover:bg-slate-50">
            <td class="py-2 px-3">{{ $b->disciplina }}</td>
            <td class="py-2 px-3">{{ number_format($b->nota,2,',','.') }}</td>
            <td class="py-2 px-3">{{ $b->tipo }}</td>
            <td class="py-2 px-3">{{ $b->etapa ?? '—' }}</td>
            <td class="py-2 px-3">{{ $b->ano }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      <label class="text-sm mr-2">Filtrar por ano:</label>
      <input type="number" id="fAno" class="rounded border-slate-300" placeholder="2025" />
      <button id="btnFiltrar" class="ml-2 px-3 py-1.5 rounded bg-blue-600 text-white">Aplicar</button>
      <button id="btnLimpar" class="ml-2 px-3 py-1.5 rounded bg-slate-200">Limpar</button>
    </div>
  </div>
</section>

@include('layouts.footer')

<script>
  // Exporta tabela para CSV rápido
  document.getElementById('btnExport')?.addEventListener('click', ()=>{
    const rows = [...document.querySelectorAll('#tBoletim tr')].map(tr => [...tr.children].map(td => td.innerText));
    const csv = rows.map(r => r.join(';')).join('\n');
    const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'boletim.csv';
    a.click();
  });

  // Filtro por ano simples (client-side)
  document.getElementById('btnFiltrar')?.addEventListener('click', ()=>{
    const f = document.getElementById('fAno').value.trim();
    document.querySelectorAll('#tBoletim tbody tr').forEach(tr=>{
      const ano = tr.children[4]?.innerText?.trim();
      tr.style.display = (!f || ano === f) ? '' : 'none';
    });
  });

  document.getElementById('btnLimpar')?.addEventListener('click', ()=>{
    document.getElementById('fAno').value = '';
    document.querySelectorAll('#tBoletim tbody tr').forEach(tr=> tr.style.display = '');
  });
</script>
