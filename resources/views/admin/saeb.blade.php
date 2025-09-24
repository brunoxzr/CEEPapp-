@include('layouts.header', ['title' => 'Gerenciar SAEB'])

<section class="max-w-6xl mx-auto px-4 mt-8 space-y-6">

  <!-- Upload -->
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4">Upload de Provas SAEB</h2>
    @if(session('ok'))
      <div class="mb-3 p-2 bg-green-100 text-green-700 rounded">{{ session('ok') }}</div>
    @endif
    <form action="{{ route('admin.saeb.upload') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
      @csrf
      <input type="file" name="arquivo" required class="border rounded p-2">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Enviar</button>
    </form>
    <p class="text-xs text-slate-500 mt-2">Formatos aceitos: .xls, .xlsx, .csv</p>
  </div>

  <!-- Resultados -->
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4">Resultados Processados</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="px-3 py-2">Aluno</th>
            <th class="px-3 py-2">Disciplina</th>
            <th class="px-3 py-2">Etapa</th>
            <th class="px-3 py-2">Ano</th>
            <th class="px-3 py-2">Média</th>
          </tr>
        </thead>
        <tbody>
          @forelse($resultados as $r)
          <tr class="border-b hover:bg-slate-50">
            <td class="px-3 py-2">{{ $r->aluno->nome }}</td>
            <td class="px-3 py-2">{{ $r->disciplina }}</td>
            <td class="px-3 py-2">{{ $r->etapa }}</td>
            <td class="px-3 py-2">{{ $r->ano }}</td>
            <td class="px-3 py-2 font-bold">{{ $r->media }}</td>
          </tr>
          @empty
          <tr><td colspan="5" class="py-3 px-3 text-slate-500 text-center">Nenhum resultado enviado.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="mt-4">
      {{ $resultados->links() }}
    </div>
  </div>

</section>

@include('layouts.footer')
