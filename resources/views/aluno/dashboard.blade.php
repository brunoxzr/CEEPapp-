<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.header', ['title' => 'Painel do Aluno'])

<section class="max-w-6xl mx-auto px-4 mt-8">

    <!-- BANNER DE BOAS-VINDAS -->
    <div class="bg-gradient-to-r from-red-700 to-red-600 text-white rounded-xl p-8 shadow-xl flex flex-col md:flex-row items-center md:items-start justify-between gap-6">

        <div>
            <h1 class="text-3xl font-black">
                👋 Bem-vindo(a), <span class="text-yellow-300">{{ $aluno->nome }}</span>!
            </h1>

            <p class="text-white/90 mt-2 text-sm md:text-base">
                Aqui você acompanha suas notas, horários e informações importantes da sua turma.
            </p>

            <p class="text-yellow-200 font-semibold mt-2">
                Turma: {{ $aluno->turma ?? '—' }} • Escola: CEEP
            </p>
        </div>

        <!-- Indicador visual (não precisa ser real) -->
        <div class="text-center">
            <div class="w-24 h-24 bg-white/10 border-2 border-yellow-400 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <span class="text-2xl font-black text-yellow-300">📘</span>
            </div>
            <p class="text-xs mt-2 text-white/80">Seu painel acadêmico</p>
        </div>
    </div>

    <!-- GRID PRINCIPAL -->
    <div class="grid md:grid-cols-3 gap-6 mt-8">

        <!-- NOTAS -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-red-700">
                <h2 class="text-xl font-black text-red-800 mb-4">Últimas Notas</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                        <tr class="bg-red-50 text-red-800 border-b border-red-200">
                            <th class="py-2 px-3 text-left">Disciplina</th>
                            <th class="py-2 px-3 text-left">Nota</th>
                            <th class="py-2 px-3 text-left">Tipo</th>
                            <th class="py-2 px-3 text-left">Ano</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($boletins as $b)
                            <tr class="border-b hover:bg-red-50/30">
                                <td class="py-2 px-3">{{ $b->disciplina }}</td>
                                <td class="py-2 px-3 font-semibold text-red-700">
                                    {{ number_format($b->nota,2,',','.') }}
                                </td>
                                <td class="py-2 px-3">{{ $b->tipo }}</td>
                                <td class="py-2 px-3">{{ $b->ano }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-3 px-3 text-slate-500" colspan="4">Nenhuma nota recente.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('aluno.boletim') }}"
                       class="inline-block px-4 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold hover:bg-yellow-300 shadow">
                        Ver boletim completo
                    </a>
                </div>
            </div>
        </div>

        <!-- CRONOGRAMA -->
        <aside>
            <div class="bg-white rounded-xl shadow-xl p-6 border-t-4 border-yellow-400">
                <h3 class="text-lg font-black text-red-800 mb-3">Cronograma de Hoje</h3>

                <ul class="space-y-3 text-sm">
                    @forelse($cronograma as $c)
                        <li class="p-3 rounded-lg border-2 border-red-200 bg-red-50/20 hover:bg-red-50 transition flex justify-between">
                            <div>
                                <p class="font-bold text-red-800">{{ $c->disciplina }}</p>
                                <p class="text-slate-600">{{ $c->professor }} — Sala {{ $c->sala ?? '—' }}</p>
                            </div>

                            <div class="text-right font-mono font-bold text-red-700">
                                {{ \Carbon\Carbon::parse($c->inicio)->format('H:i') }}<br>
                                {{ \Carbon\Carbon::parse($c->fim)->format('H:i') }}
                            </div>
                        </li>
                    @empty
                        <li class="text-slate-500">Sem aulas hoje para sua turma.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>

    <!-- CARDS EXTRAS -->
    <div class="mt-8 grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow-xl p-6 border-l-4 border-red-700">
            <h4 class="font-bold text-red-800">📌 Dica rápida</h4>
            <p class="text-sm text-slate-600 mt-1">
                Mantenha seu e-mail atualizado na secretaria para receber avisos importantes.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 border-l-4 border-yellow-400">
            <h4 class="font-bold text-red-800">📊 SAEB</h4>
            <p class="text-sm text-slate-600 mt-1">
                Resultados SAEB aparecerão aqui quando forem publicados.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 border-l-4 border-red-700">
            <h4 class="font-bold text-red-800">⚡ Atalhos</h4>
            <ul class="text-sm list-disc ml-5 text-slate-700 mt-1">
                <li><a class="hover:underline text-red-700" href="{{ route('aluno.boletim') }}">Boletim</a></li>
                <li>Cronograma</li>
                <li>Comunicados</li>
            </ul>
        </div>

    </div>
</section>

@include('layouts.footer')
