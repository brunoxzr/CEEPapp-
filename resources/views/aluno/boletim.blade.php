<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.aluno_nav', ['title' => 'Boletim do Aluno'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <!-- Cabeçalho -->
  <div class="bg-gradient-to-br from-red-600 to-red-800 text-white rounded-2xl shadow-xl p-8 border-0 mb-8 animate-fade-in">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h2 class="text-3xl font-bold flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Boletim — <span class="text-white/90">{{ $aluno->nome }}</span>
        </h2>
        <p class="text-white/80 mt-2">
          <span class="font-semibold">Turma:</span> {{ $aluno->turma ?? '—' }} •
          <span class="font-semibold ml-2">Escola:</span> {{ $aluno->escola }}
        </p>
      </div>

      <button id="btnExport"
        class="px-5 py-2 rounded-lg bg-white text-red-700 font-semibold hover:bg-red-100 transition flex items-center gap-2 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Exportar CSV
      </button>
    </div>
  </div>

  <!-- Card principal -->
  <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 animate-slide-in">
    <h3 class="text-2xl font-bold text-red-700 mb-4">
      Histórico de Notas
    </h3>

    <!-- Tabela -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
      <table id="tBoletim" class="min-w-full text-sm text-left">
        <thead class="bg-red-50 text-red-700 uppercase text-xs">
          <tr>
            <th class="py-3 px-4">Disciplina</th>
            <th class="py-3 px-4">Nota</th>
            <th class="py-3 px-4">Tipo</th>
            <th class="py-3 px-4">Etapa</th>
            <th class="py-3 px-4">Ano</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($boletins as $b)
          <tr class="hover:bg-red-50/50 transition">
            <td class="py-3 px-4 font-medium text-slate-800">{{ $b->disciplina }}</td>
            <td class="py-3 px-4 font-bold text-lg
              {{ $b->nota >= 9 ? 'text-green-600' : ($b->nota >= 7 ? 'text-red-600' : ($b->nota >= 5 ? 'text-yellow-600' : 'text-red-800')) }}">
              {{ number_format($b->nota, 2, ',', '.') }}
            </td>
            <td class="py-3 px-4 text-slate-700">{{ $b->tipo }}</td>
            <td class="py-3 px-4 text-slate-700">{{ $b->etapa ?? '—' }}</td>
            <td class="py-3 px-4 text-slate-700">{{ $b->ano }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Filtros -->
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div class="flex items-center gap-2">
        <label for="fAno" class="text-sm font-semibold text-red-700">Filtrar por ano:</label>
        <input
          type="number" id="fAno"
          class="border border-red-300 rounded-lg bg-white text-black px-3 py-2 w-28 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition"
          placeholder="2025"
        />
      </div>



      </div>
    </div>
  </div>
</section>

@include('layouts.footer')

<script>
  // Exportar CSV
  document.getElementById('btnExport')?.addEventListener('click', () => {
    const rows = [...document.querySelectorAll('#tBoletim tr')]
      .map(tr => [...tr.children].map(td => td.innerText));
    const csv = rows.map(r => r.join(';')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'boletim.csv';
    a.click();
  });

  // Filtro por ano (client-side)
  document.getElementById('btnFiltrar')?.addEventListener('click', () => {
    const f = document.getElementById('fAno').value.trim();
    document.querySelectorAll('#tBoletim tbody tr').forEach(tr => {
      const ano = tr.children[4]?.innerText?.trim();
      tr.style.display = (!f || ano === f) ? '' : 'none';
    });
  });

  document.getElementById('btnLimpar')?.addEventListener('click', () => {
    document.getElementById('fAno').value = '';
    document.querySelectorAll('#tBoletim tbody tr').forEach(tr => tr.style.display = '');
  });


</script>
