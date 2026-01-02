@include('layouts.admin_nav', ['title' => 'Boletins'])
<main class="max-w-7xl mx-auto px-6 py-10 space-y-8">
  <div class="mb-6">
    <h1 class="text-3xl font-black text-red-800 mb-2">Gerenciar Boletins</h1>
    <p class="text-slate-600">Lance notas e acompanhe o histórico de boletins registrados.</p>
  </div>

  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h2 class="text-xl font-black text-red-800 mb-6">Lançar Novo Boletim</h2>
    <form action="{{ route('admin.boletins.store') }}" method="POST" class="grid md:grid-cols-2 gap-6">
      @csrf

      <label>
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Aluno</span>
        <select name="aluno_id" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
          <option value="">Selecione um aluno...</option>
          @foreach($alunos as $a)
            <option value="{{ $a->id }}">{{ $a->nome }} — {{ $a->turma ?? '' }}</option>
          @endforeach
        </select>
      </label>

      <label>
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Disciplina</span>
        <input type="text" name="disciplina" placeholder="Ex: Matemática" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
      </label>

      <label>
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Ano</span>
        <input type="number" name="ano" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" value="{{ date('Y') }}" required>
      </label>

      <label>
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Tipo</span>
        <input type="text" name="tipo" placeholder="Ex: Prova 1, Trabalho" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
      </label>

      <label>
        <span class="text-sm font-semibold text-slate-700 mb-2 block">Origem</span>
        <select name="origem" id="origemSelect" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" required>
          <option value="manual">Manual</option>
          <option value="saeb">SAEB</option>
        </select>
      </label>

      <div id="campoNota" class="col-span-2">
        <label>
          <span class="text-sm font-semibold text-slate-700 mb-2 block">Nota</span>
          <input type="number" step="0.01" min="0" max="10" name="nota" placeholder="0.00" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
        </label>
      </div>

      <div class="col-span-2 pt-2">
        <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
          Lançar Boletim
        </button>
      </div>
    </form>
  </div>

  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h2 class="text-xl font-black text-red-800 mb-6">Boletins Registrados</h2>
    <div class="overflow-x-auto rounded-lg border border-slate-200">
      <table class="min-w-full text-sm">
        <thead class="bg-red-50 text-red-800">
          <tr>
            <th class="py-3 px-4 text-left font-semibold">Aluno</th>
            <th class="py-3 px-4 text-left font-semibold">Disciplina</th>
            <th class="py-3 px-4 text-left font-semibold">Nota</th>
            <th class="py-3 px-4 text-left font-semibold">Tipo</th>
            <th class="py-3 px-4 text-left font-semibold">Ano</th>
            <th class="py-3 px-4 text-left font-semibold">Data</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @foreach($boletins as $b)
          <tr class="hover:bg-red-50/40 transition">
            <td class="py-3 px-4 font-medium text-slate-800">{{ $b->aluno->nome ?? '—' }}</td>
            <td class="py-3 px-4 text-slate-700">{{ $b->disciplina }}</td>
            <td class="py-3 px-4 font-bold text-red-700">{{ number_format($b->nota, 2, ',', '.') }}</td>
            <td class="py-3 px-4 text-slate-700">{{ $b->tipo }}</td>
            <td class="py-3 px-4 text-slate-700">{{ $b->ano }}</td>
            <td class="py-3 px-4 text-slate-600 text-xs">{{ $b->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</main>

@include('layouts.footer')

<script>
  const origem = document.getElementById('origemSelect');
  const campoNota = document.getElementById('campoNota');
  origem.addEventListener('change', () => {
    campoNota.classList.toggle('hidden', origem.value === 'saeb');
  });
</script>
