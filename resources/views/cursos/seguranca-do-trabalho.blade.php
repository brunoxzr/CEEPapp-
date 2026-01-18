@include('layouts.header', ['title' => 'Técnico em Segurança do Trabalho — CEEP Assaí'])

<!-- HERO SEGURANÇA DO TRABALHO -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/seguranca-trabalho-bg.jpg"
             alt="Segurança do trabalho e prevenção"
             class="w-full h-full object-cover opacity-90">
        <div class="absolute inset-0 bg-amber-950/70"></div>
    </div>

    <!-- SVG industrial -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="safety-grid" width="56" height="56" patternUnits="userSpaceOnUse">
                <path d="M56 0 L0 0 0 56" fill="none" stroke="white" stroke-width="0.6"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#safety-grid)"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-amber-200">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Segurança do Trabalho
            </h1>

            <p class="mt-8 text-lg text-amber-100 leading-relaxed">
                Formação técnica voltada à prevenção de acidentes e promoção da
                saúde no ambiente de trabalho, capacitando o estudante para atuar
                com normas de segurança, análise de riscos e proteção coletiva.
            </p>

            <!-- dados rápidos -->
            <div class="mt-12 flex gap-10 text-sm text-amber-200">
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
                Formação técnica em prevenção e segurança
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Segurança do Trabalho forma profissionais
                capacitados para identificar riscos, elaborar ações preventivas
                e promover ambientes de trabalho seguros e saudáveis.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação integra legislação, normas regulamentadoras e práticas
                de segurança, preparando o estudante para atuar de forma responsável
                e preventiva em diferentes setores produtivos.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shapes industriais -->
    <div class="absolute -top-44 -right-44 w-[540px] h-[540px] rounded-full bg-amber-200/30"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-300/30"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Indústrias
                </h3>
                <p class="mt-2 text-slate-600">
                    Prevenção de acidentes e controle de riscos industriais.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Construção Civil
                </h3>
                <p class="mt-2 text-slate-600">
                    Segurança em obras e canteiros de trabalho.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Serviços e Comércio
                </h3>
                <p class="mt-2 text-slate-600">
                    Promoção da saúde e prevenção ocupacional.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Consultoria e Assessoria
                </h3>
                <p class="mt-2 text-slate-600">
                    Orientação técnica e elaboração de laudos e programas.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-amber-950 text-amber-100 relative overflow-hidden">

    <!-- linhas normativas -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="120" x2="100%" y2="360" stroke="white" stroke-width="0.6"/>
        <line x1="100%" y1="120" x2="0" y2="360" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-amber-300">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico comprometido com a vida e a segurança
            </h2>

            <p class="mt-6 leading-relaxed text-amber-200">
                O egresso estará apto a atuar na prevenção de acidentes, promoção
                da saúde ocupacional e cumprimento das normas de segurança,
                contribuindo para ambientes de trabalho mais seguros e responsáveis.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
