@include('layouts.header', ['title' => 'CEEP Assaí — Portal Institucional'])
@push('preload-images')
    {{-- HERO --}}
    <link rel="preload" as="image" href="/img/frenteCeep.jpg">

    {{-- NOTÍCIA EM DESTAQUE --}}
    @if($featured && $featured->cover_path)
        <link rel="preload" as="image" href="{{ asset('storage/'.$featured->cover_path) }}">
    @endif
@endpush
<!-- =========================
     CEEPapp • COOKIE CONSENT (BLOCKING MODAL)
     Cole antes de </body>
========================== -->
<div id="ceep-cookie-overlay" class="fixed inset-0 z-[9999] hidden">
  <!-- backdrop -->
  <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>

  <!-- modal -->
  <div class="relative min-h-screen flex items-center justify-center px-6 py-10">
    <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl border border-red-700/20 overflow-hidden">

      <!-- header -->
      <div class="bg-gradient-to-r from-red-800 to-red-900 text-white px-8 py-7">
        <div class="flex items-center gap-4">
          <!-- SVG cookie (CC0 - SVGRepo) -->
          <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20">
            <img
              src="https://www.svgrepo.com/show/156649/cookies.svg"
              alt="Ícone de cookie"
              class="w-8 h-8"
              loading="lazy"
            />
          </div>

          <div class="flex-1">
            <h2 class="text-xl md:text-2xl font-black leading-tight">
              Cookies e Privacidade
            </h2>
            <p class="text-white/80 text-sm mt-1">
              Pra continuar no portal, você precisa aceitar os cookies essenciais.
            </p>
          </div>
        </div>
      </div>

      <!-- body -->
      <div class="px-8 py-8">
        <p class="text-slate-700 leading-relaxed">
          O CEEPapp utiliza <strong>cookies essenciais</strong> para:
        </p>

        <ul class="mt-4 space-y-2 text-slate-600">
          <li class="flex gap-2"><span class="mt-1">•</span><span>manter sua sessão e segurança;</span></li>
          <li class="flex gap-2"><span class="mt-1">•</span><span>garantir funcionamento correto do portal;</span></li>
          <li class="flex gap-2"><span class="mt-1">•</span><span>evitar falhas em login e navegação.</span></li>
        </ul>

        <div class="mt-6 rounded-2xl border bg-slate-50 p-5">
          <p class="text-sm text-slate-600 leading-relaxed">
            Ao clicar em <strong>Aceitar e continuar</strong>, você confirma que leu e concorda com nossa
            <a class="text-red-700 font-bold hover:underline" href="{{ route('legal.privacidade') }}">
              Política de Privacidade
            </a>
            e nossos
            <a class="text-red-700 font-bold hover:underline" href="{{ route('legal.termos') }}">
              Termos de Uso
            </a>.
          </p>
        </div>

        <!-- actions -->
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end">
          <a href="{{ route('legal.privacidade') }}"
             class="px-6 py-3 rounded-xl border font-bold text-slate-700 hover:bg-slate-50 transition text-center">
            Ler Política
          </a>

          <button id="ceep-cookie-accept"
                  class="px-6 py-3 rounded-xl bg-yellow-400 text-red-900 font-black hover:bg-yellow-300 transition shadow">
            Aceitar e continuar
          </button>
        </div>

        <p class="mt-6 text-xs text-slate-400">
          Este portal utiliza apenas cookies essenciais. (LGPD)
        </p>
      </div>

    </div>
  </div>
</div>

<script>
  (function () {
    const KEY = 'ceep_cookies_accepted_v1';
    const overlay = document.getElementById('ceep-cookie-overlay');
    const btn = document.getElementById('ceep-cookie-accept');

    function lockScroll(lock) {
      document.documentElement.style.overflow = lock ? 'hidden' : '';
      document.body.style.overflow = lock ? 'hidden' : '';
    }

    function show() {
      overlay.classList.remove('hidden');
      lockScroll(true);
    }

    function hide() {
      overlay.classList.add('hidden');
      lockScroll(false);
    }

    // Se já aceitou, não mostra
    if (!localStorage.getItem(KEY)) {
      show();
    }

    btn?.addEventListener('click', function () {
      localStorage.setItem(KEY, '1');
      hide();
    });

    // Segurança extra: impede fechar clicando fora
    overlay.addEventListener('click', function (e) {
      // não faz nada (bloqueia)
      // mantém o usuário dentro do modal até aceitar
    });
  })();
</script>

<main class="bg-white text-slate-800">

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-32 grid lg:grid-cols-2 gap-20 items-center text-white">

        <!-- TEXTO -->
        <div>
            <span class="inline-block mb-6 text-xs font-bold uppercase tracking-widest text-yellow-300">
                Centro Estadual de Educação Profissional
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                CEEP Assaí
            </h1>

            <p class="mt-6 text-lg text-red-100 max-w-xl">
                Educação técnica pública que prepara profissionais para o mercado de trabalho,
                com laboratórios modernos e projetos práticos em Assaí e região.
            </p>

            <div class="mt-10 flex flex-wrap gap-4">
                <a href="#cursos"
                   class="px-7 py-3 bg-yellow-400 text-red-900 font-bold rounded-md hover:bg-yellow-300 transition">
                    Cursos Ofertados
                </a>

                <a href="#institucional"
                   class="px-7 py-3 border border-white/40 font-semibold rounded-md hover:bg-white/10 transition">
                    Conheça o CEEP
                </a>
            </div>
        </div>

        <!-- IMAGEM HERO -->
        <div class="relative hidden lg:block">
            <div class="aspect-[16/9] overflow-hidden rounded-xl shadow-2xl border-4 border-white/20">
                <img src="/img/frenteCeep.jpg"
                     alt="CEEP Assaí"
                     class="w-full h-full object-cover">
            </div>
        </div>

    </div>
</section>

<!-- ================= NOTÍCIAS (G1 STYLE) ================= -->
<section id="noticias" class="py-28 bg-white border-t">
    <div class="max-w-7xl mx-auto px-6">

        <!-- TÍTULO -->
        <div class="flex justify-between items-end mb-14">
            <h2 class="text-3xl font-black text-slate-900">
                Notícias
            </h2>

            <a href="{{ route('portal.news.index') }}"
               class="text-sm font-bold text-red-700 hover:underline">
                Ver todas →
            </a>
        </div>

        @if($featured)
        <!-- GRID PRINCIPAL -->
        <div class="grid lg:grid-cols-3 gap-10">

            <!-- DESTAQUE -->
            <a href="{{ route('portal.news.show', $featured->slug) }}"
               class="lg:col-span-2 group">

                <div class="aspect-[16/9] overflow-hidden rounded-xl bg-slate-200">
                    <img
                        src="{{ asset('storage/'.$featured->cover_path) }}"
                        alt="{{ $featured->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="mt-6">
                    <p class="text-xs text-slate-500 mb-2">
                        {{ $featured->published_at?->format('d/m/Y') }}
                    </p>

                    <h3 class="text-2xl font-black leading-tight group-hover:text-red-700 transition">
                        {{ $featured->title }}
                    </h3>
                </div>
            </a>

            <!-- SECUNDÁRIAS -->
            <div class="grid gap-6">
                @foreach($secondary as $item)
                    <a href="{{ route('portal.news.show', $item->slug) }}"
                       class="flex gap-4 group">

                        <div class="w-32 aspect-[16/9] overflow-hidden rounded bg-slate-200 flex-shrink-0">
                            <img
                                src="{{ asset('storage/'.$item->cover_path) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-1">
                                {{ $item->published_at?->format('d/m/Y') }}
                            </p>

                            <h4 class="font-bold leading-snug group-hover:text-red-700 transition">
                                {{ $item->title }}
                            </h4>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
        @endif

        <!-- LISTA ABAIXO -->
        @if($list->count())
<div class="mt-20 border-t pt-14 grid md:grid-cols-2 gap-x-12 gap-y-10">
    @foreach($list as $item)
        <a href="{{ route('portal.news.show', $item->slug) }}"
           class="group flex gap-5 items-start">

            {{-- THUMB --}}
            <div class="w-28 aspect-[16/9] overflow-hidden rounded-lg bg-slate-200 flex-shrink-0">
                @if($item->cover_path)
                    <img
                        src="{{ asset('storage/'.$item->cover_path) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-red-800 to-red-900 flex items-center justify-center">
                        <span class="text-white text-xs font-bold tracking-widest uppercase">
                            CEEP
                        </span>
                    </div>
                @endif
            </div>

            {{-- TEXTO --}}
            <div class="flex-1">
                <p class="text-xs text-slate-500 mb-1">
                    {{ $item->published_at?->format('d/m/Y') }}
                </p>

                <h5 class="font-bold leading-snug text-slate-900 group-hover:text-red-700 transition line-clamp-2">
                    {{ $item->title }}
                </h5>
            </div>

        </a>
    @endforeach
</div>

        @endif

    </div>
</section>

@php
    $anoAprovados = now()->year - 1;
@endphp

<section class="py-20 bg-white border-t">
    <div class="max-w-6xl mx-auto px-6">

        <div class="bg-slate-50 border rounded-2xl p-10 md:p-14
                    flex flex-col md:flex-row items-center justify-between gap-10">

            <div class="max-w-xl">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900">
                    Aprovados {{ $anoAprovados }}
                </h2>

                <p class="mt-4 text-slate-600 leading-relaxed">
                    Conheça os alunos aprovados em universidades e programas de bolsa
                    no ano de {{ $anoAprovados }}.
                </p>
            </div>

            <div>
                <a href="{{ route('portal.aprovados.index') }}"
                   class="px-7 py-3 bg-red-700 text-white font-bold
                          rounded-md hover:bg-red-800 transition shadow">
                    Ver aprovados →
                </a>
            </div>

        </div>

    </div>
</section>



<!-- ================= CURSOS ================= -->
<section id="cursos" class="py-28 bg-slate-50 border-t">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-black text-slate-900 mb-16 text-center">
            Cursos Ofertados
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @php
                $cursos = [
                    ['nome' => 'Agronegócio', 'slug' => 'agronegocio'],
                    ['nome' => 'Administração', 'slug' => 'administracao'],
                    ['nome' => 'Desenvolvimento de Sistemas', 'slug' => 'desenvolvimento-de-sistemas'],
                    ['nome' => 'Inteligência Artificial e Ciência de Dados', 'slug' => 'inteligencia-artificial-dados'],
                    ['nome' => 'Edificações', 'slug' => 'edificacoes'],
                    ['nome' => 'Eletroeletronica', 'slug' => 'eletrotecnica'],
                    ['nome' => 'Enfermagem', 'slug' => 'enfermagem'],
                    ['nome' => 'Mecânica Industrial', 'slug' => 'mecanica-industrial'],
                    ['nome' => 'Segurança do Trabalho', 'slug' => 'seguranca-do-trabalho'],
                ];
            @endphp

            @foreach($cursos as $curso)
                <a href="{{ url('/cursos/'.$curso['slug']) }}"
                   class="group bg-white border rounded-xl p-8
                          hover:shadow-xl hover:-translate-y-1 transition-all">

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-red-700">
                        {{ $curso['nome'] }}
                    </h3>

                    <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                        Curso técnico integrado ao Ensino Médio, com aulas
                        teóricas e práticas em ambientes pedagógicos especializados.
                    </p>

                    <span class="inline-block mt-6 text-sm font-semibold text-red-700">
                        Ver curso →
                    </span>
                </a>
            @endforeach

        </div>
    </div>
</section>

<!-- ================= INSTITUCIONAL ================= -->
<section id="institucional" class="py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-24 items-start">

        <div>
            <h2 class="text-3xl font-black text-red-800 mb-8">
                Institucional
            </h2>

            <p class="text-slate-700 text-lg leading-relaxed mb-5">
                Inaugurado em 27 de junho de 2014, o Centro Estadual de Educação
                Profissional Professora Maria Lydia Cescatto Bomtempo oferece
                cursos técnicos integrados e subsequentes para estudantes de Assaí
                e região.
            </p>

            <p class="text-slate-600 leading-relaxed">
                Faz parte da rede estadual de ensino do Paraná e trabalha com
                projetos práticos, estágios e parcerias com empresas locais para
                melhorar a formação dos alunos.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="border-l-4 border-red-700 pl-5">
                <strong>Ano de Inauguração</strong>
                <span class="block text-slate-600">2014</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Investimento</strong>
                <span class="block text-slate-600">R$ 8,46 milhões</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Estrutura</strong>
                <span class="block text-slate-600">12 salas • 9 laboratórios</span>
            </div>

            <div class="border-l-4 border-red-700 pl-5">
                <strong>Modalidades</strong>
                <span class="block text-slate-600">Integrado e Subsequente</span>
            </div>
        </div>

    </div>
</section>
<!-- ================= DIREÇÃO ================= -->
@if($direcao->count())
<section class="py-28 bg-slate-50 border-t">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-black text-red-800 mb-14">
            Direção
        </h2>

        <div class="flex flex-wrap justify-center gap-12">

            @foreach($direcao as $pessoa)
                <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
                   class="group w-72 bg-white rounded-2xl shadow hover:shadow-xl transition p-8">

                    <!-- FOTO -->
                    @if($pessoa->foto)
                        <img src="{{ asset('storage/'.$pessoa->foto) }}"
                             class="w-36 h-36 mx-auto rounded-full object-cover border-4 border-red-700/30">
                    @else
                        <div class="w-36 h-36 mx-auto rounded-full bg-slate-200"></div>
                    @endif

                    <!-- TEXTO -->
                    <h3 class="mt-6 font-bold text-lg group-hover:text-red-700 transition">
                        {{ $pessoa->nome }}
                    </h3>

                    <p class="text-sm text-red-700 font-semibold mt-1">
                        {{ $pessoa->cargo }}
                    </p>
                </a>
            @endforeach

        </div>

    </div>
</section>
@endif

<!-- ================= DESENVOLVEDORES (DESTAQUE ESPECIAL) ================= -->
@if($desenvolvedores->count())
<section class="py-28 bg-white border-t">
    <div class="max-w-6xl mx-auto px-6">

    <h3 class="text-center text-xl font-black text-slate-900 mb-6">
        Desenvolvimento de Sistemas
    </h3>

    <p class="text-center text-slate-600 max-w-xl mx-auto mb-16">
        Alunos do curso de Desenvolvimento de Sistemas que trabalham
        nos sistemas e portais do CEEP.
    </p>

    @if($desenvolvedores->count() === 1)
        @php $pessoa = $desenvolvedores->first(); @endphp

        <!-- CARD CENTRAL (SÓ UM DEV) -->
        <div class="flex justify-center">
            <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
               class="group w-[420px] bg-white rounded-3xl shadow-xl
                      hover:shadow-2xl transition p-10 text-center
                      border border-red-700/20 relative">

                <!-- BADGE -->
                <span class="absolute -top-4 left-1/2 -translate-x-1/2
                             bg-red-700 text-white text-xs font-bold
                             px-4 py-1 rounded-full tracking-wide">
                    Desenvolvedor
                </span>

                <!-- FOTO -->
                @if($pessoa->foto)
                    <img src="{{ asset('storage/'.$pessoa->foto) }}"
                         alt="{{ $pessoa->nome }}"
                         class="w-40 h-40 mx-auto rounded-full object-cover
                                border-4 border-red-700/40">
                @else
                    <div class="w-40 h-40 mx-auto rounded-full bg-slate-200"></div>
                @endif

                <!-- NOME -->
                <h4 class="mt-8 font-black text-2xl text-slate-900
                           group-hover:text-red-700 transition">
                    {{ $pessoa->nome }}
                </h4>

                <!-- CARGO -->
                <p class="mt-2 text-red-700 font-semibold">
                    {{ $pessoa->cargo }}
                </p>

                <!-- COMPLEMENTO ACADÊMICO -->
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Aluno do curso técnico em <strong>Desenvolvimento de Sistemas</strong>,
                    participa do desenvolvimento dos sistemas e portais do CEEP Assaí.
                </p>

            </a>
        </div>

    @else
        <!-- GRID NORMAL (CASO TENHA MAIS DE UM DEV) -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-14">

            @foreach($desenvolvedores as $pessoa)
                <a href="{{ route('portal.institucional.show', $pessoa->slug) }}"
                   class="group text-center">

                    @if($pessoa->foto)
                        <img src="{{ asset('storage/'.$pessoa->foto) }}"
                             alt="{{ $pessoa->nome }}"
                             class="w-28 h-28 mx-auto rounded-full object-cover
                                    border-2 border-red-700/30
                                    group-hover:scale-110 transition">
                    @else
                        <div class="w-28 h-28 mx-auto rounded-full bg-slate-200"></div>
                    @endif

                    <h4 class="mt-5 font-semibold text-slate-900 group-hover:text-red-700 transition">
                        {{ $pessoa->nome }}
                    </h4>

                    <p class="text-xs text-slate-500 mt-1">
                        {{ $pessoa->cargo }}
                    </p>
                </a>
            @endforeach

        </div>
    @endif

    </div>
</section>
@endif

  <!-- HERO -->
  <section class="relative overflow-hidden bg-gradient-to-br from-red-800 via-red-700 to-red-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">

      <div>
        <p class="uppercase tracking-[0.3em] text-xs font-bold text-yellow-300 mb-4">
          Fale com o CEEP
        </p>

        <h1 class="text-4xl md:text-5xl font-black leading-tight mb-6">
          Estamos aqui pra te<br>
          <span class="text-yellow-300">atender de verdade</span>
        </h1>

        <p class="text-white/90 text-lg leading-relaxed max-w-xl">
          Dúvidas sobre cursos, matrícula, documentos ou projetos?
          A secretaria do CEEP Assaí está pronta para te orientar.
          Atendimento humano, direto e sem enrolação.
        </p>

        <div class="mt-8 flex flex-wrap gap-4">
          <a href="#localizacao"
             class="px-6 py-3 rounded-xl bg-yellow-400 text-red-900 font-black hover:bg-yellow-300 transition shadow-lg">
            📍 Onde estamos
          </a>

          <a href="tel:+554332622063"
             class="px-6 py-3 rounded-xl bg-white/10 border border-white/30 font-semibold hover:bg-white/20 transition">
            📞 Ligar para a secretaria
          </a>
        </div>
      </div>

      <!-- BLOCO VISUAL -->
      <div class="hidden md:block">
        <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
          <p class="text-lg font-black text-yellow-300 mb-4">
            Atendimento Presencial
          </p>

          <ul class="space-y-3 text-white/90 text-sm">
            <li>✔ Matrículas e transferências</li>
            <li>✔ Informações sobre cursos técnicos</li>
            <li>✔ Documentação escolar</li>
            <li>✔ Projetos, estágios e atividades</li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <!-- CONTATO DIRETO -->
  <section class="py-24 bg-white border-t">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-start">

      <!-- INFO -->
      <div>
        <h2 class="text-3xl font-black text-red-800 mb-6">
          📌 Secretaria do CEEP Assaí
        </h2>

        <p class="text-slate-700 text-lg leading-relaxed mb-8">
          Se preferir, venha até nós ou entre em contato por telefone.
          Nossa equipe está pronta para ajudar.
        </p>

        <div class="space-y-5 text-slate-800">

          <div class="flex items-start gap-4">
            <span class="text-2xl">📍</span>
            <div>
              <p class="font-bold">Endereço</p>
              <p class="text-slate-600">
                Rua Edgar Bardal, s/n<br>
                Assaí – PR • CEP 86220-000
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="text-2xl">📞</span>
            <div>
              <p class="font-bold">Telefone da Secretaria</p>
              <p class="text-slate-600">(43) 3262-2063</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="text-2xl">🕘</span>
            <div>
              <p class="font-bold">Horário de Atendimento</p>
              <p class="text-slate-600">
                Segunda a sexta-feira<br>
                Horário comercial
              </p>
            </div>
          </div>

        </div>
      </div>

      <!-- MAPA -->
      <div id="localizacao" class="w-full h-[420px] rounded-3xl overflow-hidden border shadow-lg">
        <iframe
          class="w-full h-full"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://www.google.com/maps?q=Centro+Estadual+de+Educação+Profissional+Assaí&output=embed">
        </iframe>
      </div>

    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="py-20 bg-slate-100 border-t">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h3 class="text-2xl md:text-3xl font-black text-red-800 mb-4">
        O CEEP Assaí está de portas abertas
      </h3>
      <p class="text-slate-600 text-lg mb-8">
        Educação técnica, projetos reais e pessoas que fazem acontecer.
      </p>

      <a href="{{ route('home') }}"
         class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-red-700 text-white font-bold hover:bg-red-800 transition shadow">
        ← Voltar ao portal
      </a>
    </div>
  </section>
</main>

@include('layouts.footer')
