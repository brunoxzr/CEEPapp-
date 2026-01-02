@include('layouts.admin_nav', ['title' => 'Mapear Alunos SAEB'])
<main class="max-w-7xl mx-auto px-6 py-10">
  <div class="mb-6">
    <h1 class="text-3xl font-black text-red-800 mb-2">Mapear Alunos da Planilha</h1>
    <p class="text-slate-600">Vincule os alunos da planilha SAEB aos alunos cadastrados no sistema.</p>
  </div>

  <section class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">

    @if(session('ok'))
      <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
        {{ session('ok') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-700 rounded-lg">
        <ul class="list-disc pl-5 text-red-800 space-y-1">
          @foreach($errors->all() as $e)
            <li class="text-sm">{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

  <form action="{{ route('admin.saeb.mapear') }}" method="POST">
    @csrf

    <div class="overflow-x-auto rounded-lg border border-slate-200">
      <table class="min-w-full text-sm">
        <thead class="bg-red-50 text-red-800">
          <tr>
            <th class="py-3 px-4 text-left font-semibold">Aluno (Planilha)</th>
            <th class="py-3 px-4 text-left font-semibold">Disciplina</th>
            <th class="py-3 px-4 text-left font-semibold">Ano</th>
            <th class="py-3 px-4 text-left font-semibold">Etapa</th>
            <th class="py-3 px-4 text-left font-semibold">Média</th>
            <th class="py-3 px-4 text-left font-semibold">Tipo Prova</th>
            <th class="py-3 px-4 text-left font-semibold">Mapear para</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @foreach($dados as $i => $linha)
            <tr class="hover:bg-red-50/40 transition">
              <td class="py-3 px-4 font-medium text-slate-800">{{ $linha['aluno_nome'] ?? '—' }}</td>
              <td class="py-3 px-4 text-slate-700">{{ $linha['disciplina'] ?? '—' }}</td>
              <td class="py-3 px-4 text-slate-700">{{ $linha['ano'] ?? '—' }}</td>
              <td class="py-3 px-4 text-slate-700">{{ $linha['etapa'] ?? '—' }}</td>
              <td class="py-3 px-4 font-bold text-red-700">{{ $linha['media'] ?? '—' }}</td>
              <td class="py-3 px-4">
                <select name="tipo[{{ $i }}]" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                  <option value="">Selecione...</option>
                  <option value="LP1">LP1</option>
                  <option value="LP2">LP2</option>
                  <option value="MT1">MT1</option>
                  <option value="MT2">MT2</option>
                  <option value="SAEB">SAEB (Final)</option>
                </select>
              </td>
              <td class="py-3 px-4">
                <select name="mapear[{{ $i }}]" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                  <option value="">Selecionar Aluno...</option>
                  @foreach($alunos as $al)
                    <option value="{{ $al->id }}"
                      @if(strtolower(trim($al->nome)) === strtolower(trim($linha['aluno_nome']))) selected @endif>
                      {{ $al->nome }} ({{ $al->turma }})
                    </option>
                  @endforeach
                </select>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-6 flex justify-end gap-4">
      <a href="{{ route('admin.saeb') }}"
         class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
        Voltar
      </a>
      <button class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 transition shadow-md">
        Salvar Resultados
      </button>
    </div>
  </form>
  </section>
</main>

@include('layouts.footer')
