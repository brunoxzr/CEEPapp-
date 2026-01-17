<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'CEEP Assaí — Área do Aluno' }}</title>

    <!-- Tailwind -->
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
            border-radius: 6px;
        }

        ::selection {
            background: rgba(185,28,28,.25);
            color: #111;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

<!-- ================= HEADER ALUNO ================= -->
<header class="bg-white border-b border-slate-200 sticky top-0 z-50">

    <!-- FAIXA -->
    <div class="bg-red-800 text-white text-xs">
        <div class="max-w-7xl mx-auto px-6 py-2 flex justify-between">
            <span>Centro Estadual de Educação Profissional de Assaí</span>
            <span class="hidden sm:block">Área do Aluno</span>
        </div>
    </div>

    <!-- NAVBAR -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            <!-- LOGO -->
            <a href="{{ route('aluno.dashboard') }}" class="flex items-center gap-4">
                <img src="{{ asset('img/logo_ceep.jpeg') }}"
                     alt="CEEP Assaí"
                     class="h-16 w-auto">

                <div class="leading-tight">
                    <div class="text-2xl font-extrabold text-red-800">
                        CEEP Assaí
                    </div>
                    <div class="text-xs text-slate-500 uppercase tracking-wide">
                        Área do Aluno
                    </div>
                </div>
            </a>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-700">

                <a href="{{ route('aluno.dashboard') }}" class="hover:text-red-800">
                    Painel
                </a>

                <a href="{{ route('aluno.boletim') }}" class="hover:text-red-800">
                    Boletim
                </a>

                <a href="{{ route('aluno.saeb') }}" class="hover:text-red-800">
                    SAEB
                </a>

                <a href="{{ route('aluno.cronograma') }}" class="hover:text-red-800">
                    Cronograma
                </a>
                                <a href="{{ route('aluno.calendario.index') }}" class="hover:text-red-800">
                    Calendario
                </a>
<a href="{{ route('aluno.perfil') }}" class="hover:text-red-800 transition">
    Perfil
</a>

                <form action="{{ route('logout') }}" method="POST" class="ml-4">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition">
                        Sair
                    </button>
                </form>
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

<!-- ================= MENU MOBILE ================= -->
<div id="mobileMenu"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[60] hidden">

    <aside id="menuPanel"
           class="absolute top-0 left-0 w-72 h-full bg-white shadow-xl
                  transform -translate-x-full transition-transform duration-300">

        <div class="p-6">
            <div class="mb-8">
                <h2 class="text-xl font-extrabold text-red-800">
                    Área do Aluno
                </h2>
                <p class="text-xs text-slate-500 uppercase tracking-wide">
                    CEEP Assaí
                </p>
            </div>

            <nav class="flex flex-col gap-4 text-sm font-semibold text-slate-700">
                <a href="{{ route('aluno.dashboard') }}">Painel</a>
                <a href="{{ route('aluno.boletim') }}">Boletim</a>
                <a href="{{ route('aluno.saeb') }}">SAEB</a>
                <a href="{{ route('aluno.cronograma') }}">Cronograma</a>
                                <a href="{{ route('aluno.calendario.index') }}">Calendario</a>
                                                                <a href="{{ route('aluno.perfil') }}">Perfil</a>

                <div class="border-t pt-4 mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition">
                            Sair
                        </button>
                    </form>
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
