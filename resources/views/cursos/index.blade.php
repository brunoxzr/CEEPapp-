@include('layouts.header', ['title' => 'Cursos Técnicos — CEEP Assaí'])

<section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900">
            Cursos Técnicos do CEEP Assaí
        </h1>
        <p class="mt-4 max-w-3xl text-slate-700 leading-relaxed">
            O CEEP Assaí oferece cursos técnicos integrados ao Ensino Médio.
            Os alunos concluem o ensino médio e a formação técnica ao mesmo tempo,
            preparando-se para o mercado de trabalho.
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
                    Curso de tecnologia da informação que prepara o aluno para
                    desenvolver sistemas, aplicativos e sites. Trabalha com
                    programação, banco de dados e desenvolvimento web.
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
                    Curso da área da saúde que forma profissionais para trabalhar
                    em hospitais, clínicas e unidades de saúde. O aluno aprende
                    técnicas de enfermagem e cuidados com pacientes.
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
                    Curso voltado para a indústria, ensinando manutenção de máquinas,
                    processos de fabricação e operação de equipamentos industriais.
                    Trabalha com usinagem, solda e automação.
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
                    Técnico em Eletroeletronica
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso que prepara profissionais para trabalhar com instalações
                    elétricas, sistemas de energia, automação e manutenção elétrica
                    em residências, indústrias e comércios.
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
                    Curso que prepara profissionais para trabalhar na construção
                    civil, desde o planejamento até a execução de obras. O aluno
                    aprende sobre projetos, materiais e técnicas construtivas.
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
                    Técnico em Agronegócio
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso que prepara profissionais para trabalhar na produção
                    agrícola e pecuária. O aluno aprende sobre cultivo, criação
                    de animais, manejo de solo e gestão rural.
                </p>
                <a href="/cursos/agronegocio"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
            <img src="/img/cursos/agropecuaria.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Área agrícola educacional">
        </article>
        <!-- ADMINISTRAÇÃO -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <img src="/img/cursos/administracao.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Sala de administração">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Administração
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso que prepara o aluno para atuar na gestão de empresas,
                    organizações públicas e privadas. Trabalha com administração,
                    finanças, recursos humanos, marketing e processos organizacionais.
                </p>
                <a href="/cursos/administracao"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
        </article>

        <!-- INTELIGÊNCIA ARTIFICIAL E DADOS -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Inteligência Artificial e Ciência de Dados
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso voltado para tecnologias emergentes, preparando o aluno
                    para trabalhar com análise de dados, inteligência artificial,
                    machine learning e automação de processos. Desenvolve raciocínio
                    lógico, programação e uso de dados para tomada de decisões.
                </p>
                <a href="/cursos/inteligencia-artificial-dados"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
            <img src="/img/cursos/inteligencia-artificial.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Laboratório de inteligência artificial">
        </article>

        <!-- SEGURANÇA DO TRABALHO -->
        <article class="grid md:grid-cols-2 gap-10 items-center">
            <img src="/img/cursos/seguranca-do-trabalho.jpg"
                 class="w-full h-72 object-cover rounded"
                 alt="Treinamento de segurança do trabalho">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">
                    Técnico em Segurança do Trabalho
                </h2>
                <p class="mt-4 text-slate-700 leading-relaxed">
                    Curso que forma profissionais responsáveis pela prevenção
                    de acidentes e promoção da saúde no ambiente de trabalho.
                    O aluno aprende normas de segurança, legislação, análise
                    de riscos e uso de equipamentos de proteção.
                </p>
                <a href="/cursos/seguranca-do-trabalho"
                   class="inline-block mt-6 text-red-700 font-semibold">
                    Conhecer o curso →
                </a>
            </div>
        </article>

    </div>
</section>
