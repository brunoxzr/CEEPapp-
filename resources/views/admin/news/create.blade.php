@include('layouts.header', ['title' => 'Nova Notícia'])

<section class="max-w-5xl mx-auto px-6 py-12">
    <h1 class="text-2xl font-black mb-6">Criar Notícia</h1>

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Título -->
        <label class="block mb-4">
            <span class="font-semibold">Título</span>
            <input type="text" name="title"
                   class="mt-1 w-full border p-3 rounded"
                   required>
        </label>

        <!-- Capa -->
        <label class="block mb-6">
            <span class="font-semibold">Imagem de capa</span>
            <input type="file" name="cover"
                   class="mt-2 block">
        </label>

        <!-- Editor -->
        <label class="block mb-2 font-semibold">Conteúdo</label>
        <div id="editor" class="bg-white border rounded min-h-[300px]"></div>

        <input type="hidden" name="content" id="content">

        <button
            class="mt-6 px-6 py-2 bg-red-700 text-white rounded hover:bg-red-800">
            Publicar notícia
        </button>
    </form>
</section>

<!-- QUILL -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    document.querySelector('form').onsubmit = () => {
        document.getElementById('content').value = quill.root.innerHTML;
    };
</script>

@include('layouts.footer')
