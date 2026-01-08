@include('layouts.aluno_nav', ['title' => 'Comunicados'])

<main class="max-w-6xl mx-auto px-4 mt-10">

    <!-- ================= HEADER ================= -->
    <div class="mb-8">
        <h1 class="text-3xl font-black text-red-800 mb-2">
            Comunicados
        </h1>
        <p class="text-slate-600">
            Acompanhe os avisos e comunicados da escola e da sua turma.
        </p>
    </div>

    <!-- ================= EVENTOS ================= -->
    @if($eventosProximos->count())
        <section class="mb-10 bg-yellow-50 border-l-8 border-yellow-400 p-6 rounded-2xl shadow">
            <h2 class="text-xl font-black text-red-800 mb-4">
                Eventos próximos
            </h2>

            <ul class="space-y-3 text-sm">
                @foreach($eventosProximos as $e)
                    <li class="bg-white p-4 rounded-xl border border-yellow-200">
                        <p class="font-bold text-red-800">
                            {{ $e->titulo }}
                        </p>

                        <p class="text-slate-600 text-sm mt-1">
                            {{ $e->data->format('d/m/Y') }}
                            @if($e->hora_inicio)
                                • {{ $e->hora_inicio }}
                            @endif
                        </p>

                        @if($e->descricao)
                            <p class="text-slate-600 mt-2 text-sm">
                                {{ $e->descricao }}
                            </p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <!-- ================= COMUNICADOS ================= -->
    @if($comunicados->isEmpty())
        <div class="bg-white p-6 rounded-xl shadow text-center border-t-4 border-red-700">
            <p class="text-slate-600 text-sm">
                Nenhum comunicado no momento.
            </p>
        </div>
    @else

        <div class="space-y-6">

            @foreach($comunicados as $c)

                @php
                    // 🔥 DEFINE AQUI (ANTES DE USAR)
                    $lido = $c->leituras->isNotEmpty();
                @endphp

                <article
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4
                           {{ $c->publico === 'geral' ? 'border-red-700' : 'border-yellow-400' }}
                           hover:shadow-xl transition">

                    <!-- CABEÇALHO -->
                    <div class="flex justify-between items-start gap-4">

                        <div>
                            <h2 class="text-xl font-black text-red-800">
                                {{ $c->titulo }}
                            </h2>

                            <p class="text-xs text-slate-500 mt-1">
                                Publicado em {{ $c->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <span class="text-xs px-3 py-1 rounded-full font-bold
                            {{ $c->publico === 'geral'
                                ? 'bg-red-100 text-red-800'
                                : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $c->publico === 'geral' ? 'Geral' : 'Sua turma' }}
                        </span>
                    </div>

                    <!-- CONTEÚDO -->
                    <div class="mt-4 text-slate-700 leading-relaxed text-sm whitespace-pre-line">
                        {{ $c->conteudo }}
                    </div>

                    <!-- ================= STATUS DE LEITURA ================= -->
                    <div class="mt-6 flex justify-between items-center">

                        @if($lido)
                            <form method="POST" action="{{ route('aluno.comunicados.naoLido', $c) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-xs px-4 py-2 rounded-full
                                           bg-green-100 text-green-800 font-bold
                                           hover:bg-green-200 transition">
                                    ✓ Lido — marcar como não lido
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('aluno.comunicados.lido', $c) }}">
                                @csrf

                                <button
                                    class="text-xs px-4 py-2 rounded-full
                                           bg-yellow-400 text-red-900 font-black
                                           hover:bg-yellow-300 transition">
                                    Marcar como lido
                                </button>
                            </form>
                        @endif

                        @if(!$lido)
                            <span class="text-xs font-bold text-red-700 bg-red-100 px-3 py-1 rounded-full">
                                Novo
                            </span>
                        @endif
                    </div>

                </article>
            @endforeach

        </div>

    @endif

</main>

@include('layouts.footer')
