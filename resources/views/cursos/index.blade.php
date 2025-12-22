@include('layouts.header', ['title' => 'Cursos Técnicos — CEEP Assaí'])

<section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">
            Cursos Técnicos do CEEP Assaí
        </h1>
        <p class="mt-4 max-w-3xl text-slate-700 leading-relaxed">
            O Centro Estadual de Educação Profissional de Assaí oferta cursos técnicos
            integrados ao Ensino Médio, voltados à formação profissional,
            científica e cidadã, conforme as diretrizes da educação pública estadual.
        </p>
    </div>
</section>

<section class="bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 py-20 space-y-20">

        <!-- DESENVOLVIMENTO -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <img src="/img/cursos/desenvolvimento.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Laboratório de informática">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Desenvolvimento de Sistemas
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Formação voltada à área de tecnologia da informação, preparando
                    o estudante para o desenvolvimento de sistemas computacionais
                    e soluções digitais.
                </p>
                <a href="/cursos/desenvolvimento-de-sistemas"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
        </article>

        <!-- ENFERMAGEM -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Enfermagem
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso da área da saúde que forma profissionais capacitados
                    para atuar na assistência e no cuidado ao paciente,
                    com ética e responsabilidade social.
                </p>
                <a href="/cursos/enfermagem"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
            <img src="/img/cursos/enfermagem.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Laboratório de enfermagem">
        </article>

        <!-- MECÂNICA -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <img src="/img/cursos/mecanica.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Oficina mecânica">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Mecânica Industrial
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Formação técnica voltada à indústria, com foco em
                    processos mecânicos, manutenção e operação de sistemas industriais.
                </p>
                <a href="/cursos/mecanica-industrial"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
        </article>

        <!-- ELETROTÉCNICA -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Eletrotécnica
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso voltado à formação de profissionais para atuar
                    em instalações elétricas, sistemas de energia e automação.
                </p>
                <a href="/cursos/eletrotecnica"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
            <img src="/img/cursos/eletrotecnica.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Laboratório de eletrotécnica">
        </article>

        <!-- EDIFICAÇÕES -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <img src="/img/cursos/edificacoes.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Canteiro de obras educacional">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Edificações
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Formação para atuação no planejamento, execução e
                    controle de obras civis, com base técnica e normativa.
                </p>
                <a href="/cursos/edificacoes"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
        </article>

        <!-- AGROPECUÁRIA -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Agropecuária
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso voltado à produção agrícola e pecuária,
                    com foco em práticas sustentáveis e desenvolvimento rural.
                </p>
                <a href="/cursos/agropecuaria"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
            <img src="/img/cursos/agropecuaria.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Área agrícola educacional">
        </article>

    </div>
</section>
