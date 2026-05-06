@include('layouts.admin_nav', ['title' => 'Presidentes de Turma'])

<main class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-black text-red-800 mb-2">
            Presidentes de Turma
        </h1>
        <p class="text-slate-600">
            Defina até 3 representantes por turma para registrar chamadas.
        </p>
    </div>

    @if(session('ok'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
            {{ session('ok') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-red-800 space-y-1">
                @foreach($errors->all() as $e)
                    <li class="text-sm">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FILTRO E CADASTRO -->
    <section class="bg-white rounded-2xl shadow border border-slate-200 p-6 mb-8 border-t-4 border-red-700">

        <h2 class="text-xl font-black text-red-800 mb-5">
            Adicionar presidente
        </h2>

        <form method="GET" action="{{ route('admin.presidentes.index') }}" class="grid md:grid-cols-3 gap-4 mb-6">
            <label class="block">
                <span class="text-sm font-semibold text-red-800">Filtrar turma/curso</span>

                <select name="turma"
                        onchange="this.form.submit()"
                        class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">Todas as turmas</option>

                    @foreach($turmas as $turma)
                        <option value="{{ $turma }}" @selected($turmaSelecionada === $turma)>
                            {{ $turma }}
                        </option>
                    @endforeach
                </select>
            </label>

            <div class="md:col-span-2 flex items-end">
                @if($turmaSelecionada)
                    <a href="{{ route('admin.presidentes.index') }}"
                       class="px-4 py-2 rounded-lg bg-slate-200 text-red-800 font-bold hover:bg-slate-300 transition">
                        Limpar filtro
                    </a>
                @endif
            </div>
        </form>

        <form action="{{ route('admin.presidentes.store') }}" method="POST" class="grid md:grid-cols-3 gap-4">
            @csrf

            <label class="md:col-span-2 block">
                <span class="text-sm font-semibold text-red-800">Aluno</span>

                <select name="aluno_id"
                        required
                        class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">
                        {{ $turmaSelecionada ? 'Selecione um aluno da turma' : 'Selecione uma turma primeiro ou escolha um aluno' }}
                    </option>

                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}">
                            {{ $aluno->nome }} — {{ $aluno->turma }}
                        </option>
                    @endforeach
                </select>
            </label>

            <div class="flex items-end">
                <button class="w-full px-4 py-2 rounded-lg bg-yellow-400 text-red-900 font-bold shadow hover:bg-yellow-300 transition border border-yellow-500">
                    Adicionar
                </button>
            </div>
        </form>

    </section>

    <!-- LISTA DE PRESIDENTES -->
    <section class="bg-white rounded-2xl shadow border border-slate-200 p-6 border-t-4 border-yellow-400">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h2 class="text-xl font-black text-red-800">
                    Presidentes cadastrados
                </h2>
                <p class="text-sm text-slate-600">
                    Relação organizada por turma.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-slate-200">
            <table class="min-w-full text-sm">
                <thead class="bg-red-50 text-red-800">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Turma</th>
                        <th class="py-3 px-4 text-left font-semibold">Presidentes</th>
                        <th class="py-3 px-4 text-center font-semibold">Quantidade</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach($turmas as $turma)
                        @php
                            $lista = $presidentes[$turma] ?? collect();
                            $total = $lista->count();
                        @endphp

                        <tr class="hover:bg-red-50/40 transition">
                            <td class="py-4 px-4 font-bold text-red-800 whitespace-nowrap">
                                {{ $turma }}
                            </td>

                            <td class="py-4 px-4">
                                @if($lista->count())
                                    <div class="space-y-2">
                                        @foreach($lista as $presidente)
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 rounded-lg border border-slate-200 px-4 py-3 bg-slate-50">
                                                <div>
                                                    <p class="font-semibold text-slate-800">
                                                        {{ $presidente->aluno->nome ?? '-' }}
                                                    </p>
                                                    <p class="text-xs text-slate-500">
                                                        {{ $presidente->aluno->email ?? '-' }}
                                                    </p>
                                                </div>

                                                <form action="{{ route('admin.presidentes.destroy', $presidente->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Remover este presidente?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="text-red-700 font-semibold hover:text-red-800 hover:underline text-sm">
                                                        Remover
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-slate-500">
                                        Nenhum presidente cadastrado.
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-4 text-center">
                                @if($total >= 3)
                                    <span class="px-3 py-1 rounded-full bg-red-50 text-red-800 text-xs font-bold border border-red-200">
                                        {{ $total }}/3
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-800 text-xs font-bold border border-yellow-200">
                                        {{ $total }}/3
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>

</main>

@include('layouts.footer')