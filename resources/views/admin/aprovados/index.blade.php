@include('layouts.admin_nav', ['title' => 'Aprovados'])

<main class="max-w-7xl mx-auto px-6 mt-10 space-y-10">

    <!-- HEADER PREMIUM -->
    <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600
                text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">

        <div class="absolute inset-0 opacity-20
                    bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]">
        </div>

        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div>
                <h1 class="text-3xl md:text-4xl font-black">
                    Gestão de Aprovados
                </h1>

                <p class="mt-2 text-white/90 text-sm">
                    Controle institucional dos alunos aprovados em universidades e instituições.
                </p>
            </div>

            <a href="{{ route('admin.aprovados.create') }}"
               class="px-6 py-3 bg-yellow-400 text-red-900 font-black
                      rounded-xl hover:bg-yellow-300 transition shadow-lg">
                + Novo Aprovado
            </a>

        </div>
    </div>

    <!-- CARDS RESUMO -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Total cadastrados</p>
            <h2 class="text-3xl font-black text-red-700 mt-2">
                {{ $aprovados->total() ?? $aprovados->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Ativos no portal</p>
            <h2 class="text-3xl font-black text-green-600 mt-2">
                {{ \App\Models\Aprovado::where('ativo', true)->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Inativos</p>
            <h2 class="text-3xl font-black text-slate-600 mt-2">
                {{ \App\Models\Aprovado::where('ativo', false)->count() }}
            </h2>
        </div>

    </div>

    <!-- TABELA -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border">

        <div class="px-6 py-4 border-b bg-slate-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">
                Lista de Aprovados
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-slate-100 text-sm uppercase text-slate-600">
                    <tr>
                        <th class="p-4">Aluno</th>
                        <th class="p-4">Curso</th>
                        <th class="p-4">Aprovado em</th>
                        <th class="p-4">Ano</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody class="text-sm">

                    @forelse($aprovados as $item)

                        <tr class="border-t hover:bg-slate-50 transition">

                            <td class="p-4 font-semibold text-slate-800">
                                {{ $item->nome }}
                            </td>

                            <td class="p-4 text-slate-600">
                                {{ $item->curso }}
                            </td>

                            <td class="p-4 text-slate-600">
                                {{ $item->aprovado_em }}
                            </td>

                            <td class="p-4 text-slate-500">
                                {{ $item->ano ?? '-' }}
                            </td>

                            <!-- STATUS -->
                            <td class="p-4 text-center">
                                @if($item->ativo)
                                    <span class="px-3 py-1 text-xs font-bold
                                                 bg-green-100 text-green-700 rounded-full">
                                        Ativo
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold
                                                 bg-slate-200 text-slate-600 rounded-full">
                                        Inativo
                                    </span>
                                @endif
                            </td>

                            <!-- AÇÕES -->
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-4">

                                    <a href="{{ route('admin.aprovados.edit', $item->id) }}"
                                       class="text-blue-600 font-semibold hover:underline">
                                        Editar
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.aprovados.destroy', $item->id) }}"
                                          onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 font-semibold hover:underline">
                                            Excluir
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="p-10 text-center text-slate-500">
                                Nenhum aprovado cadastrado ainda.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINAÇÃO -->
    <div>
        {{ $aprovados->links() }}
    </div>

</main>
