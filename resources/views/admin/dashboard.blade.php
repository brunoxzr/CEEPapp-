@include('layouts.header', ['title' => 'Painel do Gestor'])

<section class="max-w-7xl mx-auto px-4 mt-8 space-y-8">

  <!-- Cards Resumo -->
  <div class="grid md:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow-soft p-6">
      <p class="text-sm text-slate-500">Alunos</p>
      <p class="text-3xl font-extrabold">{{ $totAlunos }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-soft p-6">
      <p class="text-sm text-slate-500">Boletins</p>
      <p class="text-3xl font-extrabold">{{ $totBoletins }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-soft p-6">
      <p class="text-sm text-slate-500">Aulas de Hoje</p>
      <p class="text-3xl font-extrabold">{{ $hoje }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-soft p-6">
      <p class="text-sm text-slate-500">Resultados SAEB</p>
      <p class="text-3xl font-extrabold">{{ $totSaeb ?? 0 }}</p>
    </div>
  </div>

  <!-- Últimos Boletins -->
  <div class="bg-white rounded-xl shadow-soft p-6">
    <h3 class="font-semibold mb-4">Últimos registros de boletins</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="py-2 px-3 text-left">Aluno</th>
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Nota</th>
            <th class="py-2 px-3 text-left">Tipo</th>
            <th class="py-2 px-3 text-left">Data</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentes as $r)
          <tr class="border-b hover:bg-slate-50">
            <td class="py-2 px-3">{{ $r->aluno->nome ?? '—' }}</td>
            <td class="py-2 px-3">{{ $r->disciplina }}</td>
            <td class="py-2 px-3 font-semibold">{{ number_format($r->nota,2,',','.') }}</td>
            <td class="py-2 px-3">{{ $r->tipo }}</td>
            <td class="py-2 px-3">{{ $r->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          @empty
          <tr><td class="py-2 px-3 text-slate-500" colspan="5">Sem registros recentes.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Últimos SAEB -->
  <div class="bg-white rounded-xl shadow-soft p-6">
    <h3 class="font-semibold mb-4">Últimos resultados SAEB</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="py-2 px-3 text-left">Aluno</th>
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Etapa</th>
            <th class="py-2 px-3 text-left">Ano</th>
            <th class="py-2 px-3 text-left">Média</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentesSaeb as $s)
          <tr class="border-b hover:bg-slate-50">
            <td class="py-2 px-3">{{ $s->aluno->nome }}</td>
            <td class="py-2 px-3">{{ $s->disciplina }}</td>
            <td class="py-2 px-3">{{ $s->etapa }}</td>
            <td class="py-2 px-3">{{ $s->ano }}</td>
            <td class="py-2 px-3 font-bold">{{ $s->media }}</td>
          </tr>
          @empty
          <tr><td class="py-2 px-3 text-slate-500" colspan="5">Sem resultados SAEB recentes.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</section>

@include('layouts.footer')
