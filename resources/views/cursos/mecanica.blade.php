@include('layouts.header', ['title' => 'Técnico em Mecânica Industrial — CEEP Assaí'])

<!-- HERO INDUSTRIAL -->
<section class="relative h-[85vh] min-h-[520px] flex items-center bg-slate-900">

    <!-- imagem de fundo -->
    <div class="absolute inset-0">
        <img src="/img/cursos/mecanica-bg.jpg"
             alt="Ambiente industrial e mecânica"
             class="w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-slate-900/70"></div>
    </div>

    <!-- SVG blueprint -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="120" x2="2000" y2="120" stroke="white" stroke-width="1"/>
        <line x1="0" y1="260" x2="2000" y2="260" stroke="white" stroke-width="0.6"/>
        <line x1="300" y1="0" x2="300" y2="1200" stroke="white" stroke-width="0.6"/>
        <line x1="900" y1="0" x2="900" y2="1200" stroke="white" stroke-width="0.6"/>
    </svg>

    <!-- conteúdo -->
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-3xl">

            <span class="text-sm uppercase tracking-widest text-slate-300">
                Curso Técnico
            </span>

            <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Mecânica Industrial
            </h1>

            <p class="mt-8 text-lg text-slate-200 leading-relaxed">
                Formação técnica voltada à manutenção, montagem e operação de
                sistemas mecânicos industriais, preparando profissionais para
                atuar diretamente nos processos produtivos da indústria.
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
                Formação técnica voltada à indústria
            </h2>

            <p class="mt-6 text-slate-700 leading-relaxed">
                O curso de Mecânica Industrial forma profissionais capacitados
                para atuar na manutenção de máquinas e equipamentos, leitura
                e interpretação de desenhos técnicos e controle de processos
                mecânicos industriais.
            </p>
        </div>

        <div class="relative pl-10 border-l border-slate-300">
            <p class="text-slate-700 leading-relaxed">
                Durante a formação, o estudante desenvolve competências práticas
                em oficinas e laboratórios, aplicando conceitos de metrologia,
                processos de fabricação, manutenção preventiva e corretiva.
            </p>
        </div>

    </div>
</section>

<!-- ÁREAS DE ATUAÇÃO -->
<section class="bg-slate-50 relative overflow-hidden">

    <!-- shape estrutural -->
    <div class="absolute -bottom-40 -left-40 w-[520px] h-[520px] bg-slate-200/40"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <h2 class="text-2xl font-bold text-slate-900 mb-14">
            Áreas de atuação
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 text-sm">

            <div>
                <span class="text-slate-400">01</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Indústrias Metalúrgicas
                </h3>
                <p class="mt-2 text-slate-600">
                    Atuação em linhas de produção e manutenção.
                </p>
            </div>

            <div>
                <span class="text-slate-400">02</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Manutenção Industrial
                </h3>
                <p class="mt-2 text-slate-600">
                    Inspeção, ajustes e correções de máquinas.
                </p>
            </div>

            <div>
                <span class="text-slate-400">03</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Montagem de Equipamentos
                </h3>
                <p class="mt-2 text-slate-600">
                    Montagem e alinhamento de conjuntos mecânicos.
                </p>
            </div>

            <div>
                <span class="text-slate-400">04</span>
                <h3 class="mt-2 font-semibold text-slate-900">
                    Indústrias de Base
                </h3>
                <p class="mt-2 text-slate-600">
                    Apoio aos processos produtivos industriais.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- PERFIL DO EGRESSO -->
<section class="bg-slate-900 text-slate-200 relative overflow-hidden">

    <!-- linhas técnicas -->
    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <line x1="0" y1="0" x2="2000" y2="600" stroke="white" stroke-width="0.6"/>
        <line x1="2000" y1="0" x2="0" y2="600" stroke="white" stroke-width="0.6"/>
    </svg>

    <div class="relative max-w-6xl mx-auto px-6 py-24">

        <div class="max-w-3xl">
            <span class="text-sm uppercase tracking-widest text-slate-400">
                Perfil do egresso
            </span>

            <h2 class="mt-4 text-2xl font-bold text-white">
                Profissional técnico e preparado para a indústria
            </h2>

            <p class="mt-6 leading-relaxed text-slate-300">
                O egresso estará apto a atuar de forma responsável, técnica
                e segura em ambientes industriais, contribuindo para a
                eficiência, segurança e continuidade dos processos produtivos.
            </p>
        </div>

    </div>
</section>

@include('layouts.footer')
