@include('layouts.header', ['title' => 'Redefinir Senha'])

<main class="min-h-screen flex items-center justify-center bg-slate-100 px-4">
    <form method="POST" action="{{ route('senha.redefinir.salvar') }}"
          class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <h1 class="text-2xl font-black text-red-800 text-center">
            Redefinir senha
        </h1>

        <div>
            <label class="block text-sm font-semibold mb-1">Nova senha</label>
            <input type="password" name="password"
                   autocomplete="new-password"
                   class="w-full rounded-xl border px-4 py-3">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Confirmar senha</label>
            <input type="password" name="password_confirmation"
                   autocomplete="new-password"
                   class="w-full rounded-xl border px-4 py-3">
        </div>

        <button class="w-full py-3 bg-red-700 text-white font-bold rounded-xl">
            Salvar nova senha
        </button>
    </form>
</main>

@include('layouts.footer')
