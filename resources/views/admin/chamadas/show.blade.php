@include('layouts.admin_nav', ['title' => 'Detalhes da Chamada'])

<main class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <a href="{{ route('admin.chamadas.index') }}"
           class="inline-block mb-4 text-yellow-600 font-semibold hover:text-yellow-700 hover:underline">
            ← Voltar para chamadas
        </a>

        <h1 class="text-3xl font-black text-red-800 mb-2">
            Chamada da Turma {{ $chamada->turma }}
        </h1>

        <p class="text-slate-600">
            Veja quem esteve presente e ausente nesta chamada.
        </p>
    </div>

    <section class="grid md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 border-t-4 border-yellow-400">
            <p class="text-sm text-slate-500">Data</p>
            <h3 class="text-xl font-black text-red-800">
                {{ $chamada->data->format('d/m/Y') }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 border-t-4 border-yellow-400">
            <p class="text-sm text-slate-500">Aula</p>
            <h3 class="text-xl font-black text-red-800">
                {{ $chamada->aula ?? '-' }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 border-t-4 border-yellow-400">
            <p class="text-sm text-slate-500">Presidente</p>
            <h3 class="text-xl font-black text-red-800">
                {{ $chamada->presidente->nome ?? '-' }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 border-t-4 border-red-700">
            <p class="text-sm text-slate-500">Total</p>
            <h3 class="text-xl font-black text-red-800">
                {{ $presentes->count() + $ausentes->count() }} alunos
            </h3>
        </div>

    </section>

    @if($chamada->observacao)
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 border-l-4 border-yellow-400 mb-8">
            <h2 class="text-lg font-black text-red-800 mb-2">Observação</h2>
            <p class="text-slate-700">
                {{ $chamada->observacao }}
            </p>
        </div>
    @endif

    <section class="grid md:grid-cols-2 gap-8">

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-green-700">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-red-800">
                    Presentes
                </h2>

                <span class="px-3 py-1 rounded-full bg-green-50 text-green-800 text-sm font-bold border border-green-200">
                    {{ $presentes->count() }}
                </span>
            </div>

            <div class="overflow-hidden rounded-lg border border-slate-200">
                @forelse($presentes as $aluno)
                    <div class="py-3 px-4 border-b border-slate-100 last:border-b-0 hover:bg-green-50/40 transition">
                        <p class="font-semibold text-slate-800">
                            {{ $aluno->nome }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $aluno->email }}
                        </p>
                    </div>
                @empty
                    <div class="py-6 px-4 text-center text-slate-500">
                        Nenhum presente marcado.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-red-700">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-red-800">
                    Ausentes
                </h2>

                <span class="px-3 py-1 rounded-full bg-red-50 text-red-800 text-sm font-bold border border-red-200">
                    {{ $ausentes->count() }}
                </span>
            </div>

            <div class="overflow-hidden rounded-lg border border-slate-200">
                @forelse($ausentes as $aluno)
                    <div class="py-3 px-4 border-b border-slate-100 last:border-b-0 hover:bg-red-50/40 transition">
                        <p class="font-semibold text-slate-800">
                            {{ $aluno->nome }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $aluno->email }}
                        </p>
                    </div>
                @empty
                    <div class="py-6 px-4 text-center text-slate-500">
                        Nenhum ausente.
                    </div>
                @endforelse
            </div>
        </div>

    </section>

</main>

@include('layouts.footer')