@include('layouts.header', ['title' => 'Técnico em Desenvolvimento de Sistemas — CEEP Assaí'])

<!-- HERO COM FUNDO VISUAL -->
<section class="relative h-[85vh] min-h-[520px] flex items-center">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/desenvolvimento-bg.jpg"
             alt="Tecnologia e programação"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>

    <!-- SVG técnico sutil -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#grid)"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Desenvolvimento<br class="hidden sm:block">
                de Sistemas
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada à área de tecnologia da informação,
                preparando o estudante para desenvolver sistemas computacionais,
                aplicações e soluções digitais alinhadas às demandas do mundo moderno.
            </p>

            <!-- dados rápidos -->
            <div class="mt-12 flex gap-10 text-sm text-slate-300">
                <div>
                    <span class="block">Duração</span>
                    <strong class="text-white">3 anos</strong>
                </div>
                <div>
                    <span class="block">Turno</span>
                    <strong class="text-white">Integral</strong>
                </div>
                <div>
                    <span class="block">Modalidade</span>
                    <strong class="text-white">Presencial</strong>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- BLOCO CONCEITUAL -->
<section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-20">

        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                Formação tecnológica integrada
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Desenvolvimento de Sistemas promove a integração
                entre fundamentos teóricos e práticas aplicadas, possibilitando ao
                estudante compreender os processos que envolvem a criação de soluções
                computacionais.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                Ao longo da formação, o estudante desenvolve competências em
                programação, banco de dados, desenvolvimento web e organização
                de sistemas, utilizando metodologias e ferramentas atuais do setor
                de tecnologia.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shape decorativo -->
    <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full bg-slate-200/40"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Desenvolvimento Web
                </h3>
                <p class="mt-2 text-slate-600">
                    Criação de sistemas e aplicações para web.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Programação de Sistemas
                </h3>
                <p class="mt-2 text-slate-600">
                    Desenvolvimento de softwares e aplicações.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Banco de Dados
                </h3>
                <p class="mt-2 text-slate-600">
                    Estruturação e manutenção de dados.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Suporte Técnico
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio e manutenção de sistemas computacionais.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-100 relative overflow-hidden">

    <!-- linhas decorativas -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="0" x2="100%" y2="100%" stroke="white" stroke-width="0.5"/>
        <line x1="100%" y1="0" x2="0" y2="100%" stroke="white" stroke-width="0.5"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold">
                Profissional preparado para o mundo digital
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso do curso técnico em Desenvolvimento de Sistemas estará
                apto a atuar de forma ética e responsável no desenvolvimento de
                soluções tecnológicas, compreendendo sistemas computacionais
                e suas aplicações no contexto social e produtivo.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
