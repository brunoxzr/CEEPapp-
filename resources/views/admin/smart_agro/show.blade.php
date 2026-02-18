@include('layouts.admin_nav', ['title' => 'Detalhes — Smart Agro'])

<main class="max-w-5xl mx-auto px-6 mt-10 space-y-10">

<h1 class="text-3xl font-black text-red-800">
    {{ $inscricao->titulo_projeto }}
</h1>

<div class="bg-white border rounded-2xl shadow p-8 space-y-8">

    <!-- STATUS + NOTA -->
    <div class="flex justify-between items-center">
        <span class="px-4 py-2 rounded-full text-sm font-bold
            @if($inscricao->status == 'selecionado') bg-green-100 text-green-700
            @elseif($inscricao->status == 'recusado') bg-red-100 text-red-700
            @else bg-yellow-100 text-yellow-700 @endif">
            {{ ucfirst($inscricao->status) }}
        </span>

        <span class="text-lg font-black text-slate-700">
            Nota Total: {{ $inscricao->nota_total ?? '-' }}
        </span>
    </div>

    <!-- REPRESENTANTE -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Representante do Projeto
        </h2>

        <p><strong>{{ $inscricao->aluno_nome }}</strong></p>
        <p class="text-sm text-slate-500">
            {{ $inscricao->aluno_email }}
        </p>
        @if($inscricao->aluno_telefone)
    <p class="text-sm text-slate-600 mt-1">
        📞 {{ $inscricao->aluno_telefone }}
    </p>
@endif


        <p class="text-sm mt-2">
            Turma: <strong>{{ $inscricao->turma }}</strong> |
            Ano: <strong>{{ $inscricao->ano }}</strong>
        </p>

        <p class="text-sm mt-1">
            Professor Orientador:
            <strong>{{ $inscricao->professor_orientador }}</strong>
        </p>
    </div>

    <!-- INTEGRANTES -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Integrantes
        </h2>

        @if($inscricao->integrantes && count($inscricao->integrantes))
            <ul class="list-disc ml-6 space-y-1">
                @foreach($inscricao->integrantes as $int)
                    <li>{{ $int }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-slate-500">
                Nenhum integrante adicional.
            </p>
        @endif
    </div>

    <!-- PROBLEMA -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Problema Identificado
        </h2>
        <p class="whitespace-pre-line text-slate-700">
            {{ $inscricao->problema }}
        </p>
    </div>

    <!-- SOLUÇÃO -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Solução Proposta
        </h2>
        <p class="whitespace-pre-line text-slate-700">
            {{ $inscricao->solucao }}
        </p>
    </div>

    <!-- POTENCIAL -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Potencial de Startup
        </h2>
        <p class="whitespace-pre-line text-slate-700">
            {{ $inscricao->potencial_startup }}
        </p>
    </div>

    <!-- DIFERENCIAL -->
    <div>
        <h2 class="font-bold text-lg text-red-700 mb-2">
            Diferenciais
        </h2>
        <p class="whitespace-pre-line text-slate-700">
            {{ $inscricao->diferencial }}
        </p>
    </div>

</div>

<div class="flex justify-between">

    <a href="{{ route('admin.smartagro.index') }}"
       class="px-6 py-2 bg-slate-200 rounded-lg font-semibold">
       ← Voltar
    </a>

    <div class="space-x-3">

        <form method="POST"
              action="{{ route('admin.smartagro.status', [$inscricao->id, 'selecionado']) }}"
              class="inline">
            @csrf
            <button class="px-6 py-2 bg-green-600 text-white rounded-lg font-bold">
                Selecionar
            </button>
        </form>

        <form method="POST"
              action="{{ route('admin.smartagro.status', [$inscricao->id, 'recusado']) }}"
              class="inline">
            @csrf
            <button class="px-6 py-2 bg-red-600 text-white rounded-lg font-bold">
                Recusar
            </button>
        </form>

    </div>

</div>

</main>
