@include('layouts.header', ['title' => 'Login Gestor'])

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-700 via-red-600 to-red-500 px-4">
  <div class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8 animate-fade-in border-t-4 border-yellow-400">

    <!-- Logo / Título -->
    <div class="text-center mb-8">
      <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 mb-4 shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-700" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10 2a6 6 0 00-6 6v2a6 6 0 1012 0V8a6 6 0 00-6-6z" />
          <path d="M4 12a6 6 0 0012 0" />
        </svg>
      </div>
      <h1 class="text-2xl font-extrabold text-red-800 tracking-wide">Painel do Gestor</h1>
      <p class="text-red-600/80 text-sm">Acesse sua conta para gerenciar alunos e boletins</p>
    </div>

    <!-- Mensagens -->
    @if($errors->any())
      <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
        {{ $errors->first() }}
      </div>
    @endif
    @if(session('status'))
      <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg">
        {{ session('status') }}
      </div>
    @endif

    <!-- Formulário -->
    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
      @csrf

      <!-- Email -->
      <label class="block">
        <span class="text-sm font-medium text-red-800">E-mail</span>
        <div class="mt-1 flex items-center border border-red-200 rounded-lg bg-red-50/40 focus-within:ring-2 focus-within:ring-yellow-400">
          <span class="px-3 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l-4-4m4 4l-4 4" />
            </svg>
          </span>
          <input type="email" name="email" class="flex-1 py-2 px-2 bg-transparent outline-none text-red-900 placeholder-red-400" placeholder="seu@email.com" required>
        </div>
      </label>

      <!-- Senha -->
      <label class="block">
        <span class="text-sm font-medium text-red-800">Senha</span>
        <div class="mt-1 flex items-center border border-red-200 rounded-lg bg-red-50/40 focus-within:ring-2 focus-within:ring-yellow-400">
          <span class="px-3 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2v2h4v-2zM5 13h14v7H5v-7z" />
            </svg>
          </span>
          <input type="password" name="senha" class="flex-1 py-2 px-2 bg-transparent outline-none text-red-900 placeholder-red-400" placeholder="********" required>
        </div>
      </label>

      <!-- Botão -->
      <button class="w-full py-2.5 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition border border-yellow-500">
        Entrar
      </button>

    </form>

    <!-- Footer -->
    <div class="text-center mt-8 text-xs text-red-600">
      Desenvolvido por <span class="font-semibold text-red-800">Bruno</span> &amp;
      <span class="font-semibold text-red-800">Grêmio Areté - CEEP</span>
    </div>

  </div>
</section>

@include('layouts.footer')

<style>
  @keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-fade-in { animation: fade-in 0.6s ease-out; }
</style>
