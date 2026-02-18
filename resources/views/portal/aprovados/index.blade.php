@include('layouts.header', ['title' => 'Mural dos Aprovados — CEEP Assaí'])

<main class="bg-slate-100">

<!-- HERO IMPACTANTE -->
<section class="bg-gradient-to-r from-yellow-400 to-yellow-300 py-20 text-center relative overflow-hidden">

    <div class="absolute inset-0 opacity-10
                bg-[radial-gradient(circle_at_center,_#000,_transparent_70%)]">
    </div>

    <div class="relative max-w-5xl mx-auto px-6">
        <h1 class="text-5xl md:text-6xl font-black text-red-900">
            Mural dos Aprovados
        </h1>

        <p class="mt-6 text-lg font-semibold text-red-800">
            Vestibular • Universidades • Bolsas • Conquistas
        </p>
    </div>

</section>

<!-- LISTA MURAL -->
<section class="py-20">

    <div class="max-w-7xl mx-auto px-6">

        @if($aprovados->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-14">

                @foreach($aprovados as $item)

                    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden
                                transform hover:-translate-y-2 hover:shadow-3xl transition duration-300">

                        <!-- FOTO -->
                        @if($item->foto)
                            <div class="relative">
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                     class="w-full h-[420px] object-cover">

                                <!-- BADGE APROVADO -->
                                <div class="absolute top-4 right-4 bg-red-700 text-white
                                            px-4 py-2 text-xs font-black rounded-full shadow-lg">
                                    APROVADO
                                </div>
                            </div>
                        @else
                            <div class="h-[420px] bg-slate-200 flex items-center justify-center">
                                <span class="text-slate-500 font-semibold">
                                    Sem Foto
                                </span>
                            </div>
                        @endif

                        <!-- CONTEÚDO -->
                        <div class="p-8 text-center">

                            <h3 class="text-2xl font-black text-red-800 uppercase tracking-wide">
                                {{ $item->nome }}
                            </h3>

                            <p class="mt-3 text-sm font-semibold text-slate-600">
                                Curso Técnico em {{ $item->curso }}
                            </p>

                            <div class="mt-5 bg-red-50 rounded-xl p-4">
                                <p class="text-sm text-slate-600">
                                    Aprovado em
                                </p>
                                <p class="font-black text-red-700 text-lg">
                                    {{ strtoupper($item->aprovado_em) }}
                                </p>
                            </div>

                            @if($item->ano)
                                <p class="mt-4 text-xs text-slate-400">
                                    {{ $item->ano }}
                                </p>
                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-slate-600">
                    Nenhum aprovado cadastrado ainda.
                </h2>
            </div>

        @endif

    </div>

</section>

</main>

@include('layouts.footer')
