@include('layouts.aluno_nav', ['title' => 'Chamada da Turma'])

<main class="max-w-7xl mx-auto px-6 py-10 space-y-8">

    <div>
        <h1 class="text-3xl font-black text-red-800 mb-2">
            Chamada da Turma
        </h1>
        <p class="text-slate-600">
            Registre a presença dos alunos da turma {{ $aluno->turma }}.
        </p>
    </div>

    @if(session('ok'))
        <div class="p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
            {{ session('ok') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-red-50 border-l-4 border-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-red-800 space-y-1">
                @foreach($errors->all() as $e)
                    <li class="text-sm">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="grid lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-white rounded-2xl shadow border border-slate-200 overflow-hidden border-t-4 border-red-700">

            <div class="p-6 border-b bg-slate-50">
                <h2 class="text-xl font-black text-red-800">
                    Nova chamada
                </h2>
            </div>

            <form action="{{ route('aluno.presidente.chamada.store') }}" method="POST">
                @csrf

                <div class="p-6 grid md:grid-cols-3 gap-4 border-b border-slate-100">

                    <label class="block">
                        <span class="text-sm font-semibold text-red-800">Data</span>
                        <input type="date"
                               name="data"
                               value="{{ date('Y-m-d') }}"
                               required
                               class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-red-800">Aula</span>
                        <select name="aula"
                                class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                            <option value="">Selecione</option>
                            <option value="1ª aula">1ª aula</option>
                            <option value="2ª aula">2ª aula</option>
                            <option value="3ª aula">3ª aula</option>
                            <option value="4ª aula">4ª aula</option>
                            <option value="5ª aula">5ª aula</option>
                            <option value="6ª aula">6ª aula</option>
                        </select>
                    </label>

                    <label class="block">
                        <span class="text-sm font-semibold text-red-800">Turma</span>
                        <input type="text"
                               value="{{ $aluno->turma }}"
                               disabled
                               class="mt-1 w-full rounded-lg border-2 border-slate-200 bg-slate-100 text-slate-600">
                    </label>

                    <label class="md:col-span-3 block">
                        <span class="text-sm font-semibold text-red-800">Observação</span>
                        <textarea name="observacao"
                                  rows="3"
                                  placeholder="Opcional"
                                  class="mt-1 w-full rounded-lg border-2 border-red-300 bg-white text-red-900 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"></textarea>
                    </label>

                </div>

                <div class="p-6">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                        <div>
                            <h3 class="font-black text-red-800">
                                Lista de alunos
                            </h3>
                            <p class="text-sm text-slate-600">
                                Desmarque apenas quem estiver ausente.
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <button type="button"
                                    onclick="marcarTodos(true)"
                                    class="px-3 py-2 rounded-lg bg-yellow-400 text-red-900 text-sm font-bold hover:bg-yellow-300 transition">
                                Marcar todos
                            </button>

                            <button type="button"
                                    onclick="marcarTodos(false)"
                                    class="px-3 py-2 rounded-lg bg-slate-200 text-red-800 text-sm font-bold hover:bg-slate-300 transition">
                                Desmarcar todos
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-slate-200">
                        <table class="min-w-full text-sm">
                            <thead class="bg-red-50 text-red-800">
                                <tr>
                                    <th class="py-3 px-4 text-left font-semibold">Presente</th>
                                    <th class="py-3 px-4 text-left font-semibold">Aluno</th>
                                    <th class="py-3 px-4 text-left font-semibold">E-mail</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse($alunosTurma as $item)
                                    <tr class="hover:bg-red-50/40 transition">
                                        <td class="py-3 px-4">
                                            <input type="checkbox"
                                                   name="presentes[]"
                                                   value="{{ $item->id }}"
                                                   checked
                                                   class="check-presenca rounded border-red-300 text-red-700 focus:ring-yellow-400">
                                        </td>

                                        <td class="py-3 px-4 font-medium text-slate-800">
                                            {{ $item->nome }}
                                        </td>

                                        <td class="py-3 px-4 text-slate-600">
                                            {{ $item->email }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 px-4 text-center text-slate-500">
                                            Nenhum aluno encontrado nesta turma.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <button class="px-5 py-3 rounded-lg bg-yellow-400 text-red-900 font-black shadow hover:bg-yellow-300 transition border border-yellow-500">
                            Enviar chamada
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <aside class="bg-white rounded-2xl shadow border border-slate-200 p-6 border-t-4 border-yellow-400">
            <h2 class="text-xl font-black text-red-800 mb-4">
                Últimas chamadas
            </h2>

            <div class="space-y-3">
                @forelse($chamadas as $chamada)
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                        <p class="font-bold text-red-800">
                            {{ $chamada->data->format('d/m/Y') }}
                        </p>

                        <p class="text-sm text-slate-600">
                            {{ $chamada->aula ?? 'Aula não informada' }}
                        </p>

                        <div class="mt-2 flex gap-2 text-xs font-bold">
                            <span class="px-2 py-1 rounded-full bg-green-50 text-green-800 border border-green-200">
                                {{ $chamada->presentes_count }} presentes
                            </span>

                            <span class="px-2 py-1 rounded-full bg-red-50 text-red-800 border border-red-200">
                                {{ $chamada->ausentes_count }} ausentes
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">
                        Nenhuma chamada enviada ainda.
                    </p>
                @endforelse
            </div>
        </aside>

    </section>

</main>

@include('layouts.footer')

<script>
    function marcarTodos(status) {
        document.querySelectorAll('.check-presenca').forEach((check) => {
            check.checked = status;
        });
    }
</script>