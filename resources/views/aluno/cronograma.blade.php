@include('layouts.aluno_nav', ['title' => 'Cronograma'])

@php
    use Carbon\Carbon;

    $hoje = match (now()->dayOfWeek) {
        1 => 'Segunda',
        2 => 'Terça',
        3 => 'Quarta',
        4 => 'Quinta',
        5 => 'Sexta',
        default => null,
    };

    $aulasHoje = $hoje
        ? $cronograma->where('dia_semana', $hoje)->sortBy('inicio')
        : collect();
@endphp

<main class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    <!-- ================= TÍTULO ================= -->
    <header class="flex items-center gap-3">
        <span class="text-4xl">📅</span>
        <h1 class="text-3xl font-black text-red-800">
            Seu cronograma
        </h1>
    </header>

    <!-- ================= HOJE (PRIORIDADE MÁXIMA) ================= -->
    <section
        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white shadow-xl">

        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

        <div class="relative p-8">

            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <p class="uppercase tracking-widest text-xs text-yellow-300 font-bold">
                        Hoje
                    </p>
                    <h2 class="text-2xl md:text-3xl font-black mt-1">
                        {{ $hoje ?? 'Sem aulas hoje' }}
                    </h2>
                </div>

                <span class="px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-sm font-semibold">
                    {{ now()->format('d/m/Y') }}
                </span>
            </div>

            <div class="mt-6">
                @if($aulasHoje->isEmpty())
                    <div class="bg-white/10 border border-white/20 rounded-xl p-6 text-center">
                        <p class="text-white/90">
                            🎉 Nenhuma aula hoje. Aproveite!
                        </p>
                    </div>
                @else
                    <ul class="space-y-4">
                        @foreach($aulasHoje as $a)
                            <li
                                class="bg-white text-slate-800 rounded-xl p-5 shadow flex justify-between items-center">

                                <div>
                                    <p class="text-lg font-black text-red-800">
                                        {{ $a->disciplina }}
                                    </p>
                                    <p class="text-sm text-slate-600">
                                        {{ $a->professor }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Sala: <strong>{{ $a->sala ?? '—' }}</strong>
                                    </p>
                                </div>

                                <div class="text-right font-mono font-black text-red-700">
                                    {{ Carbon::parse($a->inicio)->format('H:i') }}<br>
                                    {{ Carbon::parse($a->fim)->format('H:i') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </section>

    <!-- ================= SEMANA ================= -->
    <section class="space-y-6">

        <h3 class="text-xl font-black text-red-800 flex items-center gap-2">
            <span>🗓️</span> Resto da semana
        </h3>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'] as $dia)

                @php
                    $aulasDia = $cronograma->where('dia_semana', $dia)->sortBy('inicio');
                    $isHoje = $dia === $hoje;
                @endphp

                <div
                    class="bg-white rounded-xl shadow border
                           {{ $isHoje ? 'border-yellow-400 ring-2 ring-yellow-300/40' : 'border-slate-200' }}
                           p-6 transition">

                    <h4
                        class="text-lg font-black mb-4 flex items-center gap-2
                               {{ $isHoje ? 'text-yellow-500' : 'text-red-700' }}">
                        {{ $isHoje ? '⭐ ' : '' }}{{ $dia }}
                    </h4>

                    @if($aulasDia->isEmpty())
                        <p class="text-slate-500 text-sm">
                            Sem aulas.
                        </p>
                    @else
                        <ul class="space-y-3 text-sm">
                            @foreach($aulasDia as $a)
                                <li
                                    class="p-4 rounded-lg border
                                           {{ $isHoje ? 'border-yellow-300 bg-yellow-50/40' : 'border-red-200 bg-red-50/20' }}">

                                    <div class="flex justify-between gap-3">
                                        <div>
                                            <p class="font-bold text-red-800">
                                                {{ $a->disciplina }}
                                            </p>
                                            <p class="text-xs text-slate-600">
                                                {{ $a->professor }}
                                            </p>
                                        </div>

                                        <div class="font-mono font-bold text-red-700 text-xs text-right">
                                            {{ Carbon::parse($a->inicio)->format('H:i') }}<br>
                                            {{ Carbon::parse($a->fim)->format('H:i') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            @endforeach

        </div>
    </section>

    <!-- ================= VOLTAR ================= -->
    <div>
        <a href="{{ route('aluno.dashboard') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-red-700 text-white font-bold hover:bg-red-800 shadow">
            ← Voltar ao painel
        </a>
    </div>

</main>

@include('layouts.footer')
