@include('layouts.admin_nav', ['title' => 'Smart Agro 2026'])


<main class="max-w-7xl mx-auto px-6 mt-10 space-y-10">

<h1 class="text-3xl font-black text-red-800">
    Smart Agro 2026 — Inscrições
</h1>

@if(session('success'))
    <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border rounded-2xl shadow overflow-x-auto">

<table class="min-w-full text-sm">
    <thead class="bg-red-50 text-red-800">
        <tr>
            <th class="px-4 py-3 text-left">Aluno</th>
            <th class="px-4 py-3 text-left">Projeto</th>
            <th class="px-4 py-3 text-center">Ano</th>
            <th class="px-4 py-3 text-center">Status</th>
            <th class="px-4 py-3 text-center">Nota</th>
            <th class="px-4 py-3 text-center">Ações</th>
        </tr>
    </thead>

    <tbody class="divide-y">
        @foreach($inscricoes as $i)
        <tr class="hover:bg-slate-50">

            <td class="px-4 py-4">
                <strong>{{ $i->aluno_nome }}</strong><br>
                <span class="text-xs text-slate-500">
                    {{ $i->turma }} • {{ $i->professor_orientador }}
                </span>
            </td>

            <td class="px-4 py-4">
                {{ $i->titulo_projeto }}
            </td>

            <td class="px-4 py-4 text-center">
                {{ $i->ano }}
            </td>

            <td class="px-4 py-4 text-center">
                <span class="px-3 py-1 rounded-full text-xs font-bold
                    @if($i->status == 'selecionado') bg-green-100 text-green-700
                    @elseif($i->status == 'recusado') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ ucfirst($i->status) }}
                </span>
            </td>

            <td class="px-4 py-4 text-center font-bold">
                {{ $i->nota_total ?? '-' }}
            </td>

            <td class="px-4 py-4 text-center space-x-2">

                <a href="{{ route('admin.smartagro.show', $i->id) }}"
                   class="text-blue-600 font-bold text-xs">
                    Ver
                </a>

                <form method="POST"
                      action="{{ route('admin.smartagro.status', [$i->id, 'selecionado']) }}"
                      class="inline">
                    @csrf
                    <button class="text-green-600 font-bold text-xs">
                        Selecionar
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('admin.smartagro.status', [$i->id, 'recusado']) }}"
                      class="inline">
                    @csrf
                    <button class="text-red-600 font-bold text-xs">
                        Recusar
                    </button>
                </form>

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

</div>

</main>
