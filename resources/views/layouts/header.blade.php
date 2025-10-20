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
  </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
  <header class="bg-blue-700 text-white sticky top-0 z-50 shadow">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <!-- Logo / Nome fixo -->
        <a href="{{ session('admin_id') ? route('admin.dashboard') : (session('aluno_id') ? route('aluno.dashboard') : url('/')) }}"
           class="font-extrabold tracking-wide text-white text-lg hover:opacity-90">
          CEEPApp
        </a>

        <!-- Navegação -->
        <nav class="hidden md:flex items-center gap-6 text-sm">
          @if(session('aluno_id'))
            <a class="hover:underline" href="{{ route('aluno.dashboard') }}">Painel do Aluno</a>
            <a class="hover:underline" href="{{ route('aluno.boletim') }}">Boletim</a>
            <a class="hover:underline" href="{{ route('aluno.saeb') }}">SAEB</a>
            <li><a class="hover:underline" href="{{ route('aluno.cronograma') }}">Cronograma Semanal</a></li>
          @endif

          @if(session('admin_id'))
            <a class="hover:underline" href="{{ route('admin.dashboard') }}">Painel Gestor</a>
            <a class="hover:underline" href="{{ route('admin.cronograma') }}">Cronograma</a>
            <a class="hover:underline" href="{{ route('admin.boletins') }}">Boletins</a>
            <a class="hover:underline" href="{{ route('admin.saeb') }}">SAEB</a>
            <a class="hover:underline" href="{{ route('admin.usuarios') }}">Usuários</a>

          @endif

          @if(!session('aluno_id') && !session('admin_id'))
            <a class="hover:underline" href="{{ route('aluno.login') }}">Login Aluno</a>
            <a class="hover:underline" href="{{ route('admin.login') }}">Login Gestor</a>
          @endif
        </nav>

        <!-- Botões direita -->
        <div class="flex items-center gap-2">
          @if(session('aluno_id') || session('admin_id'))
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1.5 rounded bg-white/10 hover:bg-white/20 border border-white/20">
              Sair
            </button>
          </form>
          @endif
          <button id="themeToggle" class="ml-1 p-2 rounded hover:bg-white/10" aria-label="Tema">
            <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" viewBox="0 0 24 24" fill="currentColor"><path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41m13.72-13.72 1.41-1.41"/></svg>
            <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3A7 7 0 0 0 21 12.79Z"/></svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <main class="flex-1">
    @if(session('status'))
      <div class="max-w-3xl mx-auto mt-4 px-4">
        <div class="p-3 text-sm bg-green-50 border border-green-200 text-green-800 rounded">
          {{ session('status') }}
        </div>
      </div>
    @endif
    @if($errors->any())
      <div class="max-w-3xl mx-auto mt-4 px-4">
        <div class="p-3 text-sm bg-red-50 border border-red-200 text-red-800 rounded">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif
