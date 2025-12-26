@include('layouts.header', ['title' => 'Criar Notícia'])

<main class="bg-slate-50 py-12">
<div class="max-w-5xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-800 mb-8">
        Criar nova notícia
    </h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.news.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-8 rounded-xl shadow border space-y-10">

        @csrf

        <!-- TÍTULO -->
        <div>
            <label class="block font-semibold mb-2">Título</label>
            <input type="text" name="title" required
                   value="{{ old('title') }}"
                   class="w-full border rounded px-4 py-3"
                   placeholder="CEEP Assaí realiza feira tecnológica">
        </div>

        <!-- SLUG -->
        <div>
            <label class="block font-semibold mb-2">Slug (URL)</label>
            <input type="text" name="slug" required
                   value="{{ old('slug') }}"
                   class="w-full border rounded px-4 py-3 font-mono text-sm"
                   placeholder="ceep-assai-realiza-feira-tecnologica">
        </div>

        <!-- AUTOR -->
        <div>
            <label class="block font-semibold mb-2">Autor</label>
            <input type="text" name="author"
                   value="{{ old('author','CEEP Assaí') }}"
                   class="w-full border rounded px-4 py-3">
        </div>

        <!-- CAPA -->
        <div>
            <label class="block font-semibold mb-2">Imagem de capa</label>
            <input type="file" name="cover" accept="image/*">
            <p class="text-xs text-slate-500 mt-1">
                Imagem principal exibida no topo da notícia (16:9 recomendado)
            </p>
        </div>

        <!-- EDITOR -->
        <div>
            <label class="block font-semibold mb-2">Conteúdo da notícia</label>

            <!-- TOOLBAR -->
            <div id="toolbar" class="border rounded-t bg-slate-100">
                <select class="ql-header">
                    <option value="1">Título</option>
                    <option value="2">Subtítulo</option>
                    <option value="3">Seção</option>
                    <option selected>Normal</option>
                </select>

                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>

                <select class="ql-color"></select>
                <select class="ql-background"></select>

                <button class="ql-align" value=""></button>
                <button class="ql-align" value="center"></button>
                <button class="ql-align" value="right"></button>

                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>

                <button class="ql-link"></button>
                <button class="ql-image"></button>

                <button class="ql-clean"></button>
            </div>

            <!-- EDITOR -->
            <div id="editor"
                 class="border border-t-0 rounded-b min-h-[350px] p-4 bg-white">
                {!! old('content') !!}
            </div>

            <input type="hidden" name="content" id="content">

            <p class="text-xs text-slate-500 mt-2">
                💡 Dica:
                <br>• Clique na imagem → use alinhamento para texto ficar ao lado
                <br>• Arraste a imagem pelas bordas para ajustar largura
            </p>
        </div>

        <!-- BOTÕES -->
        <div class="flex gap-4 pt-8 border-t">
            <button type="submit"
                    class="px-6 py-3 bg-red-700 text-white font-bold rounded hover:bg-red-800">
                Publicar notícia
            </button>

            <a href="{{ route('admin.news.index') }}"
               class="px-6 py-3 border rounded font-semibold">
                Cancelar
            </a>
        </div>

    </form>
</div>
</main>

@include('layouts.footer')

<!-- QUILL -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<style>
/* IMAGENS RESPONSIVAS + TEXTO AO LADO */
.ql-editor img {
    max-width: 100%;
    height: auto;
}

.ql-align-right img {
    float: right;
    margin: 0 0 1rem 1rem;
    max-width: 45%;
}

.ql-align-left img {
    float: left;
    margin: 0 1rem 1rem 0;
    max-width: 45%;
}

.ql-align-center img {
    display: block;
    margin: 1rem auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: '#toolbar'
        },
        placeholder: 'Escreva a notícia como se fosse um Word ou G1…'
    });

    document.querySelector('form').addEventListener('submit', () => {
        document.getElementById('content').value = quill.root.innerHTML;
    });
});
</script>
