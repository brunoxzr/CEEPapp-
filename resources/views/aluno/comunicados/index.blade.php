@include('layouts.aluno_nav', ['title' => 'Comunicados'])

<main class="max-w-6xl mx-auto px-4 mt-10">

    <h1 class="text-3xl font-black text-red-800 mb-6 flex items-center gap-2">
        📢 Comunicados
    </h1>

    @if($comunicados->isEmpty())
        <div class="bg-white p-6 rounded-xl shadow text-center border-t-4 border-red-700">
            <p class="text-slate-600 text-sm">
                Nenhum comunicado no momento.
            </p>
        </div>
    @else

        <div class="space-y-6">

            @foreach($comunicados as $c)
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

                </article>
            @endforeach

        </div>

    @endif

</main>

@include('layouts.footer')
