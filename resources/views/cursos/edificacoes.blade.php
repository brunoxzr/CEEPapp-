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
                Formação técnica voltada ao planejamento, elaboração de projetos,
                execução e acompanhamento de obras, com base em normas técnicas,
                legislação vigente e uso de tecnologias profissionais.
            </p>

            <!-- dados rápidos -->
            <div class="mt-12 flex gap-10 text-sm text-slate-300">
                <div>
                    <span class="block">Duração</span>
                    <strong class="text-white">3 anos</strong>
                </div>
                <div>
                    <span class="block">Turno</span>
                    <strong class="text-white">Matutino / Noturno</strong>
                </div>
                <div>
                    <span class="block">Modalidade</span>
                    <strong class="text-white">Presencial</strong>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SOBRE O CURSO -->
<section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-20">

        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                Sobre o curso
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O Curso Técnico em Edificações forma profissionais com
                conhecimentos científicos e tecnológicos para atuar de forma
                consciente e responsável na sociedade e no mundo do trabalho.
                O estudante desenvolve competências para elaborar, interpretar
                e executar projetos de edificações conforme normas técnicas
                e legislação vigente.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação integra teoria e prática, preparando o aluno para
                atuar no planejamento, orçamento e acompanhamento de obras,
                além de prestar assistência técnica em projetos e serviços
                da construção civil.
            </p>
        </div>

    </div>
</section>

<!-- O QUE VOCÊ VAI APRENDER -->
<section class="bg-slate-50">
    <div class="max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            O que você vai aprender
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 text-sm text-slate-700">

            <ul class="space-y-3">
                <li>• Leitura e elaboração de projetos técnicos (AutoCAD, Revit e SketchUp)</li>
                <li>• Materiais de construção e controle de qualidade</li>
                <li>• Topografia e levantamento de terrenos</li>
            </ul>

            <ul class="space-y-3">
                <li>• Estruturas de concreto, metálicas e de madeira</li>
                <li>• Técnicas construtivas e execução de obras</li>
                <li>• Instalações elétricas, hidráulicas e combate a incêndio</li>
            </ul>

            <ul class="space-y-3">
                <li>• Orçamento, cronogramas e gestão de obras</li>
                <li>• Legislação, acessibilidade e normas ambientais</li>
            </ul>

        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-white relative overflow-hidden">

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-12 text-sm">

            <div>
                <h3 class="font-semibold text-slate-900">Escritórios de projetos</h3>
                <p class="mt-2 text-slate-600">Arquitetura, engenharia e planejamento.</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Construtoras e empreiteiras</h3>
                <p class="mt-2 text-slate-600">Execução e acompanhamento de obras.</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Obras públicas e privadas</h3>
                <p class="mt-2 text-slate-600">Residenciais, comerciais e institucionais.</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Fiscalização de obras</h3>
                <p class="mt-2 text-slate-600">Controle técnico e acompanhamento.</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Órgãos públicos</h3>
                <p class="mt-2 text-slate-600">Apoio técnico e planejamento urbano.</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900">Assistência técnica</h3>
                <p class="mt-2 text-slate-600">Materiais e equipamentos da construção civil.</p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-200 relative overflow-hidden">

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico completo para a construção civil
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O profissional formado em Técnico em Edificações pelo CEEP Assaí
                está preparado para atuar no planejamento, execução e acompanhamento
                de obras, com domínio de projetos técnicos, normas de segurança,
                responsabilidade social e gestão construtiva.
            </p>
        </div>

    </div>
</section>

<!-- DIFERENCIAIS -->
<section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-10">
            Diferenciais do curso no CEEP Assaí
        </h2>

        <ul class="grid sm:grid-cols-2 gap-6 text-slate-700 text-sm">
            <li>• Aulas práticas em laboratórios e ambientes técnicos</li>
            <li>• Uso de softwares profissionais de projetos</li>
            <li>• Integração entre teoria e prática desde os primeiros anos</li>
            <li>• Professores com experiência na área da construção civil</li>
            <li>• Formação alinhada às demandas do mercado regional</li>
        </ul>

    </div>
</section>

<!-- ORGANIZAÇÃO -->
<section class="bg-slate-50">
    <div class="max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-12">
            Organização do curso
        </h2>

        <div class="grid md:grid-cols-2 gap-16 text-sm text-slate-700">

            <div>
                <h3 class="font-semibold text-slate-900 mb-2">
                    📌 Integrado ao Ensino Médio
                </h3>
                <p>Turno: Matutino</p>
                <p>Duração: 3 anos</p>
            </div>

            <div>
                <h3 class="font-semibold text-slate-900 mb-2">
                    📌 Subsequente
                </h3>
                <p>Turno: Noturno</p>
                <p>Duração: 2 anos</p>
            </div>

        </div>

        <p class="mt-12 text-xs text-slate-500 max-w-3xl">
            Ao concluir o curso, o aluno está habilitado a projetar e executar
            obras de até 80 m², conforme legislação vigente.
        </p>

    </div>
</section>

@include('layouts.footer')
