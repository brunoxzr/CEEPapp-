@include('layouts.admin_nav', ['title' => 'Novo Professor'])

<main class="bg-slate-50 py-10">
  <div class="max-w-xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-800 mb-6">
      Novo Professor
    </h1>

    <form method="POST" action="{{ route('admin.professores.store') }}"
          class="bg-white border rounded-2xl p-6 shadow">
      @csrf

      <div class="mb-4">
        <label class="text-sm font-bold">Nome</label>
        <input type="text" name="nome"
               class="mt-2 w-full border rounded-xl px-4 py-3"
               required>
      </div>

      <div class="mb-4">
        <label class="text-sm font-bold">Email</label>
        <input type="email" name="email"
               class="mt-2 w-full border rounded-xl px-4 py-3"
               required>
      </div>

      <div class="mb-6">
        <label class="text-sm font-bold">Senha</label>
        <input type="password" name="senha"
               class="mt-2 w-full border rounded-xl px-4 py-3"
               required>
      </div>

      <button class="w-full px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
        Criar Professor
      </button>
    </form>

  </div>
</main>
