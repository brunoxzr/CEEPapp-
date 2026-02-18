@include('layouts.header', ['title' => 'Projetos Selecionados — Smart Agro 2026'])

<main class="bg-white text-slate-800 min-h-screen">

<!-- HERO -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-green-700 to-green-900"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-28 text-white text-center">

        <span class="uppercase tracking-[0.3em] text-xs font-bold text-yellow-300">
            Hackathon Smart Agro 2026
        </span>

        <h1 class="text-4xl md:text-5xl font-black mt-4">
            Projetos Selecionados
        </h1>

        <p class="mt-6 text-green-100 max-w-2xl mx-auto">
            Confira os projetos classificados na etapa interna do CEEP Assaí.
        </p>

    </div>
</section>

<!-- LISTA -->
<section class="py-20">
    <div class="max-w-6xl mx-auto px-6">

        @if($selecionados->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($selecionados as $p)
            <div class="bg-white border rounded-2xl shadow-lg p-8 hover:shadow-xl transition">

                <h2 class="text-xl font-black text-green-800 mb-4">
                    {{ $p->titulo_projeto }}
                </h2>

                <div class="space-y-2 text-sm text-slate-700">

                    <p>
                        <strong>Representante:</strong><br>
                        {{ $p->aluno_nome }}
                    </p>

                    <p>
                        <strong>Turma:</strong>
                        {{ $p->turma }}
                    </p>

                    <p>
                        <strong>Ano:</strong>
                        {{ $p->ano }}
                    </p>

                    <p>
                        <strong>Professor Orientador:</strong><br>
                        {{ $p->professor_orientador }}
                    </p>

                    @if($p->nota_total)
                    <p class="mt-3 text-green-700 font-bold">
                        Nota Final: {{ $p->nota_total }}
                    </p>
                    @endif

                </div>

            </div>
            @endforeach

        </div>

        @else

        <div class="text-center text-slate-500">
            Nenhum projeto selecionado até o momento.
        </div>

        @endif

    </div>
</section>

</main>

@include('layouts.footer')
