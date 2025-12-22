@include('layouts.header', ['title' => 'CEEP Assaí — Portal Institucional'])

<main class="bg-white text-slate-800">

<!-- HERO PREMIUM -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-32 grid lg:grid-cols-2 gap-20 items-center text-white">

        <div>
            <span class="inline-block mb-6 text-xs font-bold uppercase tracking-widest text-yellow-300">
                Centro Estadual de Educação Profissional
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                CEEP Assaí
            </h1>

            <p class="mt-6 text-lg text-red-100 max-w-xl">
                Formação técnica pública de excelência, conectando educação,
                tecnologia e desenvolvimento profissional no norte do Paraná.
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

        <div class="relative hidden lg:block">
            <img src="/img/frenteCeep.jpg"
                 alt="CEEP Assaí"
                 class="w-full h-[420px] object-cover rounded-lg shadow-2xl border-4 border-white/20">
        </div>

    </div>
</section>

<!-- INSTITUCIONAL -->
<section id="institucional" class="py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-24 items-start">

        <div>
            <h2 class="text-3xl font-black text-red-800 mb-8">
                Institucional
            </h2>

            <p class="text-slate-700 text-lg leading-relaxed mb-5">
                Inaugurado em 27 de junho de 2014, o Centro Estadual de Educação
                Profissional Professora Maria Lydia Cescatto Bomtempo foi criado
                para fortalecer a educação técnica e profissional em Assaí e
                região.
            </p>

            <p class="text-slate-600 leading-relaxed">
                Integrante da rede pública estadual de ensino do Paraná, o CEEP
                atua com foco em qualidade, organização acadêmica e inserção
                profissional de seus estudantes.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="border-l-4 border-red-700 pl-5">
                <strong class="block text-slate-900">Ano de Inauguração</strong>
                <span class="text-slate-600">2014</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong class="block text-slate-900">Investimento</strong>
                <span class="text-slate-600">R$ 8,46 milhões</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong class="block text-slate-900">Estrutura</strong>
                <span class="text-slate-600">12 salas • 9 laboratórios</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong class="block text-slate-900">Modalidades</strong>
                <span class="text-slate-600">Integrado e Subsequente</span>
            </div>
        </div>

    </div>
</section>

<!-- CURSOS -->
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
                   class="group bg-white border rounded-lg p-8 hover:shadow-xl transition">

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-red-700 transition">
                        {{ $curso['nome'] }}
                    </h3>

                    <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                        Formação técnica voltada ao mercado de trabalho, com
                        base científica e prática profissional.
                    </p>

                    <span class="inline-block mt-6 text-sm font-semibold text-red-700">
                        Ver curso →
                    </span>
                </a>
            @endforeach

        </div>
    </div>
</section>

<!-- NOTÍCIAS -->
<section id="noticias" class="py-28 bg-white border-t">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-14">
            <h2 class="text-3xl font-black text-slate-900">
                Notícias
            </h2>

            <a href="{{ route('portal.news.index') }}"
               class="text-sm font-bold text-red-700 hover:underline">
                Ver todas
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse(($news ?? collect()) as $item)
                <article class="border rounded-lg overflow-hidden hover:shadow-lg transition">

                    <img src="{{ asset('storage/'.$item->cover_path) }}"
                         class="w-full h-44 object-cover">

                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-2">
                            {{ $item->published_at?->format('d/m/Y') }}
                        </p>

                        <h3 class="font-bold text-slate-900 leading-snug">
                            {{ $item->title }}
                        </h3>

                        <a href="{{ route('portal.news.show',$item->slug) }}"
                           class="inline-block mt-4 text-sm font-semibold text-red-700">
                            Ler notícia →
                        </a>
                    </div>
                </article>
            @empty
                <p class="col-span-full text-center text-slate-500">
                    Nenhuma notícia publicada no momento.
                </p>
            @endforelse

        </div>
    </div>
</section>

<!-- CONTATO -->
<section id="contato" class="py-28 bg-slate-50 border-t">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-20 items-center">

        <div>
            <h2 class="text-2xl font-black text-red-800 mb-6">
                Contato
            </h2>

            <p class="text-slate-700 leading-relaxed">
                Rua Edgar Bardal, s/n<br>
                Assaí – PR • CEP 86220-000<br>
                Telefone: (43) 3262-2063
            </p>
        </div>

        <iframe
            class="w-full h-72 border rounded-lg"
            loading="lazy"
            src="https://www.google.com/maps?q=Centro+Estadual+de+Educação+Profissional+Assaí&output=embed">
        </iframe>

    </div>
</section>

</main>

@include('layouts.footer')
