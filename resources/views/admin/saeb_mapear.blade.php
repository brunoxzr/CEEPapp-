@include('layouts.header', ['title' => 'Mapear Alunos — SAEB'])

<section class="max-w-6xl mx-auto mt-10 bg-white rounded-xl shadow-soft p-6">
  <h1 class="text-2xl font-bold mb-4 text-red-700">Mapear Alunos da Planilha</h1>

  @if(session('ok'))
    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
      {{ session('ok') }}
    </div>
  @endif

  @if($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.saeb.mapear') }}" method="POST">
    @csrf

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm border border-slate-200">
        <thead class="bg-yellow-100 text-red-800">
          <tr>
            <th class="py-2 px-3 text-left">Aluno (Planilha)</th>
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Ano</th>
            <th class="py-2 px-3 text-left">Etapa</th>
            <th class="py-2 px-3 text-left">Média</th>
            <th class="py-2 px-3 text-left">Tipo Prova</th>
            <th class="py-2 px-3 text-left">Mapear para</th>
          </tr>
        </thead>
        <tbody>
          @foreach($dados as $i => $linha)
            <tr class="border-b hover:bg-yellow-50">
              <!-- Nome original da planilha -->
              <td class="py-2 px-3 font-medium">{{ $linha['aluno_nome'] ?? '—' }}</td>

              <!-- Disciplina detectada -->
              <td class="py-2 px-3">{{ $linha['disciplina'] ?? '—' }}</td>

              <!-- Ano -->
              <td class="py-2 px-3">{{ $linha['ano'] ?? '—' }}</td>

              <!-- Etapa -->
              <td class="py-2 px-3">{{ $linha['etapa'] ?? '—' }}</td>

              <!-- Média -->
              <td class="py-2 px-3 font-bold text-red-700">{{ $linha['media'] ?? '—' }}</td>

              <!-- Tipo de prova -->
              <td class="py-2 px-3">
                <select name="tipo[{{ $i }}]" class="rounded border-slate-300 w-full">
                  <option value="">-- Selecione --</option>
                  <option value="LP1">LP1</option>
                  <option value="LP2">LP2</option>
                  <option value="MT1">MT1</option>
                  <option value="MT2">MT2</option>
                  <option value="SAEB">SAEB (Final)</option>
                </select>
              </td>

              <!-- Mapear para aluno do sistema -->
              <td class="py-2 px-3">
                <select name="mapear[{{ $i }}]" class="rounded border-slate-300 w-full">
                  <option value="">-- Selecionar Aluno --</option>
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

    <div class="mt-6 flex justify-end">
      <button class="px-6 py-2 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600">
        Salvar Resultados
      </button>
    </div>
  </form>
</section>

@include('layouts.footer')
