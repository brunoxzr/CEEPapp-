<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'CEEP Assai - Gestao Institucional' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="color-scheme" content="light">

    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        *:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(185, 28, 28, .35) !important;
            border-radius: 6px;
        }

        ::selection {
            background: rgba(250, 204, 21, .35);
            color: #111827;
        }

        .ceep-nav-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            border-radius: .5rem;
            padding: .55rem .75rem;
            color: #475569;
            transition: background-color .2s ease, color .2s ease;
        }

        .ceep-nav-link:hover {
            background: #fef2f2;
            color: #991b1b;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="bg-red-800 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-2 text-xs font-semibold">
            <span>Centro Estadual de Educacao Profissional de Assai</span>
            <span class="hidden sm:inline-flex items-center gap-2 text-red-100">
                <span class="h-1.5 w-1.5 rounded-full bg-yellow-300"></span>
                Gestao institucional
            </span>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-20 items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-4">
                <img src="{{ asset('img/logo_ceep.jpeg') }}" alt="CEEP Assai" class="h-14 w-auto rounded-sm">
                <div class="min-w-0">
                    <div class="truncate text-xl font-black text-red-800">CEEP Assai</div>
                    <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Portal institucional</div>
                </div>
            </a>

            <nav class="hidden items-center gap-1 text-sm font-bold md:flex">
                <a href="{{ route('admin.dashboard') }}" class="ceep-nav-link">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z"/>
                    </svg>
                    Painel
                </a>
                <a href="{{ route('admin.presidentes.index') }}" class="ceep-nav-link">Presidentes</a>
                <a href="{{ route('admin.chamadas.index') }}" class="ceep-nav-link">Chamadas</a>

                <div class="ml-3 flex items-center gap-2 border-l border-slate-200 pl-4">
                    @if(session('admin_id'))
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-4 py-2 text-red-800 transition hover:bg-slate-200">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m8-4-4 4 4 4m4-11h3a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3"/>
                                </svg>
                                Sair
                            </button>
                        </form>
                    @elseif(session('aluno_id'))
                        <a href="{{ route('aluno.dashboard') }}" class="rounded-lg bg-red-700 px-4 py-2 text-white transition hover:bg-red-800">Area do aluno</a>
                    @else
                        <a href="{{ route('login.unificado') }}" class="rounded-lg border border-red-800 px-4 py-2 text-red-800 transition hover:bg-red-50">Area academica</a>
                    @endif
                </div>
            </nav>

            <button id="menuBtn" class="md:hidden inline-flex h-11 w-11 items-center justify-center rounded-lg border border-slate-200 text-red-800" aria-label="Abrir menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<div id="mobileMenu" class="fixed inset-0 z-[60] hidden bg-slate-950/50">
    <aside id="menuPanel" class="absolute left-0 top-0 h-full w-80 max-w-[85vw] -translate-x-full bg-white shadow-2xl transition-transform duration-300">
        <div class="border-b border-slate-200 p-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-red-700">CEEP Assai</p>
            <h2 class="mt-1 text-xl font-black text-slate-900">Gestao institucional</h2>
        </div>

        <nav class="flex flex-col gap-1 p-4 text-sm font-bold text-slate-700">
            <a class="rounded-lg px-4 py-3 hover:bg-red-50 hover:text-red-800" href="{{ route('admin.dashboard') }}">Painel</a>
            <a class="rounded-lg px-4 py-3 hover:bg-red-50 hover:text-red-800" href="{{ route('admin.presidentes.index') }}">Presidentes</a>
            <a class="rounded-lg px-4 py-3 hover:bg-red-50 hover:text-red-800" href="{{ route('admin.chamadas.index') }}">Chamadas</a>

            <div class="mt-4 border-t border-slate-200 pt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full rounded-lg bg-red-700 px-4 py-3 text-left text-white transition hover:bg-red-800">Sair</button>
                </form>
            </div>
        </nav>
    </aside>
</div>

<script>
    (() => {
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        const panel = document.getElementById('menuPanel');

        btn?.addEventListener('click', () => {
            menu?.classList.remove('hidden');
            requestAnimationFrame(() => panel?.classList.remove('-translate-x-full'));
        });

        menu?.addEventListener('click', (event) => {
            if (event.target === menu) {
                panel?.classList.add('-translate-x-full');
                setTimeout(() => menu?.classList.add('hidden'), 250);
            }
        });
    })();
</script>


