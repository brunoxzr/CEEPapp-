@include('layouts.header', ['title' => '404 — Página não encontrada | CEEP Assaí'])

<main class="bg-white text-slate-800 min-h-[70vh] flex items-center justify-center">

    <section class="w-full max-w-2xl px-6 text-center">

        <!-- CÓDIGO -->
        <h1 class="text-7xl md:text-8xl font-black text-red-800 tracking-tight">
            404
        </h1>

        <!-- MENSAGEM -->
        <p class="mt-6 text-2xl font-bold text-slate-900">
            Essa página não existe
        </p>

        <p class="mt-3 text-slate-600 text-lg">
            O endereço que você tentou acessar não foi encontrado
            ou pode ter sido removido do portal.
        </p>

        <!-- AÇÃO -->
        <div class="mt-10 flex justify-center gap-4">
            <a href="{{ route('home') }}"
               class="px-7 py-3 bg-red-700 text-white font-bold rounded-xl
                      hover:bg-red-800 transition shadow">
                ← Voltar para a página principal
            </a>
        </div>

        <!-- ASSINATURA -->
        <p class="mt-10 text-sm text-slate-400">
            Centro Estadual de Educação Profissional — CEEP Assaí
        </p>

    </section>

</main>

@include('layouts.footer')
