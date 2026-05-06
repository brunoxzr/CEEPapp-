@php
    $navItems = [
        ['label' => 'Painel', 'route' => 'admin.dashboard', 'show' => true, 'icon' => 'M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z'],
        ['label' => 'Noticias', 'route' => 'admin.news.index', 'show' => adminPode('publicar_noticias'), 'icon' => 'M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v13A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-13Zm3 1.75h10M7 11h10M7 14.75h6'],
        ['label' => 'Usuarios', 'route' => 'admin.usuarios', 'show' => adminPode('gerenciar_usuarios'), 'icon' => 'M16 11a4 4 0 1 0-8 0 4 4 0 0 0 8 0Zm-12 9a8 8 0 0 1 16 0'],
        ['label' => 'Professores', 'route' => 'admin.professores', 'show' => adminPode('gerenciar_professores'), 'icon' => 'M12 14 4 10l8-4 8 4-8 4Zm-6 0v4c2 2 10 2 12 0v-4'],
        ['label' => 'Disciplinas', 'route' => 'admin.disciplinas.index', 'show' => adminPode('gerenciar_professores'), 'icon' => 'M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5v-17Zm0 0v14'],
        ['label' => 'Cronograma', 'route' => 'admin.cronograma.index', 'show' => adminPode('gerenciar_cronograma'), 'icon' => 'M7 3v3m10-3v3M4 9h16M6 5h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z'],
        ['label' => 'Comunicados', 'route' => 'admin.comunicados.index', 'show' => true, 'icon' => 'M4 5h16v10H7l-3 3V5Zm4 4h8m-8 3h5'],
        ['label' => 'Aprovados', 'route' => 'admin.aprovados.index', 'show' => true, 'icon' => 'M9 12l2 2 4-5M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Z'],
        ['label' => 'Smart Agro', 'route' => 'admin.smartagro.index', 'show' => true, 'icon' => 'M12 20V10m0 0c-4.5 0-7-2.5-7-6 4.5 0 7 2.5 7 6Zm0 0c4.5 0 7-2.5 7-6-4.5 0-7 2.5-7 6Z'],
        ['label' => 'Relatorios', 'route' => 'admin.boletins', 'show' => adminPode('ver_relatorios'), 'icon' => 'M5 19V5h14v14H5Zm4-3v-5m3 5V8m3 8v-3'],
        ['label' => 'Premios', 'route' => 'admin.premios.index', 'show' => adminPode('gerenciar_projetos'), 'icon' => 'M8 4h8v3a4 4 0 0 1-8 0V4Zm0 2H5a3 3 0 0 0 3 3m8-3h3a3 3 0 0 1-3 3m-4 2v5m-3 0h6'],
        ['label' => 'Institucional', 'route' => 'admin.institucional.index', 'show' => session('admin_role') === 'diretor' || adminPode('gerenciar_institucional'), 'icon' => 'M4 20h16M6 20V9l6-5 6 5v11M9 20v-6h6v6'],
        ['label' => 'Permissoes', 'route' => 'admin.permissoes.index', 'show' => session('admin_role') === 'diretor', 'icon' => 'M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4Zm-2 9 1.5 1.5L15 10'],
        ['label' => 'Calendario', 'route' => 'admin.calendario.index', 'show' => session('admin_role') === 'diretor', 'icon' => 'M7 3v3m10-3v3M4 9h16M6 5h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z'],
    ];
@endphp

<button
    id="openSidebar"
    class="md:hidden fixed top-4 left-4 z-50 inline-flex h-11 w-11 items-center justify-center rounded-lg bg-red-800 text-white shadow-lg"
    aria-label="Abrir menu administrativo">
    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
    </svg>
</button>

<div id="sidebarOverlay" class="fixed inset-0 bg-slate-950/50 z-40 hidden md:hidden"></div>

<aside
    id="sidebar"
    class="fixed md:static top-0 left-0 z-50 w-72 min-h-screen bg-slate-950 text-white
           transform -translate-x-full md:translate-x-0 transition-transform duration-300">

    <div class="flex min-h-screen flex-col">
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.28em] text-red-200">CEEP Assai</p>
                    <h2 class="mt-1 text-xl font-black">Gestao Academica</h2>
                </div>

                <button id="closeSidebar" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg hover:bg-white/10" aria-label="Fechar menu">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" d="M6 6l12 12M18 6 6 18"/>
                    </svg>
                </button>
            </div>
        </div>

        <nav class="flex-1 space-y-1 px-4 py-5 text-sm font-semibold">
            @foreach($navItems as $item)
                @if($item['show'])
                    @php $active = request()->routeIs($item['route']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition
                              {{ $active ? 'bg-red-700 text-white shadow-sm' : 'text-slate-200 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>

        <div class="border-t border-white/10 p-4 text-xs text-slate-400">
            Ambiente interno institucional
        </div>
    </div>
</aside>

<script>
    (() => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        function openSidebar() {
            sidebar?.classList.remove('-translate-x-full');
            overlay?.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar?.classList.add('-translate-x-full');
            overlay?.classList.add('hidden');
        }

        openBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    })();
</script>


