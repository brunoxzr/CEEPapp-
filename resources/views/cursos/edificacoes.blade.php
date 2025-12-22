@include('layouts.header', ['title' => 'Técnico em Edificações — CEEP Assaí'])

<!-- HERO ARQUITETURA -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/edificacoes-bg.jpg"
             alt="Projeto arquitetônico e construção civil"
             class="w-full h-full object-cover opacity-85">
        <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>

    <!-- SVG planta baixa -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.08]" xmlns="http://www.w3.org/2000/svg">
        <rect x="120" y="120" width="520" height="320" fill="none" stroke="white" stroke-width="0.8"/>
        <rect x="700" y="180" width="420" height="260" fill="none" stroke="white" stroke-width="0.6"/>
        <line x1="120" y1="280" x2="640" y2="280" stroke="white" stroke-width="0.6"/>
        <line x1="700" y1="310" x2="1120" y2="310" stroke="white" stroke-width="0.6"/>
        <line x1="380" y1="120" x2="380" y2="440" stroke="white" stroke-width="0.6"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Edificações
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada ao planejamento, execução e acompanhamento
                de obras, capacitando profissionais para atuar em projetos,
                construção civil e controle de processos construtivos.
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
                Formação técnica para o setor da construção civil
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Edificações forma profissionais aptos a atuar
                no desenvolvimento de projetos, leitura de plantas, orçamento,
                acompanhamento de obras e controle de qualidade dos processos
                construtivos.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                Durante a formação, o estudante desenvolve conhecimentos em
                desenho técnico, materiais de construção, topografia,
                planejamento e gestão de obras.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shapes estruturais -->
    <div class="absolute -top-44 -right-44 w-[540px] h-[540px] bg-slate-200/40"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-300/30"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Construção Civil
                </h3>
                <p class="mt-2 text-slate-600">
                    Acompanhamento e execução de obras.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Escritórios Técnicos
                </h3>
                <p class="mt-2 text-slate-600">
                    Desenvolvimento e leitura de projetos.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Orçamentos e Planejamento
                </h3>
                <p class="mt-2 text-slate-600">
                    Levantamento de custos e cronogramas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Fiscalização de Obras
                </h3>
                <p class="mt-2 text-slate-600">
                    Controle técnico e acompanhamento.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-200 relative overflow-hidden">

    <!-- linhas estruturais -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="100" x2="2000" y2="100" stroke="white" stroke-width="0.6"/>
        <line x1="0" y1="260" x2="2000" y2="260" stroke="white" stroke-width="0.6"/>
        <line x1="0" y1="420" x2="2000" y2="420" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico para planejamento e execução de obras
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso estará apto a atuar de forma técnica, responsável
                e organizada, contribuindo para a qualidade, segurança
                e eficiência de obras e projetos da construção civil.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
