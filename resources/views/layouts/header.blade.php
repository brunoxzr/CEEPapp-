<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CEEP Assaí — Portal Institucional' }}</title>

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
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

<header class="bg-white border-b border-slate-200 sticky top-0 z-50">

    <!-- FAIXA INSTITUCIONAL -->
    <div class="bg-red-800 text-white text-xs">
        <div class="max-w-7xl mx-auto px-6 py-2 flex justify-between">
            <span>Centro Estadual de Educação Profissional de Assaí</span>
            <span class="hidden sm:block">Governo do Estado do Paraná</span>
        </div>
    </div>

    <!-- BARRA PRINCIPAL -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">

            <!-- IDENTIDADE -->
            <a href="{{ url('/') }}" class="leading-tight">
                <div class="text-2xl font-extrabold text-red-800">
                    CEEP Assaí
                </div>
                <div class="text-xs text-slate-500 font-medium uppercase tracking-wide">
                    Portal Institucional
                </div>
            </a>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-10 text-sm font-semibold text-slate-700">

                <a href="{{ url('/noticias') }}" class="hover:text-red-800 transition">
                    Notícias
                </a>

                <a href="{{ url('/cursos') }}" class="hover:text-red-800 transition">
                    Cursos
                </a>

                <a href="{{ url('/institucional') }}" class="hover:text-red-800 transition">
                    Institucional
                </a>

                <a href="{{ url('/contato') }}" class="hover:text-red-800 transition">
                    Contato
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
                <a href="{{ url('/cursos') }}" class="hover:text-red-800">Cursos</a>
                <a href="{{ url('/institucional') }}" class="hover:text-red-800">Institucional</a>
                <a href="{{ url('/contato') }}" class="hover:text-red-800">Contato</a>

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
                        <a href="{{ route('aluno.login') }}"
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
