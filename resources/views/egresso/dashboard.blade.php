@include('layouts.header', [
    'title' => 'Área do Egresso — CEEP Assaí'
])

<main class="max-w-4xl mx-auto px-6 py-20">

    <div class="bg-white border rounded-3xl shadow-xl p-10 text-center">

        <h1 class="text-3xl font-black text-red-800 mb-4">
            Área do Egresso
        </h1>

        <p class="text-slate-600 max-w-xl mx-auto mb-10">
            Este espaço é destinado aos ex-alunos do CEEP Assaí.
            No momento, apenas o perfil profissional está disponível.
        </p>

        <a href="{{ route('aluno.perfil') }}"
           class="inline-flex items-center gap-3 px-6 py-3
                  bg-red-700 text-white rounded-xl
                  hover:bg-red-800 transition font-semibold">
            Acessar Perfil Profissional
        </a>

    </div>

</main>
