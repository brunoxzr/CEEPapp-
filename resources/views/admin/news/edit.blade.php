@include('layouts.header', ['title' => 'Editar Notícia'])

<main class="bg-slate-50 py-12">
<div class="max-w-5xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-800 mb-8">
        Editar notícia
    </h1>

    {{-- MENSAGENS --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.news.update', $news->id) }}"
          enctype="multipart/form-data"
          class="bg-white p-8 rounded-xl shadow border space-y-10">

        @csrf
        @method('PUT')

        <!-- TÍTULO -->
        <div>
            <label class="block font-semibold mb-2">Título</label>
            <input
                type="text"
                name="title"
                required
                value="{{ old('title', $news->title) }}"
                class="w-full border rounded px-4 py-3 focus:ring-red-500 focus:border-red-500"
            >
        </div>

        <!-- SLUG -->
        <div>
            <label class="block font-semibold mb-2">Slug (URL)</label>
            <input
                type="text"
                name="slug"
                required
                value="{{ old('slug', $news->slug) }}"
                class="w-full border rounded px-4 py-3 font-mono text-sm focus:ring-red-500 focus:border-red-500"
            >
        </div>

        <!-- AUTOR -->
        <div>
            <label class="block font-semibold mb-2">Autor</label>
            <input
                type="text"
                name="author"
                value="{{ old('author', $news->author) }}"
                class="w-full border rounded px-4 py-3 focus:ring-red-500 focus:border-red-500"
                placeholder="Ex: Assessoria CEEP Assaí"
            >
        </div>

        <!-- CAPA -->
        <div>
            <label class="block font-semibold mb-2">Imagem de capa</label>

            @if($news->cover_path)
                <img src="{{ asset('storage/'.$news->cover_path) }}"
                     class="w-full max-h-64 object-contain border rounded mb-4">
            @endif

            <input type="file" name="cover" accept="image/*">
            <p class="text-xs text-slate-500 mt-1">
                Envie outra imagem se quiser substituir a atual
            </p>
        </div>

        <!-- CONTEÚDO -->
        <div>
            <label class="block font-semibold mb-2">Conteúdo da notícia</label>

            <!-- EDITOR -->
            <div id="editor"
                 class="border rounded min-h-[360px] p-4 bg-white text-slate-800">
                {!! old('content', $news->content) !!}
            </div>

            <!-- CAMPO OCULTO -->
            <input type="hidden" name="content" id="content">
        </div>

        <!-- BOTÕES -->
        <div class="flex gap-4 pt-8 border-t">
            <button
                type="submit"
                class="px-6 py-3 bg-red-700 text-white font-bold rounded hover:bg-red-800 transition">
                Atualizar notícia
            </button>

            <a href="{{ route('admin.news.index') }}"
               class="px-6 py-3 border border-slate-300 rounded font-semibold hover:bg-slate-100">
                Cancelar
            </a>
        </div>

    </form>

</div>
</main>

@include('layouts.footer')

{{-- QUILL --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ align: [] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Edite a notícia aqui...'
    });

    // ENVIA HTML PARA O BACKEND
    document.querySelector('form').addEventListener('submit', () => {
        document.querySelector('#content').value = quill.root.innerHTML;
    });

});
</script>
