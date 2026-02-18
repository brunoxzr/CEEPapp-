<!-- BOTÃO ABRIR SIDEBAR (MOBILE) -->
<button
    id="openSidebar"
    class="md:hidden fixed top-4 left-4 z-50 bg-red-800 text-white p-3 rounded-lg shadow-lg">
    ☰
</button>

<!-- OVERLAY -->
<div id="sidebarOverlay"
     class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

<!-- SIDEBAR -->
<aside
    id="sidebar"
    class="fixed md:static top-0 left-0 z-50
           w-64 min-h-screen
           bg-gradient-to-b from-red-800 to-red-600
           text-white p-6
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-2xl font-black">
            CEEP<span class="text-gray-200">Admin</span>
        </h2>

        <!-- FECHAR (MOBILE) -->
        <button id="closeSidebar" class="md:hidden text-white text-xl">
            ✕
        </button>
    </div>

    <!-- MENU -->
    <nav class="space-y-2 text-sm font-semibold">

        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Dashboard
        </a>

        @if(adminPode('publicar_noticias'))
        <a href="{{ route('admin.news.index') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Notícias
        </a>
        @endif

        @if(adminPode('gerenciar_usuarios'))
        <a href="{{ route('admin.usuarios') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Usuários
        </a>
        @endif

        <!-- 🔥 DISCIPLINAS / MATÉRIAS -->
        @if(adminPode('gerenciar_professores'))
        <a href="{{ route('admin.disciplinas.index') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Disciplinas
        </a>
        @endif

        <!-- PROFESSORES -->
        @if(adminPode('gerenciar_professores'))
        <a href="{{ route('admin.professores') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Professores
        </a>
        @endif

        @if(adminPode('gerenciar_cronograma'))
        <a href="{{ route('admin.cronograma.index') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Cronograma
        </a>
        @endif
        {{-- RESTRIÇÕES DE PROFESSORES (SÓ DIRETOR) --}}


                @if(adminPode('gerenciar_professores'))
        <a href="{{ route('admin.restricoes') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Restrições de Professores
        </a>
        @endif

<a href="{{ route('admin.comunicados.index') }}"
   class="block px-4 py-2 rounded hover:bg-red-700">
    Comunicados
</a>
<a href="{{ route('admin.aprovados.index') }}"
   class="block px-4 py-2 rounded hover:bg-red-700">
    Aprovados
</a>

<a href="{{ route('admin.smartagro.index') }}"
   class="block px-4 py-2 rounded hover:bg-red-700">
    Smart Agro 2026
</a>



        @if(adminPode('ver_relatorios'))
        <a href="{{ route('admin.boletins') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Relatórios
        </a>
        @endif

        @if(adminPode('gerenciar_projetos'))
        <a href="{{ route('admin.premios.create') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Prêmios
        </a>
        @endif



        <!-- SÓ DIRETOR -->
        @if(auth()->check() && auth()->user()?->role === 'diretor')
        <a href="{{ route('admin.permissoes.index') }}"
           class="block px-4 py-2 rounded bg-red-900 hover:bg-red-800 mt-4">
            Controle de Permissões
        </a>
        @endif
                <!-- SÓ DIRETOR -->
        @if(auth()->check() && auth()->user()?->role === 'diretor')
        <a href="{{ route('admin.calendario.index') }}"
           class="block px-4 py-2 rounded bg-red-900 hover:bg-red-800 mt-4">
            Calendario
        </a>
        @endif
        <!-- INSTITUCIONAL -->
        @if(
            session('admin_role') === 'diretor' ||
            adminPode('gerenciar_institucional')
        )
        <a href="{{ route('admin.institucional.index') }}"
           class="block px-4 py-2 rounded hover:bg-red-700">
            Institucional
        </a>
        @endif

        <!-- CONTROLE DE PERMISSÕES (SÓ DIRETOR) -->
        @if(session('admin_role') === 'diretor')
        <a href="{{ route('admin.permissoes.index') }}"
           class="block px-4 py-2 rounded bg-red-900 hover:bg-red-800 mt-4">
            Controle de Permissões
        </a>
        @endif

                <!-- CONTROLE DE PERMISSÕES (SÓ DIRETOR) -->
        @if(session('admin_role') === 'diretor')
        <a href="{{ route('admin.comunicados.index') }}"
           class="block px-4 py-2 rounded bg-red-900 hover:bg-red-800 mt-4">
            Comunicados
        </a>
        @endif

    </nav>
</aside>

<!-- SCRIPT MOBILE -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }

    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>
