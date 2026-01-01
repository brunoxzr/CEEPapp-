@include('layouts.admin_nav', ['title' => 'Editar Comunicado'])

<main class="max-w-4xl mx-auto px-6 mt-10">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-black text-red-800">✏️ Editar comunicado</h1>
        <p class="text-slate-600 text-sm mt-1">
            Atualize as informações do comunicado publicado
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.comunicados.update', $comunicado->id) }}"
          class="bg-white rounded-2xl shadow border p-8 space-y-8">

        @csrf
        @method('PUT')

        <!-- TÍTULO -->
        <div>
            <label class="block font-semibold mb-2">Título</label>
            <input type="text"
                   name="titulo"
                   required
                   value="{{ old('titulo', $comunicado->titulo) }}"
                   class="w-full border rounded px-4 py-3"
                   placeholder="Ex: Reunião pedagógica">
        </div>

        <!-- PÚBLICO -->
        <div>
            <label class="block font-semibold mb-2">Público</label>
            <select name="publico"
                    required
                    class="w-full border rounded px-4 py-3">
                <option value="todos" {{ old('publico', $comunicado->publico) === 'todos' ? 'selected' : '' }}>
                    Todos
                </option>
                <option value="aluno" {{ old('publico', $comunicado->publico) === 'aluno' ? 'selected' : '' }}>
                    Alunos
                </option>
                <option value="professor" {{ old('publico', $comunicado->publico) === 'professor' ? 'selected' : '' }}>
                    Professores
                </option>
            </select>
        </div>

        <!-- TURMA -->
        <div>
            <label class="block font-semibold mb-2">
                Turma <span class="text-xs text-slate-500">(opcional)</span>
            </label>
            <input type="text"
                   name="turma"
                   value="{{ old('turma', $comunicado->turma) }}"
                   class="w-full border rounded px-4 py-3"
                   placeholder="Ex: 2º DS">
        </div>

        <!-- CONTEÚDO -->
        <div>
            <label class="block font-semibold mb-2">Conteúdo do comunicado</label>

            <textarea name="conteudo"
                      rows="6"
                      required
                      class="w-full border rounded px-4 py-3 resize-none"
                      placeholder="Digite o comunicado completo...">{{ old('conteudo', $comunicado->conteudo) }}</textarea>

            <p class="text-xs text-slate-500 mt-1">
                💡 Esse texto será exibido diretamente no painel do aluno.
            </p>
        </div>

        <!-- AÇÕES -->
        <div class="flex justify-between items-center pt-6 border-t">

            <a href="{{ route('admin.comunicados.index') }}"
               class="text-sm font-bold text-slate-600 hover:underline">
                ← Voltar
            </a>

            <div class="flex gap-3">
                <button type="submit"
                        class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
                    Salvar alterações
                </button>
            </div>

        </div>

    </form>
</main>
