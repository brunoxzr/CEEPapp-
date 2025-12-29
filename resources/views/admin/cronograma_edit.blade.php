@include('layouts.admin_nav', ['title' => 'Gestor — Dashboard'])
@include('layouts.sidebar')
<section class="max-w-3xl mx-auto px-4 mt-10">

    <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-yellow-400">

        <h1 class="text-2xl font-black text-red-800">Editar Item do Cronograma</h1>
        <p class="text-sm text-red-700 mt-1">Atualize as informações abaixo e salve.</p>

        @if($errors->any())
            <div class="mt-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('ok'))
            <div class="mt-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('ok') }}
            </div>
        @endif

        <form action="{{ route('admin.cronograma.update', $item->id) }}" method="POST" class="grid grid-cols-2 gap-4 mt-6">
            @csrf
            @method('PUT')

            <!-- Dia da Semana -->
            <label class="col-span-2">
                <span class="text-sm font-semibold text-red-800">Dia da Semana</span>
                <select name="dia_semana"
                        class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300">
                    <option value="">Selecione...</option>
                    @foreach(['Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira'] as $dia)
                        <option value="{{ $dia }}" @if($item->dia_semana == $dia) selected @endif>{{ $dia }}</option>
                    @endforeach
                </select>
            </label>

            <!-- Turma -->
            <label class="col-span-2">
                <span class="text-sm font-semibold text-red-800">Turma</span>
                <select name="turma"
                    class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300">

                    <option value="">Selecione...</option>

                    @php
                        $anos = [
                            "1º Ano" => ['1º DS','1º EDF','1º MEC','1º Eletro','1º Enf'],
                            "2º Ano" => ['2º DS','2º EDF','2º MEC','2º Eletro','2º Enf'],
                            "3º Ano" => ['3º DS','3º EDF','3º MEC','3º Eletro','3º Enf'],
                        ];
                    @endphp

                    @foreach($anos as $grupo => $turmas)
                        <optgroup label="{{ $grupo }}">
                            @foreach($turmas as $t)
                                <option value="{{ $t }}" @if($item->turma == $t) selected @endif>{{ $t }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach

                </select>
            </label>

            <!-- Disciplina -->
            <label class="col-span-2">
                <span class="text-sm font-semibold text-red-800">Disciplina</span>
                <input type="text" name="disciplina"
                       value="{{ $item->disciplina }}"
                       class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                              focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300" required>
            </label>

            <!-- Professor -->
            <label class="col-span-2">
                <span class="text-sm font-semibold text-red-800">Professor</span>
                <input type="text" name="professor"
                       value="{{ $item->professor }}"
                       class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                              focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300" required>
            </label>

            <!-- Início -->
            <label>
                <span class="text-sm font-semibold text-red-800">Início</span>
                <input type="time" name="inicio"
                       value="{{ $item->inicio }}"
                       class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                              focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300" required>
            </label>

            <!-- Fim -->
            <label>
                <span class="text-sm font-semibold text-red-800">Fim</span>
                <input type="time" name="fim"
                       value="{{ $item->fim }}"
                       class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                              focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300" required>
            </label>

            <!-- Sala -->
            <label>
                <span class="text-sm font-semibold text-red-800">Sala</span>
                <input type="text" name="sala"
                       value="{{ $item->sala }}"
                       class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                              focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300">
            </label>

            <!-- Observações -->
            <label class="col-span-2">
                <span class="text-sm font-semibold text-red-800">Observações</span>
                <textarea name="observacoes" rows="3"
                          class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900
                                 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-300">{{ $item->observacoes }}</textarea>
            </label>

            <!-- BOTÕES -->
            <div class="col-span-2 flex justify-between mt-4">

                <!-- Voltar -->
                <a href="{{ route('admin.cronograma') }}"
                   class="px-4 py-2 rounded-lg bg-red-600 text-white font-bold hover:bg-red-700 transition">
                    Voltar
                </a>

                <!-- Salvar -->
                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition">
                    Salvar Alterações
                </button>
            </div>

        </form>

    </div>

</section>

@include('layouts.footer')
