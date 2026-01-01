@include('layouts.admin_nav', ['title' => 'Novo Evento'])


<main class="max-w-4xl mx-auto px-6 mt-10">

    <h1 class="text-3xl font-black text-red-800 mb-6">
        ➕ Novo evento institucional
    </h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.calendario.store') }}"
          class="bg-white rounded-2xl shadow border p-8 space-y-6">

        @csrf

        <div>
            <label class="font-bold block mb-1">Título</label>
            <input type="text" name="titulo" required
                   class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="font-bold block mb-1">Descrição</label>
            <textarea name="descricao"
                      class="w-full border rounded-lg px-4 py-3"
                      rows="3"></textarea>
        </div>

        <div>
            <label class="font-bold block mb-1">Data</label>
            <input type="date" name="data" required
                   class="border rounded-lg px-4 py-3">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold block mb-1">Hora início</label>
                <input type="time" name="hora_inicio"
                       class="border rounded-lg px-4 py-3 w-full">
            </div>

            <div>
                <label class="font-bold block mb-1">Hora fim</label>
                <input type="time" name="hora_fim"
                       class="border rounded-lg px-4 py-3 w-full">
            </div>
        </div>

        <div>
            <label class="font-bold block mb-1">Tipo</label>
            <select name="tipo" required
                    class="border rounded-lg px-4 py-3 w-full">
                <option value="reuniao">Reunião</option>
                <option value="conselho">Conselho de Classe</option>
                <option value="evento">Evento</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div>
            <label class="font-bold block mb-1">Público</label>
            <select name="publico" required
                    class="border rounded-lg px-4 py-3 w-full">
                <option value="alunos">Alunos</option>
                <option value="professores">Professores</option>
                <option value="todos">Todos</option>
            </select>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="ativo" checked class="w-5 h-5 accent-red-700">
            <span class="font-semibold">Evento ativo</span>
        </div>

        <div class="flex justify-between pt-6 border-t">
            <a href="{{ route('admin.calendario.index') }}"
               class="font-bold text-slate-600 hover:underline">
                ← Voltar
            </a>

            <button type="submit"
                    class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
                Salvar evento
            </button>
        </div>

    </form>
</main>
