@include('layouts.header', ['title' => 'Técnico em Administração — CEEP Assaí'])

<!-- HERO ADMINISTRAÇÃO -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/administracao-bg.jpg"
             alt="Gestão, negócios e ambiente corporativo"
             class="w-full h-full object-cover opacity-90">
        <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>

    <!-- linhas geométricas (organização / gestão) -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="200" x2="2000" y2="200" stroke="white" stroke-width="0.6"/>
        <line x1="0" y1="420" x2="2000" y2="420" stroke="white" stroke-width="0.4"/>
        <line x1="0" y1="640" x2="2000" y2="640" stroke="white" stroke-width="0.3"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Administração
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada à gestão, organização e controle
                de processos administrativos, preparando o estudante
                para atuar em empresas, instituições públicas e
                empreendimentos próprios.
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
                Formação técnica para gestão e tomada de decisões
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Administração forma profissionais
                capacitados para planejar, organizar, executar e
                controlar atividades administrativas em organizações
                públicas e privadas.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação integra teoria e prática, desenvolvendo
                competências em gestão financeira, recursos humanos,
                marketing, logística e processos organizacionais.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shapes institucionais -->
    <div class="absolute -top-40 -right-40 w-[520px] h-[520px] rounded-full bg-slate-300/30"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-200/40"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Administração Geral
                </h3>
                <p class="mt-2 text-slate-600">
                    Organização e controle de rotinas administrativas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Recursos Humanos
                </h3>
                <p class="mt-2 text-slate-600">
                    Gestão de pessoas, recrutamento e rotinas trabalhistas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Finanças e Contabilidade
                </h3>
                <p class="mt-2 text-slate-600">
                    Controle financeiro, custos e apoio contábil.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Marketing e Vendas
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio comercial, atendimento e estratégias de mercado.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-200 relative overflow-hidden">

    <!-- linhas diagonais -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 100 L2000 300" stroke="white" stroke-width="0.6"/>
        <path d="M2000 100 L0 300" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico para gestão, organização e resultados
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso estará apto a atuar com ética, responsabilidade
                e visão organizacional, contribuindo para a eficiência
                administrativa e o desenvolvimento das organizações.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
