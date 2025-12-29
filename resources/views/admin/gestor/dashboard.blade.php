@include('layouts.admin_nav', ['title' => ($admin->role === 'diretor' ? 'Diretor — Painel Master' : 'Gestor — Dashboard')])
<div class="flex min-h-screen">
  @include('layouts.sidebar')
  <main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-6">

      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
        <div>
          <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">
            {{ $admin->role === 'diretor' ? 'Painel Master' : 'Painel do Gestor' }}
          </p>
          <h1 class="text-3xl font-black text-red-800 mt-2">
            {{ $admin->role === 'diretor' ? 'Diretor — Permissões e Controle' : 'Dashboard' }}
          </h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            @if($admin->role === 'diretor')
              Aqui você define exatamente o que cada gestor pode acessar. O Diretor sempre tem acesso total.
            @else
              Acesso controlado por permissões do Diretor.
            @endif
          </p>
        </div>

        <div class="bg-white border rounded-2xl px-5 py-4 shadow-sm">
          <p class="text-sm text-slate-500">Logado como</p>
          <p class="font-bold text-slate-900">{{ $admin->nome }}</p>
          <p class="text-xs text-slate-500">{{ $admin->email }}</p>
        </div>
      </div>

      <!-- Cards principais (limitados por permissão para gestor, tudo para diretor) -->
      <div class="grid md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Alunos</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totAlunos }}</p>
        </div>
        @if($admin->role === 'diretor' || adminPode('ver_relatorios'))
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Boletins</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totBoletins ?? '-' }}</p>
        </div>
        @endif
        @if($admin->role === 'diretor' || adminPode('gerenciar_cronograma'))
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Aulas hoje</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $hoje ?? '-' }}</p>
        </div>
        @endif
        @if($admin->role === 'diretor' || adminPode('publicar_noticias'))
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Notícias</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totNoticias }}</p>
        </div>
        @endif
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Atalhos -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900">Atalhos</h2>
          <p class="text-sm text-slate-600 mt-2">
            @if($admin->role === 'diretor')
              Acesso total a todos os módulos.
            @else
              Seu acesso depende das permissões liberadas.
            @endif
          </p>
          <div class="mt-6 grid sm:grid-cols-2 gap-4">
            @if($admin->role === 'diretor' || adminPode('publicar_noticias'))
            <a href="{{ route('admin.news.index') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Notícias</p>
              <p class="text-xs text-slate-500">Publicar / editar</p>
            </a>
            @endif
            @if($admin->role === 'diretor' || adminPode('gerenciar_usuarios'))
            <a href="{{ route('admin.usuarios') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Usuários</p>
              <p class="text-xs text-slate-500">Alunos e gestores</p>
            </a>
            @endif
            @if($admin->role === 'diretor' || adminPode('gerenciar_cronograma'))
            <a href="{{ route('admin.cronograma') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Cronograma</p>
              <p class="text-xs text-slate-500">Horários e aulas</p>
            </a>
            @endif
            @if($admin->role === 'diretor' || adminPode('ver_relatorios'))
            <a href="{{ route('admin.saeb') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">SAEB</p>
              <p class="text-xs text-slate-500">Resultados e relatórios</p>
            </a>
            @endif
            @if($admin->role === 'diretor' || adminPode('gerenciar_projetos'))
            <a href="{{ route('admin.projetos') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Projetos Técnicos</p>
              <p class="text-xs text-slate-500">Gerenciar projetos</p>
            </a>
            @endif
            @if($admin->role === 'diretor' || adminPode('gerenciar_professores'))
            <a href="{{ route('admin.professores') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Professores</p>
              <p class="text-xs text-slate-500">Gerenciar professores</p>
            </a>
            @endif
            @if($admin->role === 'diretor')
            <a href="{{ route('admin.diretor.dashboard') }}" class="p-4 border rounded-xl bg-red-900 text-white hover:bg-red-800 transition">
              <p class="font-bold">Permissões</p>
              <p class="text-xs">Controle de permissões</p>
            </a>
            @endif
          </div>
        </div>

        <!-- Últimas notícias -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900">Últimas notícias</h2>
          <p class="text-sm text-slate-600 mt-2">Visão rápida do portal.</p>
          <div class="mt-6 space-y-4">
            @forelse($ultimasNoticias as $n)
              <div class="flex items-start justify-between gap-4 border rounded-xl p-4 hover:bg-slate-50 transition">
                <div>
                  <p class="font-bold text-slate-900 leading-snug">{{ $n->title }}</p>
                  <p class="text-xs text-slate-500 mt-1">
                    {{ optional($n->published_at)->format('d/m/Y') }}
                  </p>
                </div>
                <span class="text-slate-400">›</span>
              </div>
            @empty
              <p class="text-sm text-slate-500">Sem notícias ainda.</p>
            @endforelse
          </div>
        </div>

    </div>

    </div>
  </main>
</div>

@include('layouts.footer')
