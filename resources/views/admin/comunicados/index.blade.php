@include('layouts.admin_nav', ['title' => 'Comunicados'])

<main class="max-w-6xl mx-auto px-6 mt-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-black text-red-800">📢 Comunicados</h1>

        <a href="{{ route('admin.comunicados.create') }}"
           class="px-5 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
            + Novo comunicado
        </a>
    </div>

    @if(session('ok'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
            {{ session('ok') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-red-50 text-red-800">
                <tr>
                    <th class="p-3 text-left">Título</th>
                    <th class="p-3 text-center">Público</th>
                    <th class="p-3 text-center">Turma</th>
                    <th class="p-3 text-center">Data</th>
                    <th class="p-3 text-center">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($comunicados as $c)
                    <tr class="border-t hover:bg-slate-50 transition">
                        <td class="p-3 font-semibold">
                            {{ $c->titulo }}
                        </td>

                        <td class="p-3 text-center">
                            {{ ucfirst($c->publico) }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $c->turma ?? '—' }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $c->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                <!-- EDITAR -->
                                <a href="{{ route('admin.comunicados.edit', $c->id) }}"
                                   class="px-3 py-1 rounded bg-yellow-400 text-red-900 font-bold hover:bg-yellow-300 text-xs">
                                    ✏️ Editar
                                </a>

                                <!-- APAGAR -->
                                <form method="POST"
                                      action="{{ route('admin.comunicados.destroy', $c->id) }}"
                                      onsubmit="return confirm('⚠️ Deseja realmente excluir este comunicado?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1 rounded bg-red-600 text-white font-bold hover:bg-red-700 text-xs">
                                        🗑️ Apagar
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-slate-500">
                            Nenhum comunicado publicado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
