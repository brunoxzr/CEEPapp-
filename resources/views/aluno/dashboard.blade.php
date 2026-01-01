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
                            🎓 Turma: {{ $aluno->turma ?? '—' }}
                        </span>
                        <span class="bg-white/10 px-4 py-2 rounded-lg">
                            🏫 CEEP Assaí
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <div
                        class="w-28 h-28 rounded-full border-4 border-yellow-400 bg-white/10 flex items-center justify-center text-4xl shadow-inner">
                        📘
                    </div>
                </div>
            </div>
        </section>
        @if($comunicadosCount > 0)
<section class="bg-white rounded-2xl shadow-lg border-l-8 border-yellow-400 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">

    <div class="flex items-start gap-4">
        <div class="text-3xl">📢</div>

        <div>
            <h2 class="text-xl font-black text-red-800">
                Você tem {{ $comunicadosCount }} comunicado{{ $comunicadosCount > 1 ? 's' : '' }} novo{{ $comunicadosCount > 1 ? 's' : '' }}
            </h2>

            <ul class="mt-2 text-sm text-slate-700 list-disc ml-5 space-y-1">
                @foreach($ultimosComunicados as $c)
                    <li>
                        <span class="font-semibold">{{ $c->titulo }}</span>
                        <span class="text-xs text-slate-500">
                            — {{ $c->created_at->format('d/m') }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('aluno.comunicados.index') }}"
       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-yellow-400 text-red-900 font-black hover:bg-yellow-300 transition shadow">
        Ver comunicados →
    </a>

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
                        📊 Últimas notas
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
                    🕒 Aulas de hoje
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
                <h4 class="font-bold text-red-800 mb-1">📌 Dica rápida</h4>
                <p class="text-sm text-slate-600">
                    Mantenha seus dados atualizados para não perder comunicados importantes.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-400">
                <h4 class="font-bold text-red-800 mb-1">📊 SAEB</h4>
                <p class="text-sm text-slate-600">
                    Resultados aparecerão automaticamente quando publicados.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-700">
                <h4 class="font-bold text-red-800 mb-1">⚡ Atalhos</h4>
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
