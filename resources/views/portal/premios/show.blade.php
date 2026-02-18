@include('layouts.header', ['title' => $premio->titulo . ' — CEEP Assaí'])

<main class="bg-white text-slate-800">

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-5xl mx-auto px-6 py-24 text-white">

        <span class="inline-block mb-4 text-xs font-bold uppercase tracking-widest text-yellow-300">
            Prêmios & Reconhecimentos
        </span>

        <h1 class="text-3xl md:text-5xl font-black leading-tight">
            {{ $premio->titulo }}
        </h1>

        @if($premio->ano)
            <p class="mt-4 text-red-100 text-sm">
                Ano de reconhecimento: <strong>{{ $premio->ano }}</strong>
            </p>
        @endif
    </div>
</section>

<!-- ================= CONTEÚDO ================= -->
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-6">

        <!-- IMAGEM -->
        @if($premio->imagem)
            <div class="mb-12">
                <img src="{{ asset('storage/'.$premio->imagem) }}"
                     alt="{{ $premio->titulo }}"
                     class="w-full max-h-[460px] object-cover rounded-2xl shadow-lg">
            </div>
        @endif

        <!-- TEXTO -->
        <article class="prose prose-slate max-w-none prose-lg">
            <p>
                {{ $premio->descricao }}
            </p>
        </article>

        <!-- ================= ALUNOS ================= -->
        @if($premio->alunos->count())
            <div class="mt-20 border-t pt-14">

                <h2 class="text-2xl font-black text-red-800 mb-8">
                    Alunos Participantes
                </h2>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

                    @foreach($premio->alunos as $aluno)

                        @if($aluno->slug)
    <a href="{{ route('aluno.public', $aluno->slug) }}"
       class="group bg-slate-50 border rounded-2xl p-6
              hover:bg-red-50 hover:border-red-200 transition">

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-red-100
                        flex items-center justify-center
                        font-black text-red-700">
                {{ strtoupper(substr($aluno->nome, 0, 1)) }}
            </div>

            <div>
                <p class="font-bold text-slate-900
                          group-hover:text-red-700 transition">
                    {{ $aluno->nome }}
                </p>

                <p class="text-xs text-slate-500">
                    Ver perfil profissional
                </p>
            </div>
        </div>
    </a>
@endif



                    @endforeach

                </div>
            </div>
        @endif

        <!-- VOLTAR -->
        <div class="mt-20">
            <a href="{{ route('portal.premios') }}"
               class="inline-flex items-center gap-2
                      font-bold text-red-700 hover:underline">
                ← Voltar para Prêmios e Reconhecimentos
            </a>
        </div>

    </div>
</section>

</main>

@include('layouts.footer')
