@include('layouts.header', ['title' => 'Cronograma — Gestor'])

<section class="max-w-6xl mx-auto px-4 mt-8 grid md:grid-cols-2 gap-6">

  <!-- Cadastro -->
  <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-yellow-400">
    <h2 class="text-xl font-black text-red-800">Cadastrar Item</h2>

    @if(session('ok'))
      <div class="mt-3 p-2 text-sm bg-green-50 border border-green-200 text-green-700 rounded">
        {{ session('ok') }}
      </div>
    @endif

    <form action="{{ route('admin.cronograma.store') }}" method="POST" class="grid grid-cols-2 gap-4 mt-4" id="formCronograma">
      @csrf

      <!-- Dia da semana -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Dia da Semana</span>
        <select name="dia_semana" required
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900">
          <option value="">Selecione...</option>
          <option>Segunda</option>
          <option>Terça</option>
          <option>Quarta</option>
          <option>Quinta</option>
          <option>Sexta</option>
        </select>
      </label>

      <!-- Turma -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Turma</span>
        <select name="turma" required
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900">
          <option value="">Selecione...</option>

          <optgroup label="1º Ano">
            <option value="1º DS">1º DS</option>
            <option value="1º EDF">1º EDF</option>
            <option value="1º MEC">1º MEC</option>
            <option value="1º Eletro">1º Eletro</option>
            <option value="1º Enf">1º Enf</option>
          </optgroup>

          <optgroup label="2º Ano">
            <option value="2º DS">2º DS</option>
            <option value="2º EDF">2º EDF</option>
            <option value="2º MEC">2º MEC</option>
            <option value="2º Eletro">2º Eletro</option>
            <option value="2º Enf">2º Enf</option>
          </optgroup>

          <optgroup label="3º Ano">
            <option value="3º DS">3º DS</option>
            <option value="3º EDF">3º EDF</option>
            <option value="3º MEC">3º MEC</option>
            <option value="3º Eletro">3º Eletro</option>
            <option value="3º Enf">3º Enf</option>
          </optgroup>
        </select>
      </label>

      <!-- Disciplina -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Disciplina</span>
        <input type="text" name="disciplina"
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900" required>
      </label>

      <!-- Professor -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Professor</span>
        <input type="text" name="professor"
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900" required>
      </label>

      <!-- Aula -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Aula</span>
        <select name="aula" id="selectAula" required
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900">
          <option value="">Selecione a aula...</option>
          <option value="1">1ª Aula — 07:20–08:10</option>
          <option value="2">2ª Aula — 08:10–09:00</option>
          <option value="3">3ª Aula — 09:10–09:50</option>
          <option value="4">4ª Aula — 10:10–11:00</option>
          <option value="5">5ª Aula — 11:00–11:40</option>
          <option value="6">6ª Aula — 11:40–12:30</option>
        </select>
      </label>

      <!-- Hidden horários -->
      <input type="hidden" name="inicio" id="inicio">
      <input type="hidden" name="fim" id="fim">

      <!-- Sala -->
      <label>
        <span class="text-sm font-semibold text-red-800">Sala</span>
        <input type="text" name="sala"
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900">
      </label>

      <!-- Observações -->
      <label class="col-span-2">
        <span class="text-sm font-semibold text-red-800">Observações</span>
        <textarea name="observacoes" rows="3"
          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-transparent text-red-900"></textarea>
      </label>

      <div class="col-span-2">
        <button class="px-4 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition">
          Salvar
        </button>
      </div>

    </form>
  </div><!-- Listagem Agrupada -->
<div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-red-700">
  <h2 class="text-xl font-black text-red-800 mb-4">Organização por Turma e Disciplina</h2>

  @php
      // Agrupa por turma
      $gruposTurma = $itens->groupBy('turma');
  @endphp

  @forelse($gruposTurma as $turma => $aulasTurma)
      <div class="mb-8">
        <h3 class="text-lg font-bold text-red-700 mb-2">{{ $turma }}</h3>

        @php
          // Agora agrupa por disciplina dentro da turma
          $gruposMateria = $aulasTurma->groupBy('disciplina');
        @endphp

        <div class="grid md:grid-cols-2 gap-4">
          @foreach($gruposMateria as $disciplina => $aulasMateria)
            <div class="border border-red-200 rounded-lg p-4 bg-red-50/40">
              <h4 class="font-bold text-red-800 mb-2">{{ $disciplina }}</h4>

              <ul class="space-y-2 text-sm">
                @foreach($aulasMateria as $a)
                  <li class="p-3 rounded border bg-white border-red-200 hover:bg-red-50 transition">
                    <p class="font-semibold text-red-900">{{ $a->dia_semana }}</p>
                    <p class="text-red-700">Professor: <strong>{{ $a->professor }}</strong></p>
                    <p class="text-red-700">Sala: {{ $a->sala ?? '—' }}</p>
                    <p class="text-red-900 font-mono">
                      {{ \Carbon\Carbon::parse($a->inicio)->format('H:i') }} —
                      {{ \Carbon\Carbon::parse($a->fim)->format('H:i') }}
                    </p>

                    <div class="mt-2 flex gap-2">
                      <a href="{{ route('admin.cronograma.edit', $a->id) }}"
                        class="px-3 py-1 text-xs font-bold bg-yellow-400 text-red-900 rounded-lg shadow hover:bg-yellow-300">
                        Editar
                      </a>

                      <form action="{{ route('admin.cronograma.delete', $a->id) }}" method="POST" onsubmit="return confirm('Deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 text-xs font-bold bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
                          Excluir
                        </button>
                      </form>
                    </div>

                  </li>
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>

  @empty
    <p class="text-red-600">Nenhum registro encontrado.</p>
  @endforelse

  <div class="mt-6">
    {{ $itens->links() }}
  </div>
</div>

</section>

@include('layouts.footer')

<!-- SCRIPT DE HORÁRIOS AUTOMÁTICOS -->
<script>
document.getElementById('selectAula').addEventListener('change', function() {
    const horarios = {
        1: ["07:20", "08:10"],
        2: ["08:10", "09:00"],
        3: ["09:10", "09:50"],
        4: ["10:10", "11:00"],
        5: ["11:00", "11:40"],
        6: ["11:40", "12:30"]
    };

    const aula = this.value;

    if (horarios[aula]) {
        document.getElementById('inicio').value = horarios[aula][0];
        document.getElementById('fim').value = horarios[aula][1];
    }
});
</script>
