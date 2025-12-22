@include('layouts.header', ['title' => 'Técnico em Eletrotécnica — CEEP Assaí'])

<!-- HERO ENERGIA -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/eletrotecnica-bg.jpg"
             alt="Laboratório e sistemas elétricos"
             class="w-full h-full object-cover opacity-85">
        <div class="absolute inset-0 bg-slate-900/72"></div>
        <div class="absolute inset-0 bg-blue-950/35"></div>
    </div>

    <!-- SVG técnico (linhas + pulsos) -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.08]" xmlns="http://www.w3.org/2000/svg">
        <!-- linhas verticais -->
        <line x1="180" y1="0" x2="180" y2="1200" stroke="white" stroke-width="0.6"/>
        <line x1="520" y1="0" x2="520" y2="1200" stroke="white" stroke-width="0.6"/>
        <line x1="920" y1="0" x2="920" y2="1200" stroke="white" stroke-width="0.6"/>
        <line x1="1360" y1="0" x2="1360" y2="1200" stroke="white" stroke-width="0.6"/>

        <!-- pulso horizontal -->
        <path d="M0 420 L220 420 L260 360 L320 520 L380 420 L2000 420"
              fill="none" stroke="white" stroke-width="0.8"/>
        <path d="M0 560 L520 560 L580 500 L660 640 L740 560 L2000 560"
              fill="none" stroke="white" stroke-width="0.5"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Eletrotécnica
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada a instalações elétricas, sistemas de energia,
                comandos e automação, preparando profissionais para atuar com segurança,
                precisão técnica e conformidade com normas e procedimentos.
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
                Base técnica com foco em segurança e normas
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Eletrotécnica forma profissionais capazes de
                interpretar projetos, executar instalações elétricas e atuar em
                sistemas de energia e automação, respeitando normas técnicas e
                procedimentos de segurança.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação inclui práticas em laboratórios e atividades técnicas,
                com desenvolvimento de competências em comandos elétricos,
                instrumentação básica, manutenção e diagnóstico de sistemas.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shape energia -->
    <div class="absolute -top-44 -right-44 w-[540px] h-[540px] rounded-full bg-blue-200/25"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-200/40"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Instalações Elétricas
                </h3>
                <p class="mt-2 text-slate-600">
                    Execução e manutenção de instalações.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Sistemas de Energia
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio a redes, painéis e distribuição.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Comandos e Automação
                </h3>
                <p class="mt-2 text-slate-600">
                    Painéis, comandos e controles elétricos.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Manutenção Elétrica
                </h3>
                <p class="mt-2 text-slate-600">
                    Diagnóstico e correção de falhas.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-200 relative overflow-hidden">

    <!-- linhas de circuito -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 120 H520 V220 H980 V420 H2000" fill="none" stroke="white" stroke-width="0.6"/>
        <path d="M0 320 H760 V120 H1320 V260 H2000" fill="none" stroke="white" stroke-width="0.6"/>
        <circle cx="520" cy="120" r="3" fill="white"/>
        <circle cx="980" cy="220" r="3" fill="white"/>
        <circle cx="1320" cy="120" r="3" fill="white"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico para sistemas elétricos e industriais
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso estará apto a atuar com responsabilidade e precisão
                em sistemas elétricos, contribuindo para a segurança,
                eficiência e continuidade de operações em ambientes técnicos
                e industriais.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
