@include('layouts.admin_nav', ['title' => 'Protocolo SAEB'])
<main class="max-w-7xl mx-auto px-6 py-10 space-y-8">
  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h1 class="text-2xl font-black text-red-800 mb-2">Protocolo #{{ $ultimo->id }}</h1>
    <p class="text-slate-600">
      Arquivo: <span class="font-semibold">{{ $ultimo->arquivo }}</span> • 
      Criado em {{ \Carbon\Carbon::parse($ultimo->created_at)->format('d/m/Y H:i') }}
    </p>
  </div>

  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
    <h2 class="text-xl font-black text-red-800 mb-6">Pré-visualização dos Resultados</h2>

    <form action="{{ route('admin.saeb.publicar', $ultimo->id) }}" method="POST">
      @csrf
      <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="min-w-full text-sm">
          <thead class="bg-red-50 text-red-800">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">Aluno (Planilha)</th>
              <th class="px-4 py-3 text-left font-semibold">Vincular ao Sistema</th>
              <th class="px-4 py-3 text-left font-semibold">Disciplina</th>
              <th class="px-4 py-3 text-left font-semibold">Etapa</th>
              <th class="px-4 py-3 text-left font-semibold">Ano</th>
              <th class="px-4 py-3 text-left font-semibold">Média</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($dados as $i => $item)
              <tr class="hover:bg-red-50/40 transition">
                <td class="px-4 py-3 font-medium text-slate-800">
                  {{ $item['aluno'] }}
                  <input type="hidden" name="dados[{{ $i }}][aluno_planilha]" value="{{ $item['aluno'] }}">
                </td>
                <td class="px-4 py-3">
                  <select name="dados[{{ $i }}][aluno_id]" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                    <option value="">Selecione...</option>
                    @foreach($alunos as $a)
                      <option value="{{ $a->id }}"
                        @if(strtolower(trim($a->nome)) === strtolower(trim($item['aluno']))) selected @endif>
                        {{ $a->nome }} — {{ $a->turma }}
                      </option>
                    @endforeach
                  </select>
                </td>
                <td class="px-4 py-3">
                  <select name="dados[{{ $i }}][disciplina]" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                    <option value="Português" @if($item['disciplina'] === 'Português') selected @endif>Português</option>
                    <option value="Matemática" @if($item['disciplina'] === 'Matemática') selected @endif>Matemática</option>
                  </select>
                </td>
                <td class="px-4 py-3">
                  <select name="dados[{{ $i }}][etapa]" class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                    <option value="AV1" @if($item['etapa'] === 'AV1') selected @endif>AV1</option>
                    <option value="AV2" @if($item['etapa'] === 'AV2') selected @endif>AV2</option>
                    <option value="SAEB" @if($item['etapa'] === 'SAEB') selected @endif>SAEB</option>
                  </select>
                </td>
                <td class="px-4 py-3">
                  <input type="number" name="dados[{{ $i }}][ano]"
                         value="{{ $item['ano'] }}"
                         class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-3 py-2 text-center focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                </td>
                <td class="px-4 py-3">
                  <input type="number" step="0.01" min="0" max="10"
                         name="dados[{{ $i }}][media]"
                         value="{{ $item['media'] ?? 0 }}"
                         class="w-full rounded-lg border-2 border-slate-300 bg-white text-red-700 px-3 py-2 font-bold text-center focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
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
        <button class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition shadow-md">
          Publicar Resultados
        </button>
      </div>
    </form>
  </div>
</main>

@include('layouts.footer')
