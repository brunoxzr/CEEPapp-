@include('layouts.header', ['title' => 'Gerenciar Boletins'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <div class="bg-white rounded-xl shadow-soft p-6 mb-6">
    <h2 class="text-xl font-bold mb-3">Lançar Boletim</h2>
    <form action="{{ route('admin.boletins.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
      @csrf

      <label>
        <span class="text-sm font-medium">Aluno</span>
        <select name="aluno_id" class="mt-1 w-full rounded border-slate-300" required>
          <option value="">Selecione...</option>
          @foreach($alunos as $a)
            <option value="{{ $a->id }}">{{ $a->nome }} — {{ $a->turma ?? '' }}</option>
          @endforeach
        </select>
      </label>

      <label>
        <span class="text-sm font-medium">Disciplina</span>
        <input type="text" name="disciplina" class="mt-1 w-full rounded border-slate-300" required>
      </label>

      <label>
        <span class="text-sm font-medium">Ano</span>
        <input type="number" name="ano" class="mt-1 w-full rounded border-slate-300" value="{{ date('Y') }}" required>
      </label>

      <label>
        <span class="text-sm font-medium">Tipo</span>
        <input type="text" name="tipo" class="mt-1 w-full rounded border-slate-300" placeholder="Ex: Prova 1, Trabalho" required>
      </label>

      <label>
        <span class="text-sm font-medium">Origem</span>
        <select name="origem" id="origemSelect" class="mt-1 w-full rounded border-slate-300" required>
          <option value="manual">Manual</option>
          <option value="saeb">SAEB</option>
        </select>
      </label>

      {{-- Campo de nota só aparece se for manual --}}
      <div id="campoNota" class="col-span-2">
        <label>
          <span class="text-sm font-medium">Nota</span>
          <input type="number" step="0.01" name="nota" class="mt-1 w-full rounded border-slate-300">
        </label>
      </div>

      <div class="col-span-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Lançar</button>
      </div>
    </form>
  </div>

  <div class="bg-white rounded-xl shadow-soft p-6">
    <h2 class="text-xl font-bold mb-3">Boletins Registrados</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="py-2 px-3 text-left">Aluno</th>
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Nota</th>
            <th class="py-2 px-3 text-left">Tipo</th>
            <th class="py-2 px-3 text-left">Ano</th>
            <th class="py-2 px-3 text-left">Data</th>
          </tr>
        </thead>
        <tbody>
          @foreach($boletins as $b)
          <tr class="border-b hover:bg-slate-50">
            <td class="py-2 px-3">{{ $b->aluno->nome ?? '—' }}</td>
            <td class="py-2 px-3">{{ $b->disciplina }}</td>
            <td class="py-2 px-3">{{ number_format($b->nota, 2, ',', '.') }}</td>
            <td class="py-2 px-3">{{ $b->tipo }}</td>
            <td class="py-2 px-3">{{ $b->ano }}</td>
            <td class="py-2 px-3">{{ $b->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

@include('layouts.footer')

<script>
  const origem = document.getElementById('origemSelect');
  const campoNota = document.getElementById('campoNota');
  origem.addEventListener('change', () => {
    campoNota.classList.toggle('hidden', origem.value === 'saeb');
  });
</script>
