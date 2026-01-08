@include('layouts.admin_nav', ['title' => 'Comunicados'])

<main class="max-w-6xl mx-auto px-6 mt-10">

    <!-- ================= HEADER ================= -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-black text-red-800">
            📢 Comunicados
        </h1>

        <a href="{{ route('admin.comunicados.create') }}"
           class="px-5 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
            + Novo comunicado
        </a>
    </div>

    <!-- ================= FEEDBACK ================= -->
    @if(session('ok'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
            {{ session('ok') }}
        </div>
    @endif

    <!-- ================= TABELA ================= -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-red-50 text-red-800">
                <tr>
                    <th class="p-3 text-left">Título</th>
                    <th class="p-3 text-center">Público</th>
                    <th class="p-3 text-center">Turma</th>
                    <th class="p-3 text-center">Leitura</th>
                    <th class="p-3 text-center">Data</th>
                    <th class="p-3 text-center">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($comunicados as $c)

                    @php
                        $stat = $stats[$c->id] ?? null;
                    @endphp

                    <tr class="border-t hover:bg-slate-50 transition">

                        <!-- TÍTULO -->
                        <td class="p-3 font-semibold">
                            {{ $c->titulo }}
                        </td>

                        <!-- PÚBLICO -->
                        <td class="p-3 text-center">
                            {{ ucfirst($c->publico) }}
                        </td>

                        <!-- TURMA -->
                        <td class="p-3 text-center">
                            {{ $c->turma ?? '—' }}
                        </td>

                        <!-- LEITURA -->
                        <td class="p-3 text-center">
                            @if($stat && $stat['total'] > 0)
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $stat['percentual'] >= 75
                                        ? 'bg-green-100 text-green-800'
                                        : ($stat['percentual'] >= 40
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ $stat['lidos'] }}/{{ $stat['total'] }}
                                    ({{ $stat['percentual'] }}%)
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>

                        <!-- DATA -->
                        <td class="p-3 text-center">
                            {{ $c->created_at->format('d/m/Y H:i') }}
                        </td>

                        <!-- AÇÕES -->
                        <td class="p-3">
                            <div class="flex justify-center gap-2 flex-wrap">

                                <!-- VER LEITURA -->
                                <a href="{{ route('admin.comunicados.turma', $c) }}"
                                   class="px-3 py-1 rounded bg-emerald-600 text-white font-bold hover:bg-emerald-700 text-xs">
                                    📊 Ver leitura
                                </a>

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
                        <td colspan="6" class="p-6 text-center text-slate-500">
                            Nenhum comunicado publicado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
