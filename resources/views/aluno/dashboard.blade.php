    <?php /** @var \App\Models\Aluno $aluno */ ?>
    @include('layouts.aluno_nav', ['title' => 'Painel do Aluno'])

    <main class="max-w-7xl mx-auto px-6 py-10 space-y-10">

        <!-- ================= HERO ================= -->
        <section
            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white shadow-xl">

            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

            <div class="relative p-8 md:p-10 flex flex-col md:flex-row justify-between gap-8">

                <div>
                    <p class="uppercase tracking-widest text-xs text-yellow-300 font-bold">
                        Painel do Aluno
                    </p>

                    <h1 class="text-3xl md:text-4xl font-black mt-2">
                        Bem-vindo, <span class="text-yellow-300">{{ $aluno->nome }}</span>
                    </h1>

                    <p class="mt-3 text-white/90 max-w-xl">
                        Aqui você acompanha seu desempenho acadêmico, cronograma de aulas e avisos importantes.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-4 text-sm font-semibold">
                        <span class="bg-white/10 px-4 py-2 rounded-lg">
                            Turma: {{ $aluno->turma ?? '—' }}
                        </span>
                        <span class="bg-white/10 px-4 py-2 rounded-lg">
                            CEEP Assaí
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <div
                        class="w-28 h-28 rounded-full border-4 border-yellow-400 bg-white/10 flex items-center justify-center shadow-inner">
                        <svg class="w-12 h-12 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================= COMUNICADOS E AVISOS ================= -->
        @if($comunicadosCount > 0)
        <section class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl shadow-xl border-2 border-yellow-300 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full bg-yellow-400 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-red-800">
                                Avisos Importantes
                            </h2>
                            <p class="text-sm text-slate-600 mt-0.5">
                                {{ $comunicadosCount }} novo{{ $comunicadosCount > 1 ? 's' : '' }} aviso{{ $comunicadosCount > 1 ? 's' : '' }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('aluno.comunicados.index') }}"
                       class="px-4 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md text-sm">
                        Ver todos
                    </a>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    {{-- COMUNICADOS --}}
                    @foreach($ultimosComunicados->take(2) as $c)
                    @php
    $lido = $c->leituras->isNotEmpty();
@endphp

                        <div class="bg-white rounded-xl p-5 border-l-4 {{ $c->publico === 'geral' ? 'border-red-700' : 'border-yellow-500' }} shadow-sm hover:shadow-md transition">
                            @if(!$lido)
    <span class="text-xs px-2 py-1 rounded-full font-black bg-yellow-400 text-red-900">
        Novo
    </span>
@else
    <span class="text-xs px-2 py-1 rounded-full font-semibold bg-green-100 text-green-800">
        Lido
    </span>
@endif

                            <div class="flex items-start justify-between gap-3 mb-2">
                                <h3 class="font-bold text-slate-900 leading-tight">
                                    {{ $c->titulo }}
                                </h3>
                                <span class="text-xs px-2 py-1 rounded-full font-semibold flex-shrink-0
                                    {{ $c->publico === 'geral' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $c->publico === 'geral' ? 'Geral' : 'Turma' }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mb-2">
                                {{ $c->created_at->format('d/m/Y') }}
                            </p>
                            <p class="text-sm text-slate-700 line-clamp-2 leading-relaxed">
                                {{ Str::limit($c->conteudo, 100) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- EVENTOS PRÓXIMOS --}}
                @if($eventosProximos->count() > 0)
                <div class="bg-white/80 rounded-xl p-4 border border-yellow-200">
                    <h4 class="font-bold text-red-800 mb-3 text-sm uppercase tracking-wide">Próximos Eventos</h4>
                    <div class="space-y-2">
                        @foreach($eventosProximos->take(3) as $e)
                            <div class="flex items-center gap-3 text-sm">
                                <div class="w-2 h-2 rounded-full bg-yellow-500 flex-shrink-0"></div>
                                <span class="font-semibold text-slate-800">{{ $e->titulo }}</span>
                                <span class="text-xs text-slate-500 ml-auto">
                                    {{ $e->data->format('d/m') }}
                                    @if($e->hora_inicio) • {{ $e->hora_inicio }} @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('aluno.comunicados.index') }}"
                       class="flex-1 md:flex-none px-6 py-3 bg-yellow-400 text-red-900 font-black rounded-lg hover:bg-yellow-300 transition shadow-md text-center">
                        Ver todos os comunicados
                    </a>
                    <a href="{{ route('aluno.calendario.index') }}"
                       class="flex-1 md:flex-none px-6 py-3 bg-white text-red-700 font-bold rounded-lg hover:bg-red-50 transition border-2 border-red-200 text-center">
                        Ver calendário
                    </a>
                </div>
            </div>
        </section>
        @endif



        <!-- ================= KPIs ================= -->
        <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl p-6 shadow border-l-4 border-red-700">
                <p class="text-xs uppercase text-slate-500 font-bold">Notas registradas</p>
                <p class="text-3xl font-black text-red-800 mt-2">
                    {{ $boletins->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow border-l-4 border-yellow-400">
                <p class="text-xs uppercase text-slate-500 font-bold">Aulas hoje</p>
                <p class="text-3xl font-black text-red-800 mt-2">
                    {{ $cronograma->count() }}
                </p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow border-l-4 border-red-700">
                <p class="text-xs uppercase text-slate-500 font-bold">Situação</p>
                <p class="text-lg font-bold text-emerald-600 mt-3">
                    Ativo
                </p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow border-l-4 border-yellow-400">
                <p class="text-xs uppercase text-slate-500 font-bold">Ano letivo</p>
                <p class="text-lg font-bold text-red-800 mt-3">
                    {{ now()->year }}
                </p>
            </div>

        </section>

        <!-- ================= GRID PRINCIPAL ================= -->
        <section class="grid lg:grid-cols-3 gap-8">

            <!-- ================= NOTAS ================= -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

                <div class="p-6 border-b bg-slate-50">
                    <h2 class="text-xl font-black text-red-800">
                        Últimas notas
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-red-50 text-red-800">
                            <tr>
                                <th class="px-4 py-3 text-left">Disciplina</th>
                                <th class="px-4 py-3 text-left">Nota</th>
                                <th class="px-4 py-3 text-left">Tipo</th>
                                <th class="px-4 py-3 text-left">Ano</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($boletins as $b)
                                <tr class="border-b hover:bg-red-50/40 transition">
                                    <td class="px-4 py-3">{{ $b->disciplina }}</td>
                                    <td class="px-4 py-3 font-black text-red-700">
                                        {{ number_format($b->nota, 2, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">{{ $b->tipo }}</td>
                                    <td class="px-4 py-3">{{ $b->ano }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-slate-500 text-center">
                                        Nenhuma nota registrada ainda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 border-t bg-slate-50">
                    <a href="{{ route('aluno.boletim') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-yellow-400 text-red-900 font-bold rounded-lg hover:bg-yellow-300 transition shadow">
                        Ver boletim completo →
                    </a>
                </div>
            </div>

            <!-- ================= CRONOGRAMA ================= -->
            <aside class="bg-white rounded-2xl shadow border border-slate-200 p-6">

                <h3 class="text-lg font-black text-red-800 mb-4">
                    Aulas de hoje
                </h3>

                <ul class="space-y-3 text-sm">
                    @forelse($cronograma as $c)
                        <li
                            class="p-4 rounded-xl border border-red-200 bg-red-50/30 hover:bg-red-50 transition flex justify-between gap-4">

                            <div>
                                <p class="font-bold text-red-800">
                                    {{ $c->disciplina }}
                                </p>
                                <p class="text-slate-600 text-xs">
                                    {{ $c->professor }}
                                </p>
                            </div>

                            <div class="text-right font-mono font-bold text-red-700 text-xs">
                                {{ \Carbon\Carbon::parse($c->inicio)->format('H:i') }}<br>
                                {{ \Carbon\Carbon::parse($c->fim)->format('H:i') }}
                            </div>
                        </li>
                    @empty
                        <li class="text-slate-500 text-sm">
                            Nenhuma aula programada para hoje.
                        </li>
                    @endforelse
                </ul>
            </aside>

        </section>

        <!-- ================= INFO CARDS ================= -->
        <section class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-700">
                <h4 class="font-bold text-red-800 mb-1">Informações</h4>
                <p class="text-sm text-slate-600">
                    Mantenha seus dados atualizados para não perder comunicados importantes.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-400">
                <h4 class="font-bold text-red-800 mb-1">SAEB</h4>
                <p class="text-sm text-slate-600">
                    Resultados aparecerão automaticamente quando publicados.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-700">
                <h4 class="font-bold text-red-800 mb-1">Atalhos</h4>
                <ul class="text-sm text-slate-700 list-disc ml-5 space-y-1">
                    <li><a class="text-red-700 hover:underline" href="{{ route('aluno.boletim') }}">Boletim</a></li>
                    <li><a class="text-red-700 hover:underline" href="{{ route('aluno.cronograma') }}">Cronograma</a></li>
                    <li>
    <a href="{{ route('aluno.comunicados.index') }}"
       class="text-red-700 hover:underline font-semibold flex items-center gap-2">
        Comunicados
        @if($comunicadosCount > 0)
            <span class="px-2 py-0.5 text-xs rounded-full bg-yellow-400 text-red-900 font-black">
                {{ $comunicadosCount }}
            </span>
        @endif
    </a>
</li>

                </ul>
            </div>

        </section>

    </main>

    @include('layouts.footer')
