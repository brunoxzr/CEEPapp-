@include('layouts.header', ['title' => 'CEEP Assaí — Portal Institucional'])
@push('preload-images')
    {{-- HERO --}}
    <link rel="preload" as="image" href="/img/frenteCeep.jpg">

    {{-- NOTÍCIA EM DESTAQUE --}}
    @if($featured && $featured->cover_path)
        <link rel="preload" as="image" href="{{ asset('storage/'.$featured->cover_path) }}">
    @endif
@endpush

<main class="bg-white text-slate-800">

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-32 grid lg:grid-cols-2 gap-20 items-center text-white">

        <!-- TEXTO -->
        <div>
            <span class="inline-block mb-6 text-xs font-bold uppercase tracking-widest text-yellow-300">
                Centro Estadual de Educação Profissional
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                CEEP Assaí
            </h1>

            <p class="mt-6 text-lg text-red-100 max-w-xl">
                Educação técnica pública que prepara profissionais para o mercado de trabalho,
                com laboratórios modernos e projetos práticos em Assaí e região.
            </p>

            <div class="mt-10 flex flex-wrap gap-4">
                <a href="#cursos"
                   class="px-7 py-3 bg-yellow-400 text-red-900 font-bold rounded-md hover:bg-yellow-300 transition">
                    Cursos Ofertados
                </a>

                <a href="#institucional"
                   class="px-7 py-3 border border-white/40 font-semibold rounded-md hover:bg-white/10 transition">
                    Conheça o CEEP
                </a>
            </div>
        </div>

        <!-- IMAGEM HERO -->
        <div class="relative hidden lg:block">
            <div class="aspect-[16/9] overflow-hidden rounded-xl shadow-2xl border-4 border-white/20">
                <img src="/img/frenteCeep.jpg"
                     alt="CEEP Assaí"
                     class="w-full h-full object-cover">
            </div>
        </div>

    </div>
</section>

<!-- ================= INSTITUCIONAL ================= -->
<section id="institucional" class="py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-24 items-start">

        <div>
            <h2 class="text-3xl font-black text-red-800 mb-8">
                Institucional
            </h2>

            <p class="text-slate-700 text-lg leading-relaxed mb-5">
                Inaugurado em 27 de junho de 2014, o Centro Estadual de Educação
                Profissional Professora Maria Lydia Cescatto Bomtempo oferece
                cursos técnicos integrados e subsequentes para estudantes de Assaí
                e região.
            </p>

            <p class="text-slate-600 leading-relaxed">
                Faz parte da rede estadual de ensino do Paraná e trabalha com
                projetos práticos, estágios e parcerias com empresas locais para
                melhorar a formação dos alunos.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="border-l-4 border-red-700 pl-5">
                <strong>Ano de Inauguração</strong>
                <span class="block text-slate-600">2014</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Investimento</strong>
                <span class="block text-slate-600">R$ 8,46 milhões</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Estrutura</strong>
                <span class="block text-slate-600">12 salas • 9 laboratórios</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Modalidades</strong>
                <span class="block text-slate-600">Integrado e Subsequente</span>
            </div>
        </div>

    </div>
</section>

<!-- ================= CURSOS ================= -->
<section id="cursos" class="py-28 bg-slate-50 border-t">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-black text-slate-900 mb-16 text-center">
            Cursos Ofertados
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @php
                $cursos = [
                    ['nome'=>'Agropecuária','slug'=>'agropecuaria'],
                    ['nome'=>'Desenvolvimento de Sistemas','slug'=>'desenvolvimento-de-sistemas'],
                    ['nome'=>'Edificações','slug'=>'edificacoes'],
                    ['nome'=>'Eletrotécnica','slug'=>'eletrotecnica'],
                    ['nome'=>'Enfermagem','slug'=>'enfermagem'],
                    ['nome'=>'Mecânica Industrial','slug'=>'mecanica-industrial'],
                ];
            @endphp

            @foreach($cursos as $curso)
                <a href="{{ url('/cursos/'.$curso['slug']) }}"
                   class="group bg-white border rounded-xl p-8 hover:shadow-xl transition">

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-red-700">
                        {{ $curso['nome'] }}
                    </h3>

                    <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                        Curso técnico com aulas teóricas e práticas em laboratórios
                        equipados.
                    </p>

                    <span class="inline-block mt-6 text-sm font-semibold text-red-700">
                        Ver curso →
                    </span>
                </a>
            @endforeach

        </div>
    </div>
</section>
<!-- ================= NOTÍCIAS (G1 STYLE) ================= -->
<section id="noticias" class="py-28 bg-white border-t">
    <div class="max-w-7xl mx-auto px-6">

        <!-- TÍTULO -->
        <div class="flex justify-between items-end mb-14">
            <h2 class="text-3xl font-black text-slate-900">
                Notícias
            </h2>

            <a href="{{ route('portal.news.index') }}"
               class="text-sm font-bold text-red-700 hover:underline">
                Ver todas →
            </a>
        </div>

        @if($featured)
        <!-- GRID PRINCIPAL -->
        <div class="grid lg:grid-cols-3 gap-10">

            <!-- DESTAQUE -->
            <a href="{{ route('portal.news.show', $featured->slug) }}"
               class="lg:col-span-2 group">

                <div class="aspect-[16/9] overflow-hidden rounded-xl bg-slate-200">
                    <img
                        src="{{ asset('storage/'.$featured->cover_path) }}"
                        alt="{{ $featured->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="mt-6">
                    <p class="text-xs text-slate-500 mb-2">
                        {{ $featured->published_at?->format('d/m/Y') }}
                    </p>

                    <h3 class="text-2xl font-black leading-tight group-hover:text-red-700 transition">
                        {{ $featured->title }}
                    </h3>
                </div>
            </a>

            <!-- SECUNDÁRIAS -->
            <div class="grid gap-6">
                @foreach($secondary as $item)
                    <a href="{{ route('portal.news.show', $item->slug) }}"
                       class="flex gap-4 group">

                        <div class="w-32 aspect-[16/9] overflow-hidden rounded bg-slate-200 flex-shrink-0">
                            <img
                                src="{{ asset('storage/'.$item->cover_path) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-1">
                                {{ $item->published_at?->format('d/m/Y') }}
                            </p>

                            <h4 class="font-bold leading-snug group-hover:text-red-700 transition">
                                {{ $item->title }}
                            </h4>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
        @endif

        <!-- LISTA ABAIXO -->
        @if($list->count())
<div class="mt-20 border-t pt-14 grid md:grid-cols-2 gap-x-12 gap-y-10">
    @foreach($list as $item)
        <a href="{{ route('portal.news.show', $item->slug) }}"
           class="group flex gap-5 items-start">

            {{-- THUMB --}}
            <div class="w-28 aspect-[16/9] overflow-hidden rounded-lg bg-slate-200 flex-shrink-0">
                @if($item->cover_path)
                    <img
                        src="{{ asset('storage/'.$item->cover_path) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-red-800 to-red-900 flex items-center justify-center">
                        <span class="text-white text-xs font-bold tracking-widest uppercase">
                            CEEP
                        </span>
                    </div>
                @endif
            </div>

            {{-- TEXTO --}}
            <div class="flex-1">
                <p class="text-xs text-slate-500 mb-1">
                    {{ $item->published_at?->format('d/m/Y') }}
                </p>

                <h5 class="font-bold leading-snug text-slate-900 group-hover:text-red-700 transition line-clamp-2">
                    {{ $item->title }}
                </h5>
            </div>

        </a>
    @endforeach
</div>

        @endif

    </div>
</section>
<!-- ================= DIREÇÃO ================= -->
@if($direcao->count())
<section class="py-28 bg-slate-50 border-t">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-black text-red-800 mb-14">
            Direção
        </h2>

        <div class="flex flex-wrap justify-center gap-12">

            @foreach($direcao as $pessoa)
                <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
                   class="group w-72 bg-white rounded-2xl shadow hover:shadow-xl transition p-8">

                    <!-- FOTO -->
                    @if($pessoa->foto)
                        <img src="{{ asset('storage/'.$pessoa->foto) }}"
                             class="w-36 h-36 mx-auto rounded-full object-cover border-4 border-red-700/30">
                    @else
                        <div class="w-36 h-36 mx-auto rounded-full bg-slate-200"></div>
                    @endif

                    <!-- TEXTO -->
                    <h3 class="mt-6 font-bold text-lg group-hover:text-red-700 transition">
                        {{ $pessoa->nome }}
                    </h3>

                    <p class="text-sm text-red-700 font-semibold mt-1">
                        {{ $pessoa->cargo }}
                    </p>
                </a>
            @endforeach

        </div>

    </div>
</section>
@endif

<!-- ================= DESENVOLVEDORES (DESTAQUE ESPECIAL) ================= -->
@if($desenvolvedores->count())
<section class="py-28 bg-white border-t">
    <div class="max-w-6xl mx-auto px-6">

    <h3 class="text-center text-xl font-black text-slate-900 mb-6">
        Desenvolvimento de Sistemas
    </h3>

    <p class="text-center text-slate-600 max-w-xl mx-auto mb-16">
        Alunos do curso de Desenvolvimento de Sistemas que trabalham
        nos sistemas e portais do CEEP.
    </p>

    @if($desenvolvedores->count() === 1)
        @php $pessoa = $desenvolvedores->first(); @endphp

        <!-- CARD CENTRAL (SÓ UM DEV) -->
        <div class="flex justify-center">
            <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
               class="group w-[420px] bg-white rounded-3xl shadow-xl
                      hover:shadow-2xl transition p-10 text-center
                      border border-red-700/20 relative">

                <!-- BADGE -->
                <span class="absolute -top-4 left-1/2 -translate-x-1/2
                             bg-red-700 text-white text-xs font-bold
                             px-4 py-1 rounded-full tracking-wide">
                    Desenvolvedor
                </span>

                <!-- FOTO -->
                @if($pessoa->foto)
                    <img src="{{ asset('storage/'.$pessoa->foto) }}"
                         alt="{{ $pessoa->nome }}"
                         class="w-40 h-40 mx-auto rounded-full object-cover
                                border-4 border-red-700/40">
                @else
                    <div class="w-40 h-40 mx-auto rounded-full bg-slate-200"></div>
                @endif

                <!-- NOME -->
                <h4 class="mt-8 font-black text-2xl text-slate-900
                           group-hover:text-red-700 transition">
                    {{ $pessoa->nome }}
                </h4>

                <!-- CARGO -->
                <p class="mt-2 text-red-700 font-semibold">
                    {{ $pessoa->cargo }}
                </p>

                <!-- COMPLEMENTO ACADÊMICO -->
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Aluno do curso técnico em <strong>Desenvolvimento de Sistemas</strong>,
                    participa do desenvolvimento dos sistemas e portais do CEEP Assaí.
                </p>

            </a>
        </div>

    @else
        <!-- GRID NORMAL (CASO TENHA MAIS DE UM DEV) -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-14">

            @foreach($desenvolvedores as $pessoa)
                <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
                   class="group text-center">

                    @if($pessoa->foto)
                        <img src="{{ asset('storage/'.$pessoa->foto) }}"
                             alt="{{ $pessoa->nome }}"
                             class="w-28 h-28 mx-auto rounded-full object-cover
                                    border-2 border-red-700/30
                                    group-hover:scale-110 transition">
                    @else
                        <div class="w-28 h-28 mx-auto rounded-full bg-slate-200"></div>
                    @endif

                    <h4 class="mt-5 font-semibold text-slate-900 group-hover:text-red-700 transition">
                        {{ $pessoa->nome }}
                    </h4>

                    <p class="text-xs text-slate-500 mt-1">
                        {{ $pessoa->cargo }}
                    </p>
                </a>
            @endforeach

        </div>
    @endif

    </div>
</section>
@endif

<!-- ================= CONTATO ================= -->
<section id="contato" class="py-28 bg-slate-50 border-t">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-20 items-center">

        <div>
            <h2 class="text-2xl font-black text-red-800 mb-6">
                Contato
            </h2>

            <div class="space-y-4 text-slate-700">
                <div>
                    <p class="font-semibold mb-1">Endereço</p>
                    <p class="leading-relaxed">
                        Rua Edgar Bardal, s/n<br>
                        Assaí – PR • CEP 86220-000
                    </p>
                </div>

                <div>
                    <p class="font-semibold mb-1">Telefone</p>
                    <p class="leading-relaxed">
                        <a href="tel:+554332622063" class="text-red-700 hover:underline">
                            (43) 3262-2063
                        </a>
                    </p>
                </div>

                <div>
                    <p class="font-semibold mb-1">Atendimento</p>
                    <p class="leading-relaxed text-sm">
                        Segunda a sexta-feira, horário comercial
                    </p>
                </div>
            </div>

        <iframe
            class="w-full h-80 border rounded-xl"
            loading="lazy"
            src="https://www.google.com/maps?q=Centro+Estadual+de+Educação+Profissional+Assaí&output=embed">
        </iframe>

    </div>
</section>

</main>

@include('layouts.footer')
