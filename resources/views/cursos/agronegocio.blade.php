@include('layouts.header', ['title' => 'Técnico em Agronegócio Integrado ao Ensino Médio — CEEP Assaí'])

<!-- HERO CAMPO -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/agropecuaria-bg.jpg"
             alt="Agronegócio, produção agrícola e formação integrada"
             class="w-full h-full object-cover opacity-90">
        <div class="absolute inset-0 bg-emerald-950/65"></div>
    </div>

    <!-- SVG orgânico -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.08]" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 480 C300 420 600 540 900 480 S1500 540 2000 480"
              fill="none" stroke="white" stroke-width="0.8"/>
        <path d="M0 620 C400 560 800 700 1200 620 S1600 700 2000 620"
              fill="none" stroke="white" stroke-width="0.6"/>
        <path d="M0 760 C500 700 1000 860 1500 760 S1800 860 2000 760"
              fill="none" stroke="white" stroke-width="0.5"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-emerald-200">
                Curso Técnico — Integrado ao Ensino Médio
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Técnico em Agronegócio
            </h1>

            <p class="mt-8 text-lg text-emerald-100 leading-relaxed">
                Formação integrada que alia o Ensino Médio à qualificação técnica
                em agronegócio, preparando o estudante para compreender os sistemas
                de produção agrícola e pecuária com visão científica, técnica,
                social e ambiental.
            </p>

            <!-- dados rápidos -->
            <div class="mt-12 flex gap-10 text-sm text-emerald-200">
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
                Formação integrada e técnica para o agronegócio
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O Curso Técnico em Agronegócio Integrado ao Ensino Médio forma
                profissionais capacitados para atuar nos diversos segmentos
                do setor agropecuário, aliando conhecimentos técnicos, científicos
                e de gestão à formação geral do Ensino Médio.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação prepara o estudante para compreender os sistemas
                de produção agrícola e pecuária considerando aspectos
                econômicos, ambientais e sociais, valorizando práticas
                sustentáveis, inovação tecnológica e empreendedorismo rural.
            </p>
        </div>

    </div>
</section>

<!-- FORMAÇÃO DO ESTUDANTE -->
<section class="bg-slate-50">
    <div class="max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-10">
            O que o estudante aprende
        </h2>

        <p class="max-w-4xl text-slate-700 leading-relaxed">
            O estudante aprende sobre produção agrícola e pecuária, manejo do solo
            e da água, fertilidade e nutrição de plantas, sanidade vegetal e animal,
            mecanização agrícola, gestão e planejamento rural, comercialização,
            cooperativismo, sustentabilidade, uso de tecnologias aplicadas ao campo,
            além de práticas laboratoriais e atividades de campo.
        </p>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-white relative overflow-hidden">

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação profissional
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-12 text-sm">

            <div>
                <h3 class="font-semibold text-slate-900">Propriedades rurais</h3>
                <p class="mt-2 text-slate-600">
                    Planejamento e acompanhamento das atividades produtivas.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Empresas do agronegócio</h3>
                <p class="mt-2 text-slate-600">
                    Atuação em processos produtivos, comerciais e técnicos.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Cooperativas agropecuárias</h3>
                <p class="mt-2 text-slate-600">
                    Apoio técnico e gestão cooperativa.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Agroindústrias</h3>
                <p class="mt-2 text-slate-600">
                    Processamento e controle de produtos agropecuários.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Assistência técnica rural</h3>
                <p class="mt-2 text-slate-600">
                    Orientação técnica e extensão rural.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Empreendimentos próprios</h3>
                <p class="mt-2 text-slate-600">
                    Desenvolvimento de negócios no meio rural.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-emerald-950 text-emerald-100 relative overflow-hidden">

    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 120 L2000 360" stroke="white" stroke-width="0.6"/>
        <path d="M2000 120 L0 360" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-emerald-300">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional com formação técnica e visão integrada do agronegócio
            </h2>

            <p class="mt-6 leading-relaxed text-emerald-200">
                O egresso possui sólida formação técnica e visão integrada do
                agronegócio, sendo capaz de planejar, executar e acompanhar
                atividades produtivas no meio rural, com responsabilidade
                ambiental, domínio de técnicas modernas e preparo para o
                mercado de trabalho ou continuidade dos estudos em nível superior.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
