@include('layouts.admin_nav', ['title' => 'SAEB'])
<main class="max-w-7xl mx-auto px-6 py-10 space-y-8">
  <div class="mb-6">
    <h1 class="text-3xl font-black text-red-800 mb-2">Gerenciar SAEB</h1>
    <p class="text-slate-600">Faça upload de planilhas SAEB e gerencie os resultados das avaliações.</p>
  </div>

  <!-- Upload -->
  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h2 class="text-xl font-black text-red-800 mb-6">Upload de Provas SAEB</h2>
    @if(session('ok'))
      <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
        {{ session('ok') }}
      </div>
    @endif
    <form action="{{ route('admin.saeb.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="block mb-2">
          <span class="text-sm font-semibold text-slate-700">Selecione o arquivo</span>
          <input type="file" name="arquivo" accept=".xls,.xlsx,.csv" class="mt-2 w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
        </label>
        <p class="text-xs text-slate-500 mt-2">Formatos aceitos: .xls, .xlsx, .csv</p>
      </div>
      <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
        Enviar Arquivo
      </button>
    </form>
  </div>

  <!-- Resultados -->
  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h2 class="text-xl font-black text-red-800 mb-6">Resultados Processados</h2>
    <div class="overflow-x-auto rounded-lg border border-slate-200">
      <table class="min-w-full text-sm">
        <thead class="bg-red-50 text-red-800">
          <tr>
            <th class="px-4 py-3 text-left font-semibold">Aluno</th>
            <th class="px-4 py-3 text-left font-semibold">Disciplina</th>
            <th class="px-4 py-3 text-left font-semibold">Etapa</th>
            <th class="px-4 py-3 text-left font-semibold">Ano</th>
            <th class="px-4 py-3 text-left font-semibold">Média</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($resultados as $r)
          <tr class="hover:bg-red-50/40 transition">
            <td class="px-4 py-3 font-medium text-slate-800">{{ $r->aluno->nome ?? '—' }}</td>
            <td class="px-4 py-3 text-slate-700">{{ $r->disciplina ?? '—' }}</td>
            <td class="px-4 py-3 text-slate-700">{{ $r->etapa ?? '—' }}</td>
            <td class="px-4 py-3 text-slate-700">{{ $r->ano ?? '—' }}</td>
            <td class="px-4 py-3 font-bold text-red-700 text-lg">{{ $r->media ?? '—' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="py-12 px-4 text-slate-500 text-center">
              Nenhum resultado processado ainda.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($resultados->hasPages())
    <div class="mt-6">
      {{ $resultados->links() }}
    </div>
    @endif
  </div>

</main>

@include('layouts.footer')
