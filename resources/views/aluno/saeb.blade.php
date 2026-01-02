@include('layouts.aluno_nav', ['title' => 'Minhas Provas SAEB'])

<main class="max-w-6xl mx-auto px-6 py-10">
  <div class="mb-8">
    <h1 class="text-3xl font-black text-red-800 mb-2">Resultados SAEB</h1>
    <p class="text-slate-600">Acompanhe seus resultados nas avaliações SAEB.</p>
  </div>

  <section class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
    <div class="p-6 border-b bg-slate-50">
      <h2 class="text-xl font-black text-red-800">Meus Resultados</h2>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-red-50 text-red-800">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">Disciplina</th>
            <th class="px-6 py-3 text-left font-semibold">Etapa</th>
            <th class="px-6 py-3 text-left font-semibold">Ano</th>
            <th class="px-6 py-3 text-left font-semibold">Média</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($resultados as $r)
          <tr class="hover:bg-red-50/40 transition">
            <td class="px-6 py-4 font-medium text-slate-800">{{ $r->disciplina }}</td>
            <td class="px-6 py-4 text-slate-700">{{ $r->etapa }}</td>
            <td class="px-6 py-4 text-slate-700">{{ $r->ano }}</td>
            <td class="px-6 py-4 font-bold text-red-700 text-lg">{{ $r->media }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="px-6 py-12 text-center text-slate-500">
              Nenhum resultado disponível no momento.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>
</main>

@include('layouts.footer')
