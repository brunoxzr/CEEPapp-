<footer class="mt-16 bg-gradient-to-b from-red-900 to-red-950 text-red-100">

    <!-- BLOCO SUPERIOR -->
    <div class="max-w-7xl mx-auto px-6 py-14 grid lg:grid-cols-5 gap-10">

        <!-- IDENTIDADE -->
        <div class="lg:col-span-2 flex flex-col gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-4">
                <img
                    src="{{ asset('img/logoceep.png') }}"
                    alt="CEEP Assaí"
                    class="h-16 w-auto object-contain bg-white rounded-md p-2 shadow"
                >
                <div class="leading-tight">
                    <div class="text-yellow-400 font-extrabold text-lg tracking-wide">
                        CEEP ASSAÍ
                    </div>
                    <div class="text-xs uppercase tracking-widest text-red-200">
                        Sistema Acadêmico Integrado
                    </div>
                </div>
            </a>

            <p class="text-sm leading-relaxed text-red-100/90">
                Plataforma oficial de gestão acadêmica do
                <strong>Centro Estadual de Educação Profissional de Assaí</strong>,
                desenvolvida para centralizar acesso, comunicação, cronogramas,
                boletins digitais e processos educacionais em um único ambiente seguro.
            </p>

            <div class="flex items-center gap-3 text-xs text-red-200">
                <span class="px-3 py-1 bg-red-800 rounded-full border border-red-700">
                    Login Unificado
                </span>
                <span class="px-3 py-1 bg-red-800 rounded-full border border-red-700">
                    Ambiente Institucional
                </span>
            </div>
        </div>

        <!-- PORTAL -->
        <div>
            <h3 class="font-bold text-yellow-400 mb-4 uppercase tracking-wide text-sm">
                Portal
            </h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-yellow-400 transition">Página Inicial</a></li>
                <li><a href="{{ url('/noticias') }}" class="hover:text-yellow-400 transition">Notícias</a></li>
                <li><a href="{{ url('/cursos') }}" class="hover:text-yellow-400 transition">Cursos</a></li>
                <li><a href="{{ url('/projetos') }}" class="hover:text-yellow-400 transition">Projetos</a></li>
                <li><a href="{{ url('/institucional') }}" class="hover:text-yellow-400 transition">Institucional</a></li>
            </ul>
        </div>

        <!-- ÁREA ACADÊMICA -->
        <div>
            <h3 class="font-bold text-yellow-400 mb-4 uppercase tracking-wide text-sm">
                Área Acadêmica
            </h3>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="{{ route('login.unificado') }}"
                       class="hover:text-yellow-400 transition font-semibold">
                        Acesso ao Sistema
                    </a>
                </li>
                <li>Cronograma Automático</li>
                <li>Boletim Digital</li>
                <li>Comunicados Oficiais</li>
                <li>Gestão Escolar Integrada</li>
            </ul>
        </div>

        <!-- SUPORTE / INSTITUCIONAL -->
        <div>
            <h3 class="font-bold text-yellow-400 mb-4 uppercase tracking-wide text-sm">
                Institucional
            </h3>
            <ul class="space-y-2 text-sm">
<li>
    <a href="https://www.parana.pr.gov.br" target="_blank" class="hover:text-yellow-300 transition">
        Governo do Estado do Paraná
    </a>
</li>

<li>
    <a href="https://www.educacao.pr.gov.br" target="_blank" class="hover:text-yellow-300 transition">
        Secretaria da Educação
    </a>
</li>

<li>
    <a href="{{ url('/') }}" class="hover:text-yellow-300 transition">
        Centro Estadual de Educação Profissional
    </a>
</li>

<li class="pt-2 text-red-200">
    Suporte Técnico:<br>
    <span class="font-medium">bruno.kay2304@gmail.com</span>
</li>

            </ul>
        </div>
    </div>

    <!-- DIVISÓRIA -->
    <div class="border-t border-red-800"></div>

    <!-- BASE INFERIOR -->
    <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between gap-4 text-xs text-red-200">

        <div>
            © {{ date('Y') }} CEEP Assaí — Sistema Acadêmico Institucional.<br>
            Todos os direitos reservados.
        </div>

<div class="flex flex-wrap gap-6 text-sm text-slate-400">
    <a href="{{ route('legal.privacidade') }}"
       class="hover:text-red-700 hover:underline transition">
        Política de Privacidade
    </a>

    <a href="{{ route('legal.termos') }}"
       class="hover:text-red-700 hover:underline transition">
        Termos de Uso
    </a>

    <a href="{{ route('legal.acessibilidade') }}"
       class="hover:text-red-700 hover:underline transition">
        Acessibilidade
    </a>
</div>

    </div>

</footer>
