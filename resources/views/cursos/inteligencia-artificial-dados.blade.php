@include('layouts.header', ['title' => 'Técnico em Inteligência Artificial e Ciência de Dados — CEEP Assaí'])

<!-- HERO IA -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/ia-bg.jpg"
             alt="Inteligência artificial e dados"
             class="w-full h-full object-cover opacity-90">
        <div class="absolute inset-0 bg-slate-950/75"></div>
    </div>

    <!-- SVG tecnológico -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="ai-grid" width="52" height="52" patternUnits="userSpaceOnUse">
                <path d="M52 0 L0 0 0 52" fill="none" stroke="white" stroke-width="0.6"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#ai-grid)"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Inteligência Artificial<br class="hidden sm:block">
                e Ciência de Dados
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada ao uso de dados e inteligência artificial
                para análise, automação e tomada de decisões, preparando o estudante
                para atuar com tecnologias emergentes e soluções inovadoras.
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
                Formação orientada por dados
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Inteligência Artificial e Ciência de Dados
                integra fundamentos de programação, estatística e análise de dados
                para a construção de soluções baseadas em informação e automação.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação desenvolve raciocínio lógico, pensamento analítico e
                domínio de ferramentas tecnológicas utilizadas em projetos de
                inteligência artificial e ciência de dados.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shapes tecnológicos -->
    <div class="absolute -top-44 -right-44 w-[540px] h-[540px] rounded-full bg-sky-200/30"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-300/30"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Ciência de Dados
                </h3>
                <p class="mt-2 text-slate-600">
                    Análise e interpretação de dados para apoio à decisão.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Machine Learning
                </h3>
                <p class="mt-2 text-slate-600">
                    Desenvolvimento de modelos preditivos e inteligentes.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Automação Inteligente
                </h3>
                <p class="mt-2 text-slate-600">
                    Criação de sistemas automatizados baseados em dados.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Análise de Dados
                </h3>
                <p class="mt-2 text-slate-600">
                    Tratamento, visualização e interpretação de informações.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-950 text-slate-100 relative overflow-hidden">

    <!-- linhas tecnológicas -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="0" x2="100%" y2="100%" stroke="white" stroke-width="0.5"/>
        <line x1="100%" y1="0" x2="0" y2="100%" stroke="white" stroke-width="0.5"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico orientado por dados e inovação
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso estará apto a atuar de forma ética e responsável no
                desenvolvimento de soluções baseadas em dados e inteligência
                artificial, contribuindo para a inovação tecnológica e a
                transformação digital de organizações.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
