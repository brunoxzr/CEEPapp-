@include('layouts.header', ['title' => 'Login Aluno'])

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-indigo-500 to-indigo-400 px-4">
  <div class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8 animate-fade-in">

    <!-- Logo / Título -->
    <div class="text-center mb-8">
      <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-indigo-100 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10 2a6 6 0 00-6 6v2a6 6 0 1012 0V8a6 6 0 00-6-6z" />
          <path d="M4 12a6 6 0 0012 0" />
        </svg>
      </div>
      <h1 class="text-2xl font-extrabold text-slate-800">Portal do Aluno</h1>
      <p class="text-slate-500 text-sm">Acompanhe suas notas, cronograma e SAEB</p>
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
    <form method="POST" action="{{ route('aluno.login.submit') }}" class="space-y-5">
      @csrf

      <label class="block">
        <span class="text-sm font-medium text-slate-700">E-mail</span>
        <div class="mt-1 flex items-center border rounded-lg bg-slate-50 focus-within:ring-2 focus-within:ring-indigo-500">
          <span class="px-3 text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l-4-4m4 4l-4 4" />
            </svg>
          </span>
          <input type="email" name="email" class="flex-1 py-2 px-2 bg-transparent outline-none text-slate-700" placeholder="seu@email.com" required>
        </div>
      </label>

      <label class="block">
        <span class="text-sm font-medium text-slate-700">Senha</span>
        <div class="mt-1 flex items-center border rounded-lg bg-slate-50 focus-within:ring-2 focus-within:ring-indigo-500">
          <span class="px-3 text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2v2h4v-2zM5 13h14v7H5v-7z" />
            </svg>
          </span>
          <input type="password" name="senha" class="flex-1 py-2 px-2 bg-transparent outline-none text-slate-700" placeholder="********" required>
        </div>
      </label>

      <button class="w-full py-2.5 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition">
        Entrar
      </button>
    </form>

    <!-- Footer -->
    <div class="text-center mt-8 text-xs text-slate-500">
      Desenvolvido por <span class="font-semibold text-indigo-600">Bruno</span> &amp; <span class="font-semibold text-indigo-600">Grêmio Areté - CEEP</span>
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
