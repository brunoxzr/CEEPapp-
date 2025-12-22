<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>{{ $title ?? 'CEEPApp — Sistema Acadêmico' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="color-scheme" content="light dark">
<style>
  /* utilidades extras */
  .tap { transform: scale(0.98); }
  .shadow-soft { box-shadow: 0 10px 30px rgba(2,6,23,.12); }
  .grid-auto { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }

  /* REMOVE O FUNDO PRETO DO FOCUS */
  *:focus {
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.5) !important; /* azul suave */
    border-radius: 4px;
  }

  /* REMOVE O FUNDO PRETO DO SELECTION */
  ::selection {
    background: rgba(59,130,246,0.3); /* azul tailwind */
    color: #fff;
  }
  ::-moz-selection {
    background: rgba(59,130,246,0.3);
    color: #fff;
  }

  /* REMOVE HIGHLIGHT PRETO EM LINKS CLICADOS NO MOBILE */
  a, button {
    -webkit-tap-highlight-color: transparent;
  }
</style>

</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
<header class="bg-red-700 text-white sticky top-0 z-50 shadow-lg border-b-4 border-yellow-400">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            <!-- LOGO / NOME -->
            <a href="{{ session('admin_id') ? route('admin.dashboard') : (session('aluno_id') ? route('aluno.dashboard') : url('/')) }}"
               class="font-black tracking-wide text-2xl hover:opacity-90 transition">
                CEEP<span class="text-yellow-300">App</span>
            </a>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
                @if(session('aluno_id'))
                    <a class="hover:text-yellow-300 transition" href="{{ route('aluno.dashboard') }}">Painel do Aluno</a>
                    <a class="hover:text-yellow-300 transition" href="{{ route('aluno.boletim') }}">Boletim</a>
                    <a class="hover:text-yellow-300 transition" href="{{ route('aluno.saeb') }}">SAEB</a>
                    <a class="hover:text-yellow-300 transition" href="{{ route('aluno.cronograma') }}">Cronograma</a>
                @endif

@if(session('admin_id'))
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.dashboard') }}">Painel Gestor</a>

    <a class="hover:text-yellow-300 transition" href="{{ route('admin.cronograma') }}">Cronograma</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.boletins') }}">Boletins</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.saeb') }}">SAEB</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.usuarios') }}">Usuários</a>

    <span class="opacity-50">|</span>

    <a class="hover:text-yellow-300 transition" href="{{ route('admin.news.index') }}">Notícias</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.news.create') }}">Nova Notícia</a>

    <a class="hover:text-yellow-300 transition" href="{{ route('home') }}">Portal</a>
@endif


                @if(!session('aluno_id') && !session('admin_id'))
                    <a class="hover:text-yellow-300 transition" href="{{ route('aluno.login') }}">Login Aluno</a>
                    <a class="hover:text-yellow-300 transition" href="{{ route('admin.login') }}">Login Gestor</a>
                @endif
            </nav>

            <!-- BOTÃO MOBILE -->
            <button id="menuBtn"
                    class="md:hidden p-2 rounded focus:outline-none hover:bg-red-800 transition">
                <svg id="iconMenu" class="h-7 w-7 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- AÇÕES DESKTOP -->
            <div class="hidden md:flex items-center gap-2 ml-3">
                @if(session('aluno_id') || session('admin_id'))
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-3 py-1.5 rounded bg-red-800 hover:bg-red-900 text-white border border-white/20 transition">
                            Sair
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- MENU MOBILE / OFFCANVAS -->
    <div id="mobileMenu"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden opacity-0 pointer-events-none transition">

        <div class="absolute top-0 left-0 w-72 h-full bg-red-700 text-white shadow-xl border-r-4 border-yellow-400 transform -translate-x-full transition-transform duration-300"
             id="menuPanel">

            <div class="p-4">
                <h2 class="text-xl font-black tracking-wide mb-4">
                    Menu <span class="text-yellow-300">CEEP</span>
                </h2>

                <nav class="flex flex-col gap-4 text-base font-semibold">

                    @if(session('aluno_id'))
                        <a class="hover:text-yellow-300 transition" href="{{ route('aluno.dashboard') }}">Painel do Aluno</a>
                        <a class="hover:text-yellow-300 transition" href="{{ route('aluno.boletim') }}">Boletim</a>
                        <a class="hover:text-yellow-300 transition" href="{{ route('aluno.saeb') }}">SAEB</a>
                        <a class="hover:text-yellow-300 transition" href="{{ route('aluno.cronograma') }}">Cronograma</a>
                    @endif
@if(session('admin_id'))
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.dashboard') }}">Painel Gestor</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.cronograma') }}">Cronograma</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.boletins') }}">Boletins</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.saeb') }}">SAEB</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.usuarios') }}">Usuários</a>

    <div class="border-t border-white/20 my-3"></div>

    <a class="hover:text-yellow-300 transition" href="{{ route('admin.news.index') }}">Gerenciar Notícias</a>
    <a class="hover:text-yellow-300 transition" href="{{ route('admin.news.create') }}">Criar Notícia</a>

    <a class="hover:text-yellow-300 transition" href="{{ route('home') }}">Portal Público</a>
@endif


                    @if(!session('aluno_id') && !session('admin_id'))
                        <a class="hover:text-yellow-300 transition" href="{{ route('aluno.login') }}">Login Aluno</a>
                        <a class="hover:text-yellow-300 transition" href="{{ route('admin.login') }}">Login Gestor</a>
                    @endif

                    @if(session('aluno_id') || session('admin_id'))
                        <form action="{{ route('logout') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit"
                                class="w-full bg-red-800 hover:bg-red-900 py-2 rounded transition border border-white/20">
                                Sair
                            </button>
                        </form>
                    @endif

                </nav>
            </div>
        </div>
    </div>
</header>

<!-- SCRIPT DO MENU MOBILE -->
<script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    const panel = document.getElementById('menuPanel');

    btn.addEventListener('click', () => {
        menu.classList.remove('hidden');
        setTimeout(() => {
            menu.classList.remove('opacity-0', 'pointer-events-none');
            panel.classList.remove('-translate-x-full');
        }, 10);
    });

    menu.addEventListener('click', (e) => {
        if (e.target === menu) {
            panel.classList.add('-translate-x-full');
            menu.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => menu.classList.add('hidden'), 300);
        }
    });
</script>
