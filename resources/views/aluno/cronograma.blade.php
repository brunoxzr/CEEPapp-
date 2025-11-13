@include('layouts.header', ['title' => 'Cronograma Semanal'])

<section class="max-w-6xl mx-auto px-4 mt-10">

    <!-- TÍTULO -->
    <h1 class="text-3xl font-black text-red-800 mb-6 flex items-center gap-2">
        <span class="text-yellow-400 text-4xl">📅</span>
        Cronograma da Semana
    </h1>

    @if($cronograma->isEmpty())
        <div class="bg-white rounded-xl shadow-xl p-6 text-center border-t-4 border-red-600">
            <p class="text-slate-600 text-sm">Nenhuma aula registrada nesta semana para sua turma.</p>
        </div>

    @else

        <!-- GRID DOS DIAS -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'] as $dia)

                <div class="bg-white rounded-xl shadow-xl p-6 border border-red-100 hover:shadow-2xl transition">

                    <!-- Cabeçalho do dia -->
                    <h2 class="text-lg font-black text-red-700 mb-4 pb-2 border-b border-red-200 flex items-center gap-2">
                        <span class="text-yellow-400">📘</span>
                        {{ $dia }}-feira
                    </h2>

                    @php
                        $aulasDia = $cronograma->where('dia_semana', $dia);
                    @endphp

                    @if($aulasDia->isEmpty())
                        <p class="text-slate-500 text-sm">Sem aulas cadastradas.</p>

                    @else
                        <ul class="space-y-4 text-sm">
                            @foreach($aulasDia->sortBy('inicio') as $a)

                                <li class="p-4 rounded-lg border-2 border-red-200 bg-red-50/20 hover:bg-red-50 transition">

                                    <div class="flex justify-between items-start">

                                        <!-- Informações -->
                                        <div>
                                            <p class="font-bold text-red-800">{{ $a->disciplina }}</p>
                                            <p class="text-slate-600">{{ $a->professor }}</p>
                                            <p class="text-slate-500 text-xs mt-1">Sala: <strong>{{ $a->sala ?? '—' }}</strong></p>
                                        </div>

                                        <!-- Horário -->
                                        <span class="font-mono font-bold text-red-700 text-sm text-right">
                                            {{ \Carbon\Carbon::parse($a->inicio)->format('H:i') }}<br>
                                            {{ \Carbon\Carbon::parse($a->fim)->format('H:i') }}
                                        </span>

                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    @endif

                </div>
            @endforeach

        </div>

    @endif

</section>

<!-- VOLTAR -->
<div class="max-w-6xl mx-auto mt-10 px-4 mb-10">
    <a href="{{ route('aluno.dashboard') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-red-700 text-white font-semibold hover:bg-red-800 shadow">
        ← Voltar ao Painel
    </a>
</div>

@include('layouts.footer')
