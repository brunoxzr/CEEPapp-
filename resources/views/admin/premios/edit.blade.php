@include('layouts.header', ['title' => 'Editar Prêmio'])

<form method="POST"
      action="{{ route('admin.premios.update', $premio) }}"
      enctype="multipart/form-data"
      class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow space-y-6">

    @csrf
    @method('PUT')

    <div>
        <label class="font-bold">Título</label>
        <input name="titulo"
               value="{{ $premio->titulo }}"
               class="w-full border rounded px-4 py-2">
    </div>

    <div>
        <label class="font-bold">Descrição</label>
        <textarea name="descricao" rows="4"
                  class="w-full border rounded px-4 py-2">{{ $premio->descricao }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="font-bold">Ano</label>
            <input name="ano"
                   value="{{ $premio->ano }}"
                   class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="font-bold">Imagem</label>
            <input type="file" name="imagem">
        </div>
    </div>

    <!-- ALUNOS -->
    <div>
        <label class="font-bold block mb-3">
            Alunos Participantes
        </label>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-64 overflow-y-auto border p-4 rounded">
            @foreach($alunos as $aluno)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox"
                           name="alunos[]"
                           value="{{ $aluno->id }}"
                           {{ $premio->alunos->contains($aluno->id) ? 'checked' : '' }}>
                    {{ $aluno->nome }}
                </label>
            @endforeach
        </div>
    </div>

    <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl">
        Salvar alterações
    </button>
</form>

@include('layouts.footer')
