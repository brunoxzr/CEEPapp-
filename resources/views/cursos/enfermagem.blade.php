@include('layouts.header', ['title' => 'Técnico em Enfermagem — CEEP Assaí'])

<!-- HERO COM FUNDO VISUAL -->
<section class="relative h-[85vh] min-h-[520px] flex items-center">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/enfermagem-bg.jpg"
             alt="Área da saúde e enfermagem"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-red-900/70"></div>
    </div>

    <!-- SVG orgânico (linhas suaves) -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.08]" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 200 C300 100 600 300 900 200 S1500 300 1800 200"
              stroke="white" stroke-width="1" fill="none"/>
        <path d="M0 350 C400 250 800 450 1200 350 S1600 450 2000 350"
              stroke="white" stroke-width="0.6" fill="none"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-red-200">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Enfermagem
            </h1>

            <p class="mt-8 text-lg text-red-100 leading-relaxed">
                Formação técnica voltada à área da saúde, preparando o estudante
                para atuar na assistência ao paciente, na promoção do cuidado,
                na prevenção de doenças e no apoio às equipes multiprofissionais.
            </p>

            <!-- dados rápidos -->
            <div class="mt-12 flex gap-10 text-sm text-red-200">
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
                Formação humanizada em saúde
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Enfermagem desenvolve competências técnicas,
                científicas e éticas necessárias para o cuidado integral ao
                paciente, respeitando princípios humanísticos e normativas da
                área da saúde.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                Durante a formação, o estudante vivencia práticas em ambientes
                simulados e supervisionados, aprendendo técnicas de enfermagem,
                primeiros socorros, biossegurança e organização dos serviços
                de saúde.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shape suave -->
    <div class="absolute -top-40 -right-40 w-[520px] h-[520px] rounded-full bg-red-100/40"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Hospitais
                </h3>
                <p class="mt-2 text-slate-600">
                    Atuação em unidades hospitalares e clínicas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Unidades de Saúde
                </h3>
                <p class="mt-2 text-slate-600">
                    Postos, UBS e centros de atenção básica.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Atendimento Domiciliar
                </h3>
                <p class="mt-2 text-slate-600">
                    Cuidados em home care e acompanhamento.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Instituições de Longa Permanência
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio ao cuidado contínuo e humanizado.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-red-900 text-red-100 relative overflow-hidden">

    <!-- linhas suaves -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 100 L2000 500" stroke="white" stroke-width="0.6"/>
        <path d="M2000 100 L0 500" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-red-300">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold">
                Profissional ético e comprometido com a vida
            </h2>

            <p class="mt-6 leading-relaxed text-red-200">
                Ao concluir o curso, o egresso estará apto a atuar de forma ética,
                responsável e humanizada, integrando equipes de saúde e contribuindo
                para a promoção do bem-estar e da qualidade de vida da população.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
