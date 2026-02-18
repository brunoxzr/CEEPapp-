@include('layouts.admin_nav', ['title' => 'Novo Aprovado'])

<main class="max-w-5xl mx-auto px-6 mt-10 space-y-10">

    <!-- HEADER PREMIUM -->
    <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600
                text-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-black">
            Cadastrar Novo Aprovado
        </h1>
        <p class="mt-2 text-white/90 text-sm">
            Adicione um aluno aprovado ao mural institucional.
        </p>
    </div>

    <form method="POST"
          action="{{ route('admin.aprovados.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-10 rounded-2xl shadow-xl space-y-8">
        @csrf

        <div class="grid md:grid-cols-2 gap-8">

            <!-- NOME -->
            <div>
                <label class="font-semibold block mb-2">Nome do aluno</label>
                <input type="text" name="nome"
                       value="{{ old('nome') }}"
                       required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600">
                @error('nome')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CURSO -->
            <div>
                <label class="font-semibold block mb-2">Curso Técnico</label>
                <input type="text" name="curso"
                       value="{{ old('curso') }}"
                       required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600">
            </div>

            <!-- APROVADO EM -->
            <div>
                <label class="font-semibold block mb-2">Aprovado em</label>
                <input type="text" name="aprovado_em"
                       value="{{ old('aprovado_em') }}"
                       required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600">
            </div>

            <!-- ANO -->
            <div>
                <label class="font-semibold block mb-2">Ano</label>
                <input type="text" name="ano"
                       value="{{ old('ano') }}"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600">
            </div>

        </div>

        <!-- FOTO -->
        <div>
            <label class="font-semibold block mb-2">Foto do aluno</label>

            <input type="file" name="foto"
                   accept="image/*"
                   onchange="previewImage(event)"
                   class="w-full border rounded-xl px-4 py-3">

            <div class="mt-4">
                <img id="preview"
                     class="hidden w-40 h-40 object-cover rounded-xl shadow">
            </div>
        </div>

        <!-- STATUS -->
        <div class="flex items-center gap-3">
            <input type="checkbox"
                   name="ativo"
                   value="1"
                   checked
                   class="w-5 h-5 text-red-700 rounded">
            <label class="font-semibold">
                Exibir no portal
            </label>
        </div>

        <!-- BOTÕES -->
        <div class="flex gap-4 pt-6 border-t">

            <button class="px-8 py-3 bg-red-700 text-white rounded-xl
                           font-bold hover:bg-red-800 transition shadow">
                Salvar
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
