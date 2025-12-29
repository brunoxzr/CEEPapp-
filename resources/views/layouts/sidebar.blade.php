<aside class="w-64 bg-gradient-to-b from-red-800 to-red-600 text-white min-h-screen p-6">
    <h2 class="text-2xl font-black mb-10 text-white">
        CEEP<span class="text-gray-200">Admin</span>
    </h2>

    <nav class="space-y-4">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Dashboard
        </a>

        @if(adminPode('publicar_noticias'))
        <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Notícias
        </a>
        @endif

        @if(adminPode('gerenciar_usuarios'))
        <a href="{{ route('admin.usuarios') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Usuários
        </a>
        @endif

        @if(adminPode('gerenciar_cronograma'))
        <a href="{{ route('admin.cronograma') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Cronograma
        </a>
        @endif

        @if(adminPode('ver_relatorios'))
        <a href="{{ route('admin.boletins') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Relatórios
        </a>
        @endif

        @if(adminPode('gerenciar_projetos'))
        <a href="{{ route('admin.projetos') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Projetos Técnicos
        </a>
        @endif

        @if(adminPode('gerenciar_professores'))
        <a href="{{ route('admin.professores') }}" class="block px-4 py-2 rounded hover:bg-red-700">
            Professores
        </a>
        @endif

        @if(session('admin_role') === 'diretor')
        <a href="{{ route('admin.permissoes.index') }}" class="block px-4 py-2 rounded bg-red-900 hover:bg-red-800">
            Controle de Permissões
        </a>
        @endif
    </nav>
</aside>

