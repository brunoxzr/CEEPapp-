@include('layouts.admin_nav', ['title' => 'Novo Comunicado'])


<main class="max-w-4xl mx-auto px-6 mt-10 mb-20">

    <h1 class="text-3xl font-black text-red-800 mb-6 flex items-center gap-2">
        📢 Novo Comunicado
    </h1>

    {{-- ALERTA DE ERRO --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.comunicados.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        @csrf

        {{-- TÍTULO --}}
        <div>
            <label class="font-semibold block mb-1">Título</label>
            <input type="text"
                   name="titulo"
                   required
                   value="{{ old('titulo') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-red-200">
        </div>

        {{-- PÚBLICO --}}
        <div>
            <label class="font-semibold block mb-1">Público</label>
            <select name="publico"
                    id="publico"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="geral" {{ old('publico') === 'geral' ? 'selected' : '' }}>
                    Todos os alunos
                </option>
                <option value="turma" {{ old('publico') === 'turma' ? 'selected' : '' }}>
                    Turma(s) específica(s)
                </option>
            </select>
        </div>

        {{-- TURMAS --}}
        <div id="turmaBox" class="hidden">
            <label class="font-semibold block mb-2">
                Turmas
                <span class="text-sm text-slate-500">
                    (Ctrl ou Shift para selecionar várias)
                </span>
            </label>

            <select name="turmas[]"
                    multiple
                    class="w-full border rounded-lg px-4 py-2 h-60">

                <optgroup label="1º Ano">
                    <option value="1º IA">1º IA</option>
                    <option value="1º EDF">1º EDF</option>
                    <option value="1º MEC">1º MEC</option>
                    <option value="1º Agro">1º Agro</option>
                </optgroup>

                <optgroup label="2º Ano">
                    <option value="2º DS">2º DS</option>
                    <option value="2º EDF">2º EDF</option>
                    <option value="2º MEC">2º MEC</option>
                    <option value="2º Agro A">2º Agro A</option>
                    <option value="2º Agro E">2º Agro E</option>
                    <option value="2º Enf">2º Enf</option>
                </optgroup>

                <optgroup label="3º Ano">
                    <option value="3º DS">3º DS</option>
                    <option value="3º EDF">3º EDF</option>
                    <option value="3º MEC">3º MEC</option>
                    <option value="3º Eletro">3º Eletro</option>
                    <option value="3º Agro">3º Agro</option>
                    <option value="3º Enf">3º Enf</option>
                </optgroup>

                <optgroup label="Outros">
                    <option value="Egresso">Egresso</option>
                </optgroup>

            </select>
        </div>

        {{-- CONTEÚDO --}}
        <div>
            <label class="font-semibold block mb-1">Conteúdo</label>
            <textarea name="conteudo"
                      rows="6"
                      required
                      class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-red-200"
                      placeholder="Escreva o comunicado...">{{ old('conteudo') }}</textarea>
        </div>

        {{-- AÇÕES --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.comunicados.index') }}"
               class="text-sm text-slate-600 hover:underline">
                ← Voltar
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition">
                Publicar Comunicado
            </button>
        </div>

    </form>
</main>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const publico = document.getElementById('publico');
    const turmaBox = document.getElementById('turmaBox');

    function toggleTurmas() {
        turmaBox.classList.toggle('hidden', publico.value !== 'turma');
    }

    publico.addEventListener('change', toggleTurmas);
    toggleTurmas();
});
</script>
