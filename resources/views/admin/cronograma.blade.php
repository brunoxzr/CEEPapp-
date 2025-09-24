@include('layouts.header', ['title' => 'Cronograma — Gestor'])

<section class="max-w-6xl mx-auto px-4 mt-8 grid md:grid-cols-2 gap-6">
  <!-- Cadastro -->
  <div class="bg-white rounded-xl shadow-soft p-6">
    <h2 class="text-xl font-bold">Cadastrar item</h2>
    @if(session('ok'))
      <div class="mt-3 p-2 text-sm bg-green-50 border border-green-200 text-green-700 rounded">{{ session('ok') }}</div>
    @endif

    <form action="{{ route('admin.cronograma.store') }}" method="POST" class="grid grid-cols-2 gap-4 mt-4">
      @csrf

      <!-- Dia da semana -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Dia da Semana</span>
        <select name="dia_semana" required class="mt-1 w-full rounded border-slate-300">
          <option value="">Selecione...</option>
          <option value="Segunda">Segunda-feira</option>
          <option value="Terça">Terça-feira</option>
          <option value="Quarta">Quarta-feira</option>
          <option value="Quinta">Quinta-feira</option>
          <option value="Sexta">Sexta-feira</option>
        </select>
      </label>

      <!-- Série / Turma fixa -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Turma</span>
        <select name="turma" required class="mt-1 w-full rounded border-slate-300">
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
        <span class="text-sm font-medium">Disciplina</span>
        <input type="text" name="disciplina" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Professor -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Professor</span>
        <input type="text" name="professor" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Horário -->
      <label>
        <span class="text-sm font-medium">Início</span>
        <input type="time" name="inicio" required class="mt-1 w-full rounded border-slate-300">
      </label>
      <label>
        <span class="text-sm font-medium">Fim</span>
        <input type="time" name="fim" required class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Sala -->
      <label>
        <span class="text-sm font-medium">Sala</span>
        <input type="text" name="sala" class="mt-1 w-full rounded border-slate-300">
      </label>

      <!-- Observações -->
      <label class="col-span-2">
        <span class="text-sm font-medium">Observações</span>
        <textarea name="observacoes" rows="3" class="mt-1 w-full rounded border-slate-300"></textarea>
      </label>

      <div class="col-span-2">
        <button class="px-4 py-2 rounded bg-blue-600 text-white">Salvar</button>
      </div>
    </form>
  </div>

  <!-- Listagem -->
  <div class="bg-white rounded-xl shadow-soft p-6">
    <h2 class="text-xl font-bold">Últimos lançamentos</h2>
    <div class="mt-4 overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-100 text-slate-700">
            <th class="py-2 px-3 text-left">Dia</th>
            <th class="py-2 px-3 text-left">Turma</th>
            <th class="py-2 px-3 text-left">Disciplina</th>
            <th class="py-2 px-3 text-left">Professor</th>
            <th class="py-2 px-3 text-left">Horário</th>
          </tr>
        </thead>
        <tbody>
          @forelse($itens as $i)
          <tr class="border-b hover:bg-slate-50">
            <td class="py-2 px-3">{{ $i->dia_semana }}</td>
            <td class="py-2 px-3">{{ $i->turma }}</td>
            <td class="py-2 px-3">{{ $i->disciplina }}</td>
            <td class="py-2 px-3">{{ $i->professor }}</td>
            <td class="py-2 px-3">{{ \Carbon\Carbon::parse($i->inicio)->format('H:i') }}–{{ \Carbon\Carbon::parse($i->fim)->format('H:i') }}</td>
          </tr>
          @empty
          <tr><td class="py-2 px-3 text-slate-500" colspan="5">Sem registros.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="mt-3">{{ $itens->links() }}</div>
    </div>
  </div>
</section>

@include('layouts.footer')
