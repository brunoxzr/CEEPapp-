@include('layouts.header', ['title' => 'Técnico em Agropecuária — CEEP Assaí'])

<!-- HERO CAMPO -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/agropecuaria-bg.jpg"
             alt="Produção agropecuária e campo"
             class="w-full h-full object-cover opacity-90">
        <div class="absolute inset-0 bg-emerald-950/65"></div>
    </div>

    <!-- SVG orgânico (linhas de terreno) -->
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
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Agronegócio
            </h1>

            <p class="mt-8 text-lg text-emerald-100 leading-relaxed">
                Formação técnica voltada à produção agropecuária, manejo sustentável,
                gestão rural e aplicação de técnicas modernas no campo, integrando
                produtividade, tecnologia e responsabilidade ambiental.
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
                Formação técnica integrada ao campo
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso técnico em Agropecuária forma profissionais aptos a atuar
                na produção animal e vegetal, no manejo do solo, na gestão rural
                e na aplicação de tecnologias voltadas ao desenvolvimento sustentável
                do setor agropecuário.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                A formação alia conhecimentos teóricos e práticos, com atividades
                em áreas produtivas, laboratórios e projetos técnicos, preparando
                o estudante para os desafios do campo moderno.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shapes naturais -->
    <div class="absolute -top-44 -right-44 w-[540px] h-[540px] rounded-full bg-emerald-200/25"></div>
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-300/30"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Produção Vegetal
                </h3>
                <p class="mt-2 text-slate-600">
                    Cultivo, manejo e colheita de culturas agrícolas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Produção Animal
                </h3>
                <p class="mt-2 text-slate-600">
                    Manejo, nutrição e sanidade animal.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Gestão Rural
                </h3>
                <p class="mt-2 text-slate-600">
                    Planejamento e administração da propriedade.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Assistência Técnica
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio técnico a produtores e cooperativas.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-emerald-950 text-emerald-100 relative overflow-hidden">

    <!-- linhas orgânicas -->
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
                Profissional técnico para o campo e a produção sustentável
            </h2>

            <p class="mt-6 leading-relaxed text-emerald-200">
                O egresso estará apto a atuar de forma técnica, responsável
                e sustentável no setor agropecuário, contribuindo para o
                desenvolvimento produtivo, ambiental e econômico da região.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
