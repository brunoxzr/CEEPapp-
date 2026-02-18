@include('layouts.header', ['title' => 'Prêmios e Reconhecimentos — CEEP Assaí'])

<main class="bg-white text-slate-800">

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-28 text-white">
        <span class="inline-block mb-6 text-xs font-bold uppercase tracking-widest text-yellow-300">
            CEEP Assaí
        </span>

        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight max-w-3xl">
            Prêmios & Reconhecimentos
        </h1>

        <p class="mt-6 text-lg text-red-100 max-w-2xl">
            Conquistas que reforçam a inovação, o protagonismo estudantil
            e a excelência do ensino técnico público.
        </p>
    </div>
</section>

<!-- ================= DESTAQUE ================= -->
@if($premios->count())
@php
    $destaque = $premios->first();
    $secundarios = $premios->slice(1, 3);
    $lista = $premios->slice(4);
@endphp

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-3 gap-10">

            <!-- DESTAQUE PRINCIPAL -->
            <a href="{{ route('portal.premios.show', $destaque) }}"
               class="lg:col-span-2 group">

                <div class="aspect-[16/9] overflow-hidden rounded-xl bg-slate-200">
                    @if($destaque->imagem)
                        <img src="{{ asset('storage/'.$destaque->imagem) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @endif
                </div>

                <div class="mt-6">
                    <p class="text-xs text-slate-500 mb-2">
                        {{ $destaque->ano }}
                    </p>

                    <h2 class="text-2xl md:text-3xl font-black leading-tight group-hover:text-red-700 transition">
                        {{ $destaque->titulo }}
                    </h2>

                    <p class="mt-4 text-slate-600 text-lg line-clamp-3">
                        {{ $destaque->descricao }}
                    </p>

                    <p class="mt-3 text-sm text-slate-500">
                        👥 {{ $destaque->alunos->count() }} aluno(s) participante(s)
                    </p>
                </div>
            </a>

            <!-- SECUNDÁRIOS -->
            <div class="grid gap-6">
                @foreach($secundarios as $premio)
                    <a href="{{ route('portal.premios.show', $premio) }}"
                       class="flex gap-4 group">

                        <div class="w-32 aspect-[16/9] overflow-hidden rounded bg-slate-200 flex-shrink-0">
                            @if($premio->imagem)
                                <img src="{{ asset('storage/'.$premio->imagem) }}"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-1">
                                {{ $premio->ano }}
                            </p>

                            <h3 class="font-bold leading-snug group-hover:text-red-700 transition line-clamp-2">
                                {{ $premio->titulo }}
                            </h3>

                            <p class="text-xs text-slate-500 mt-1">
                                👥 {{ $premio->alunos->count() }} aluno(s)
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</section>

<!-- ================= LISTA EDITORIAL ================= -->
@if($lista->count())
<section class="pb-24 bg-white border-t">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mt-16 grid md:grid-cols-2 gap-x-12 gap-y-10">

            @foreach($lista as $premio)
                <a href="{{ route('portal.premios.show', $premio) }}"
                   class="group flex gap-5 items-start">

                    <div class="w-28 aspect-[16/9] overflow-hidden rounded-lg bg-slate-200 flex-shrink-0">
                        @if($premio->imagem)
                            <img src="{{ asset('storage/'.$premio->imagem) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @endif
                    </div>

                    <div class="flex-1">
                        <p class="text-xs text-slate-500 mb-1">
                            {{ $premio->ano }}
                        </p>

                        <h4 class="font-bold leading-snug text-slate-900
                                   group-hover:text-red-700 transition line-clamp-2">
                            {{ $premio->titulo }}
                        </h4>

                        <p class="text-sm text-slate-600 line-clamp-2 mt-1">
                            {{ $premio->descricao }}
                        </p>
                    </div>
                </a>
            @endforeach

        </div>

    </div>
</section>
@endif
@endif

</main>

@include('layouts.footer')
