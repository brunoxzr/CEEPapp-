@include('layouts.admin_nav', ['title' => 'Editar Aprovado'])

<main class="max-w-5xl mx-auto px-6 mt-10 space-y-10">

    <!-- HEADER -->
    <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600
                text-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-black">
            Editar Aprovado
        </h1>
        <p class="mt-2 text-white/90 text-sm">
            Atualize as informações do aluno.
        </p>
    </div>

    <form method="POST"
          action="{{ route('admin.aprovados.update', $aprovado->id) }}"
          enctype="multipart/form-data"
          class="bg-white p-10 rounded-2xl shadow-xl space-y-8">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-8">

            <div>
                <label class="font-semibold block mb-2">Nome</label>
                <input type="text" name="nome"
                       value="{{ old('nome', $aprovado->nome) }}"
                       required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600">
            </div>

            <div>
                <label class="font-semibold block mb-2">Curso</label>
                <input type="text" name="curso"
                       value="{{ old('curso', $aprovado->curso) }}"
                       required
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="font-semibold block mb-2">Aprovado em</label>
                <input type="text" name="aprovado_em"
                       value="{{ old('aprovado_em', $aprovado->aprovado_em) }}"
                       required
                       class="w-full border rounded-xl px-4 py-3">
            </div>

            <div>
                <label class="font-semibold block mb-2">Ano</label>
                <input type="text" name="ano"
                       value="{{ old('ano', $aprovado->ano) }}"
                       class="w-full border rounded-xl px-4 py-3">
            </div>

        </div>

        <!-- FOTO -->
        <div>
            <label class="font-semibold block mb-2">Foto Atual</label>

            @if($aprovado->foto)
                <img src="{{ asset('storage/'.$aprovado->foto) }}"
                     class="w-48 h-48 object-cover rounded-xl shadow mb-4">
            @endif

            <input type="file" name="foto"
                   accept="image/*"
                   onchange="previewImage(event)"
                   class="w-full border rounded-xl px-4 py-3">

            <img id="preview"
                 class="hidden mt-4 w-48 h-48 object-cover rounded-xl shadow">
        </div>

        <!-- STATUS -->
        <div class="flex items-center gap-3">
            <input type="checkbox"
                   name="ativo"
                   value="1"
                   {{ $aprovado->ativo ? 'checked' : '' }}
                   class="w-5 h-5 text-red-700 rounded">
            <label class="font-semibold">
                Exibir no portal
            </label>
        </div>

        <!-- BOTÕES -->
        <div class="flex gap-4 pt-6 border-t">

            <button class="px-8 py-3 bg-red-700 text-white rounded-xl
                           font-bold hover:bg-red-800 transition shadow">
                Atualizar
            </button>

            <a href="{{ route('admin.aprovados.index') }}"
               class="px-8 py-3 border rounded-xl font-semibold hover:bg-slate-50">
                Cancelar
            </a>

        </div>

    </form>

</main>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('hidden');
}
</script>
