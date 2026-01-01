@include('layouts.admin_nav', ['title' => 'Novo Comunicado'])
@include('layouts.sidebar')

<main class="max-w-4xl mx-auto px-6 mt-10">

    <h1 class="text-3xl font-black text-red-800 mb-6">
        📢 Novo Comunicado
    </h1>

    <form method="POST"
          action="{{ route('admin.comunicados.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        @csrf

        <div>
            <label class="font-semibold">Título</label>
            <input type="text" name="titulo" required
                   class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="font-semibold">Público</label>
            <select name="publico" id="publico"
                    class="w-full border rounded px-4 py-2">
                <option value="geral">Todos os alunos</option>
                <option value="turma">Turma específica</option>
            </select>
        </div>

        <div id="turmaBox" class="hidden">
            <label class="font-semibold">Turma</label>
            <input type="text" name="turma"
                   placeholder="Ex: 2º DS"
                   class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="font-semibold">Conteúdo</label>
            <textarea name="conteudo"
                      rows="6"
                      class="w-full border rounded px-4 py-2"
                      placeholder="Escreva o comunicado..."></textarea>
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('admin.comunicados.index') }}"
               class="text-sm text-slate-600 hover:underline">
                ← Voltar
            </a>

            <button class="px-6 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800">
                Publicar
            </button>
        </div>

    </form>
</main>

<script>
document.getElementById('publico').addEventListener('change', e => {
    document.getElementById('turmaBox')
        .classList.toggle('hidden', e.target.value !== 'turma');
});
</script>
