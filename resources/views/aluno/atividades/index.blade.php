<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.aluno_nav', ['title' => 'Minhas Atividades'])

<main class="max-w-7xl mx-auto px-6 py-10 space-y-10">

    <!-- ================= HERO ================= -->
    <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white shadow-xl">

        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

        <div class="relative p-8 md:p-10">

            <p class="uppercase tracking-widest text-xs text-yellow-300 font-bold">
                Área Acadêmica
            </p>

            <h1 class="text-3xl md:text-4xl font-black mt-2">
                Minhas <span class="text-yellow-300">Atividades</span>
            </h1>

            <p class="mt-3 text-white/90 max-w-xl">
                Acompanhe prazos, envios e correções das suas atividades.
            </p>

        </div>
    </section>

    <!-- ================= GRID ================= -->
    <section class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($atividades as $atividade)

            @php
                $entrega = $atividade->entregas
                    ->where('aluno_id', session('aluno_id'))
                    ->first();

                $status = $entrega->status ?? 'pendente';
            @endphp

            <div class="bg-white rounded-2xl shadow border border-slate-200 p-6 flex flex-col justify-between">

                <div>
                    <h2 class="text-lg font-black text-red-800">
                        {{ $atividade->titulo }}
                    </h2>

                    <p class="text-sm text-slate-600 mt-2 line-clamp-2">
                        {{ Str::limit($atividade->descricao, 100) }}
                    </p>

                    <p class="text-xs text-slate-500 mt-3">
                        Prazo:
                        {{ optional($atividade->data_limite)->format('d/m/Y H:i') ?? 'Sem prazo' }}
                    </p>
                </div>

                <!-- STATUS -->
                <div class="mt-4 flex justify-between items-center">

                    @switch($status)
                        @case('entregue')
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-bold">
                                Entregue
                            </span>
                        @break

                        @case('atrasado')
                            <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full font-bold">
                                Atrasado
                            </span>
                        @break

                        @case('corrigido')
                            <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-bold">
                                Corrigido
                            </span>
                        @break

                        @default
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full font-bold">
                                Pendente
                            </span>
                    @endswitch

                    <a href="{{ route('aluno.atividades.show', $atividade->id) }}"
                       class="text-red-700 font-bold text-sm hover:underline">
                        Ver →
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-full bg-white rounded-xl p-8 text-center shadow">
                Nenhuma atividade disponível.
            </div>

        @endforelse

    </section>

</main>

@include('layouts.footer')
