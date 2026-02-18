@include('layouts.header', ['title' => 'Novo Prêmio'])

<form method="POST" action="{{ route('admin.premios.store') }}"
      enctype="multipart/form-data"
      class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow space-y-6">
    @csrf

    <div>
        <label class="font-bold">Título</label>
        <input name="titulo" required class="w-full border rounded px-4 py-2">
    </div>

    <div>
        <label class="font-bold">Descrição</label>
        <textarea name="descricao" rows="5"
                  class="w-full border rounded px-4 py-2"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-bold">Ano</label>
            <input name="ano" class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="font-bold">Imagem</label>
            <input type="file" name="imagem">
        </div>
    </div>

    <button class="px-6 py-3 bg-red-700 text-white font-bold rounded">
        Salvar Prêmio
    </button>
</form>

@include('layouts.footer')
