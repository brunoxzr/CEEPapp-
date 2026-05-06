@include('layouts.admin_nav', ['title' => 'Chamadas Recebidas'])

<main class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-black text-red-800 mb-2">
            Chamadas Recebidas
        </h1>
        <p class="text-slate-600">
            Acompanhe as chamadas feitas pelos presidentes de turma.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-yellow-400 mb-8">
        <form method="GET" class="flex flex-col sm:flex-row sm:items-end gap-4">
            <label class="flex-1">
                <span class="text-sm font-semibold text-red-800">Filtrar por turma</span>

                <select name="turma"
                        class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">Todas as turmas</option>

                    @foreach($turmas as $item)
                        <option value="{{ $item }}" @selected($turma === $item)>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </label>

            <button class="px-5 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition border border-yellow-500">
                Filtrar
            </button>

            @if($turma)
                <a href="{{ route('admin.chamadas.index') }}"
                   class="px-5 py-2 rounded-lg bg-red-800 text-white font-bold shadow hover:bg-red-700 transition">
                    Limpar
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 border-t-4 border-red-700">
        <h2 class="text-xl font-black text-red-800 mb-6">
            Lista de Chamadas
        </h2>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="min-w-full text-sm">
                <thead class="bg-red-50 text-red-800">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Data</th>
                        <th class="py-3 px-4 text-left font-semibold">Turma</th>
                        <th class="py-3 px-4 text-left font-semibold">Aula</th>
                        <th class="py-3 px-4 text-left font-semibold">Presidente</th>
                        <th class="py-3 px-4 text-center font-semibold">Presentes</th>
                        <th class="py-3 px-4 text-center font-semibold">Ausentes</th>
                        <th class="py-3 px-4 text-center font-semibold">Ações</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($chamadas as $chamada)
                        <tr class="hover:bg-red-50/40 transition">
                            <td class="py-3 px-4 font-medium text-slate-800">
                                {{ $chamada->data->format('d/m/Y') }}
                            </td>

                            <td class="py-3 px-4 text-slate-700">
                                {{ $chamada->turma }}
                            </td>

                            <td class="py-3 px-4 text-slate-700">
                                {{ $chamada->aula ?? '-' }}
                            </td>

                            <td class="py-3 px-4 text-slate-700">
                                {{ $chamada->presidente->nome ?? '-' }}
                            </td>

                            <td class="py-3 px-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-green-50 text-green-800 text-xs font-bold border border-green-200">
                                    {{ $chamada->presentes_count }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-red-50 text-red-800 text-xs font-bold border border-red-200">
                                    {{ $chamada->ausentes_count }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.chamadas.show', $chamada->id) }}"
                                   class="text-yellow-600 font-semibold hover:text-yellow-700 hover:underline">
                                    Ver detalhes
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 px-4 text-center text-slate-500">
                                Nenhuma chamada encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $chamadas->links() }}
        </div>
    </div>

</main>

@include('layouts.footer')