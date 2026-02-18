@include('layouts.header', ['title' => 'Redefinição de Senha'])

<main class="min-h-screen flex items-center justify-center bg-slate-100 px-6">
    <div class="bg-white rounded-3xl shadow-xl border p-12 max-w-lg text-center">

        <svg class="w-16 h-16 text-green-600 mx-auto mb-6"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8
                     M5 19h14a2 2 0 002-2V7
                     a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>

        <h1 class="text-3xl font-black text-slate-800 mb-4">
            Verifique seu e-mail
        </h1>

        <p class="text-slate-600 leading-relaxed">
            Enviamos um link de redefinição de senha para o seu e-mail cadastrado.
            <br><br>
            Abra sua caixa de entrada e siga as instruções para criar uma nova senha.
        </p>

        <p class="text-sm text-slate-500 mt-6">
            Não encontrou o e-mail? Verifique a caixa de spam.
        </p>

        <a href="{{ url('/') }}"
           class="inline-block mt-8 text-red-700 font-bold hover:underline">
            Voltar para o portal
        </a>
    </div>
</main>

@include('layouts.footer')
