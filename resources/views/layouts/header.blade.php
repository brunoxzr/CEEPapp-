<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CEEP Assaí — Portal Institucional' }}</title>
    {{-- ================= PRELOAD GLOBAL ================= --}}
<link rel="preload" as="image" href="/img/frenteCeep.jpg">
<link rel="stylesheet"
      href="https://web.celepar.pr.gov.br/drupal/instbar/css/inst-bar.min.css?ver=mar2024">

<link rel="stylesheet"
      href="https://web.celepar.pr.gov.br/drupal/css/gerais.css">

@stack('preload-images')

    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="color-scheme" content="light">

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont,
                         "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial, sans-serif;
        }

        *:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(185,28,28,.35) !important;
            border-radius: 4px;
        }

        ::selection {
            background: rgba(185,28,28,.25);
            color: #111;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }
#inst-bar .dropdown-menu {
  display: none;
}
#inst-bar .open > .dropdown-menu {
  display: block;
}

    </style>
    <script>
(function () {
  const toggles = document.querySelectorAll('#inst-bar .dropdown-toggle');

  toggles.forEach(toggle => {
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();

      const parent = this.closest('.btn-group');

      // fecha outros abertos
      document.querySelectorAll('#inst-bar .btn-group.open')
        .forEach(el => el !== parent && el.classList.remove('open'));

      // toggle no atual
      parent.classList.toggle('open');
    });
  });

  // fecha ao clicar fora (EXATAMENTE como no PR.GOV.BR)
  document.addEventListener('click', function () {
    document
      .querySelectorAll('#inst-bar .btn-group.open')
      .forEach(el => el.classList.remove('open'));
  });
})();
</script>

</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
<div id="inst-bar">
  <div class="full-container">

    <div class="pull-left">
      <a class="marca-gov-pr" href="https://www.parana.pr.gov.br">
        <img src="https://web.celepar.pr.gov.br/drupal/instbar/images/pr-gov-br-logo.png"
             alt="Governo do Paraná">
      </a>

      <a id="btn-acionar-redes" class="btn-redes-gov-mobile" href="#">
        <span>Redes Sociais do Governo do Paraná</span>
      </a>

      <ul id="div-header-social" class="header-social">
        <li><a href="https://www.instagram.com/governoparana/"
               class="sgov sgov-instagram" target="_blank">Instagram</a></li>

        <li><a href="https://twitter.com/governoparana"
               class="sgov sgov-twitter" target="_blank">Twitter</a></li>

        <li><a href="https://www.facebook.com/governoparana"
               class="sgov sgov-facebook" target="_blank">Facebook</a></li>

        <li><a href="https://www.youtube.com/user/paranagoverno"
               class="sgov sgov-youtube" target="_blank">Youtube</a></li>

        <li><a href="https://www.tiktok.com/@governoparana"
               class="sgov sgov-tiktok" target="_blank">Tiktok</a></li>

        <li><a href="https://www.linkedin.com/company/governoparana/"
               class="sgov sgov-linkedin" target="_blank">Linkedin</a></li>

        <li><a href="https://whatsapp.com/channel/0029Va86Qj5Jpe8kYSekbR3t"
               class="sgov sgov-whatsapp" target="_blank">Whatsapp</a></li>

        <li><a href="https://vimeo.com/governoparana"
               class="sgov sgov-vimeo" target="_blank">Vimeo</a></li>
      </ul>
    </div>

    <div class="pull-right itens-gov">
      <nav class="pull-left">
        <div class="btn-group">
          <button type="button" class="dropdown-toggle">
            GOVERNO DO PARANÁ <span class="caret"></span>
          </button>

          <ul class="dropdown-menu">
            <li><a href="https://www.parana.pr.gov.br/Pagina/Orgaos-e-Entidades">Estrutura</a></li>
            <li><a href="http://www.aen.pr.gov.br/">Agência de Notícias</a></li>
            <li><a href="https://www.pia.pr.gov.br/">PIÁ</a></li>
            <li><a href="http://www.transparencia.pr.gov.br/">Portal da Transparência</a></li>
          </ul>
        </div>
      </nav>
    </div>

  </div>
</div>

<header class="bg-white border-b border-slate-200 sticky top-0 z-50">



    <!-- BARRA PRINCIPAL -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

<a href="{{ url('/') }}" class="flex items-center gap-4">

    <!-- LOGO -->
    <img
        src="{{ asset('img/logo_ceep.jpeg') }}"
        alt="CEEP Assaí"
        class="h-20 w-auto object-contain"
    >

    <!-- TEXTO -->
    <div class="leading-tight">
        <div class="text-xs text-slate-500 font-medium uppercase tracking-wide">
            Portal Institucional
        </div>
    </div>

</a>


            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-10 text-sm font-semibold text-slate-700">

                <a href="{{ url('/noticias') }}" class="hover:text-red-800 transition">
                    Notícias
                </a>

                <a href="{{ url('/institucional') }}" class="hover:text-red-800 transition">
                    Institucional
                </a>
                <a href="{{ url('/projetos') }}" class="hover:text-red-800 transition">
                    Projetos
                </a>
                <a href="{{ url('/contato') }}" class="hover:text-red-800 transition">
                    Contato
                </a>
                                <a href="{{ url('/hub-rh') }}" class="hover:text-red-800 transition">
                    Hub de RH
                </a>

                <!-- ÁREA ACADÊMICA -->
                <div class="pl-6 border-l border-slate-200">
                    @if(session('aluno_id'))
                        <a href="{{ route('aluno.dashboard') }}"
                           class="px-4 py-2 bg-red-800 text-white text-sm rounded hover:bg-red-900 transition">
                            Área do Aluno
                        </a>
                    @elseif(session('admin_id'))
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 bg-red-800 text-white text-sm rounded hover:bg-red-900 transition">
                            Área do Gestor
                        </a>
                    @else
                        <a href="{{ route('login.unificado') }}"
                           class="px-4 py-2 border border-red-800 text-red-800 text-sm rounded hover:bg-red-50 transition">
                            Área Acadêmica
                        </a>
                    @endif
                </div>
            </nav>

            <!-- BOTÃO MOBILE -->
            <button id="menuBtn"
                    class="md:hidden p-2 rounded hover:bg-slate-100 transition"
                    aria-label="Abrir menu">
                <svg class="h-7 w-7 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

        </div>
    </div>
</header>

<!-- MENU MOBILE -->
<div id="mobileMenu"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] hidden">

    <aside id="menuPanel"
           class="absolute top-0 left-0 w-72 h-full bg-white shadow-xl
                  transform -translate-x-full transition-transform duration-300">

        <div class="p-6">
            <div class="mb-8">
                <h2 class="text-xl font-extrabold text-red-800">
                    CEEP Assaí
                </h2>
                <p class="text-xs text-slate-500 uppercase tracking-wide">
                    Portal Institucional
                </p>
            </div>

            <nav class="flex flex-col gap-4 text-sm font-semibold text-slate-700">
                <a href="{{ url('/noticias') }}" class="hover:text-red-800">Notícias</a>
                <a href="{{ url('/institucional') }}" class="hover:text-red-800">Institucional</a>
                <a href="{{ url(path: '/projetos') }}" class="hover:text-red-800">Projetos</a>
                <a href="{{ url('/contato') }}" class="hover:text-red-800">Contato</a>
                <a href="{{ url('/hub-rh') }}" class="hover:text-red-800">Hub de RH</a>

                <div class="border-t pt-4 mt-4">
                    @if(session('aluno_id'))
                        <a href="{{ route('aluno.dashboard') }}"
                           class="block text-red-800 font-bold">
                            Área do Aluno
                        </a>
                    @elseif(session('admin_id'))
                        <a href="{{ route('admin.dashboard') }}"
                           class="block text-red-800 font-bold">
                            Área do Gestor
                        </a>
                    @else
                        <a href="{{ route('login.unificado') }}"
                           class="block text-red-800 font-bold">
                            Área Acadêmica
                        </a>
                    @endif
                </div>
            </nav>
        </div>
    </aside>
</div>

<!-- SCRIPT MENU MOBILE -->
<script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    const panel = document.getElementById('menuPanel');

    btn.addEventListener('click', () => {
        menu.classList.remove('hidden');
        requestAnimationFrame(() => {
            panel.classList.remove('-translate-x-full');
        });
    });

    menu.addEventListener('click', (e) => {
        if (e.target === menu) {
            panel.classList.add('-translate-x-full');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 300);
        }
    });
</script>
<script src="https://web.celepar.pr.gov.br/drupal/instbar/js/inst-bar.js" defer></script>
