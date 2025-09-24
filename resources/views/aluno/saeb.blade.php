@include('layouts.header', ['title' => 'Minhas Provas SAEB'])

<section class="max-w-4xl mx-auto px-4 mt-8 bg-white rounded-xl shadow p-6">
  <h2 class="text-xl font-bold mb-4">Meus Resultados SAEB</h2>
  <table class="min-w-full text-sm">
    <thead>
      <tr class="bg-slate-100">
        <th class="px-3 py-2">Disciplina</th>
        <th class="px-3 py-2">Etapa</th>
        <th class="px-3 py-2">Ano</th>
        <th class="px-3 py-2">Média</th>
      </tr>
    </thead>
    <tbody>
      @forelse($resultados as $r)
      <tr class="border-b hover:bg-slate-50">
        <td class="px-3 py-2">{{ $r->disciplina }}</td>
        <td class="px-3 py-2">{{ $r->etapa }}</td>
        <td class="px-3 py-2">{{ $r->ano }}</td>
        <td class="px-3 py-2 font-bold">{{ $r->media }}</td>
      </tr>
      @empty
      <tr><td colspan="4" class="px-3 py-4 text-center text-slate-500">Nenhum resultado disponível.</td></tr>
      @endforelse
    </tbody>
  </table>
</section>

@include('layouts.footer')
