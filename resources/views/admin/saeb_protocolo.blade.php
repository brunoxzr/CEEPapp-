@include('layouts.header', ['title' => 'Protocolo SAEB'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <div class="bg-white rounded-xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold">Protocolo #{{ $ultimo->id }}</h2>
    <p class="text-sm text-slate-600">
      Arquivo: {{ $ultimo->arquivo }} • Criado em {{ \Carbon\Carbon::parse($ultimo->created_at)->format('d/m/Y H:i') }}
    </p>
  </div>

  <div class="bg-white rounded-xl shadow p-6">
    <h3 class="font-semibold mb-4">Pré-visualização dos Resultados</h3>

    <form action="{{ route('admin.saeb.publicar', $ultimo->id) }}" method="POST">
      @csrf
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm border rounded-lg">
          <thead>
            <tr class="bg-slate-100 text-slate-700 text-left">
              <th class="px-3 py-2">Aluno (Planilha)</th>
              <th class="px-3 py-2">Vincular ao Sistema</th>
              <th class="px-3 py-2">Disciplina</th>
              <th class="px-3 py-2">Etapa</th>
              <th class="px-3 py-2">Ano</th>
              <th class="px-3 py-2">Média</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dados as $i => $item)
              <tr class="border-b hover:bg-slate-50">
                <!-- Nome da planilha -->
                <td class="px-3 py-2 font-medium">
                  {{ $item['aluno'] }}
                  <input type="hidden" name="dados[{{ $i }}][aluno_planilha]" value="{{ $item['aluno'] }}">
                </td>

                <!-- Vincular aluno -->
                <td class="px-3 py-2">
                  <select name="dados[{{ $i }}][aluno_id]" class="w-full rounded border-slate-300 px-2 py-1">
                    <option value="">Selecione...</option>
                    @foreach($alunos as $a)
                      <option value="{{ $a->id }}"
                        @if(strtolower(trim($a->nome)) === strtolower(trim($item['aluno']))) selected @endif>
                        {{ $a->nome }} — {{ $a->turma }}
                      </option>
                    @endforeach
                  </select>
                </td>

                <!-- Disciplina -->
                <td class="px-3 py-2">
                  <select name="dados[{{ $i }}][disciplina]" class="w-full rounded border-slate-300 px-2 py-1">
                    <option value="Português" @if($item['disciplina'] === 'Português') selected @endif>Português</option>
                    <option value="Matemática" @if($item['disciplina'] === 'Matemática') selected @endif>Matemática</option>
                  </select>
                </td>

                <!-- Etapa -->
                <td class="px-3 py-2">
                  <select name="dados[{{ $i }}][etapa]" class="w-full rounded border-slate-300 px-2 py-1">
                    <option value="AV1" @if($item['etapa'] === 'AV1') selected @endif>AV1</option>
                    <option value="AV2" @if($item['etapa'] === 'AV2') selected @endif>AV2</option>
                    <option value="SAEB" @if($item['etapa'] === 'SAEB') selected @endif>SAEB</option>
                  </select>
                </td>

                <!-- Ano -->
                <td class="px-3 py-2">
                  <input type="number" name="dados[{{ $i }}][ano]"
                         value="{{ $item['ano'] }}"
                         class="w-full rounded border-slate-300 px-2 py-1 text-center">
                </td>

                <!-- Média -->
                <td class="px-3 py-2">
                  <input type="number" step="0.01" min="0" max="10"
                         name="dados[{{ $i }}][media]"
                         value="{{ $item['media'] ?? 0 }}"
                         class="w-full rounded border-slate-300 px-2 py-1 font-bold text-center text-blue-700">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('admin.saeb') }}"
           class="px-6 py-2 bg-gray-300 text-slate-700 rounded hover:bg-gray-400">
          Voltar
        </a>
        <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
          Publicar Resultados
        </button>
      </div>
    </form>
  </div>
</section>

@include('layouts.footer')
