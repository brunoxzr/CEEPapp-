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

        <div class="grid md:grid-cols-2 gap-6">
            <!-- TÍTULO -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-2 text-slate-700">Título da Notícia</label>
                <input type="text" name="title" required
                       value="{{ old('title', $news->title) }}"
                       class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
            </div>

            <!-- SLUG -->
            <div>
                <label class="block font-semibold mb-2 text-slate-700">Slug (URL)</label>
                <input type="text" name="slug" required
                       value="{{ old('slug', $news->slug) }}"
                       class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 font-mono text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                <p class="text-xs text-slate-500 mt-1">URL amigável para a notícia</p>
            </div>

            <!-- AUTOR -->
            <div>
                <label class="block font-semibold mb-2 text-slate-700">Autor</label>
                <input type="text" name="author"
                       value="{{ old('author', $news->author) }}"
                       class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                       placeholder="Ex: Assessoria CEEP Assaí">
            </div>

            <!-- CAPA -->
            <div>
                <label class="block font-semibold mb-2 text-slate-700">Imagem de Capa</label>

                @if($news->cover_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/'.$news->cover_path) }}"
                             class="w-full max-h-48 object-contain border-2 border-slate-300 rounded-lg">
                        <p class="text-xs text-slate-500 mt-2">Imagem atual</p>
                    </div>
                @endif

                <input type="file" name="cover" accept="image/*"
                       class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                <p class="text-xs text-slate-500 mt-2">
                    Usada em listagens e cards. Proporção 16:9 recomendada.
                </p>
            </div>

            <!-- HERO -->
            <div>
                <label class="block font-semibold mb-2 text-slate-700">Imagem de Hero</label>

                @if($news->hero_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/'.$news->hero_path) }}"
                             class="w-full max-h-48 object-contain border-2 border-slate-300 rounded-lg">
                        <p class="text-xs text-slate-500 mt-2">Imagem atual do hero</p>
                    </div>
                @elseif($news->cover_path)
                    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-xs text-yellow-800">
                            <strong>Usando a imagem de capa como hero.</strong> Envie uma imagem específica para o hero se desejar.
                        </p>
                    </div>
                @endif

                <input type="file" name="hero" accept="image/*"
                       class="w-full rounded-lg border-2 border-slate-300 bg-white text-slate-900 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                <p class="text-xs text-slate-500 mt-2">
                    Imagem grande no topo da notícia (estilo G1). Se não informar, usa a capa como fallback.
                </p>
            </div>
        </div>

        <!-- CONTEÚDO -->
        <div>
            <label class="block font-semibold mb-2 text-slate-700">Conteúdo da notícia</label>

            <!-- EDITOR -->
            <div id="editor" class="min-h-[500px] bg-white border-2 border-slate-300 rounded-lg">
                {!! \App\Models\News::sanitizeHtml(old('content', $news->content)) !!}
            </div>

            <!-- CAMPO OCULTO -->
            <input type="hidden" name="content" id="content">

            <p class="text-xs text-slate-500 mt-3">
                Use a barra de ferramentas acima para formatar o texto. Você pode adicionar imagens, links, listas e muito mais.
            </p>
        </div>

        <!-- BOTÕES -->
        <div class="flex gap-4 pt-8 border-t border-slate-200">
            <button type="submit"
                    class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
                Atualizar Notícia
            </button>

            <a href="{{ route('admin.news.index') }}"
               class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
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

<style>
.ql-editor {
    min-height: 500px;
    font-size: 16px;
    line-height: 1.6;
}

.ql-editor img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

.ql-align-right img {
    float: right;
    margin: 0 0 1rem 1.5rem;
    max-width: 45%;
}

.ql-align-left img {
    float: left;
    margin: 0 1.5rem 1rem 0;
    max-width: 45%;
}

.ql-align-center img {
    display: block;
    margin: 1.5rem auto;
    max-width: 80%;
}

.ql-editor blockquote {
    border-left: 4px solid #dc2626;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #64748b;
}

.ql-editor pre {
    background: #f1f5f9;
    border-radius: 6px;
    padding: 1rem;
    overflow-x: auto;
}

.ql-editor code {
    background: #f1f5f9;
    padding: 0.2rem 0.4rem;
    border-radius: 3px;
    font-size: 0.9em;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'font': [] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video', 'blockquote', 'code-block'],
                    ['clean']
                ],
                handlers: {
                    'image': function() {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.click();

                        input.onchange = async () => {
                            const file = input.files[0];
                            if (file) {
                                const formData = new FormData();
                                formData.append('image', file);

                                try {
                                    const response = await fetch('{{ route("admin.news.upload") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: formData
                                    });

                                    const data = await response.json();
                                    const range = quill.getSelection(true);
                                    quill.insertEmbed(range.index, 'image', data.url);
                                } catch (error) {
                                    console.error('Erro ao fazer upload:', error);
                                    alert('Erro ao fazer upload da imagem');
                                }
                            }
                        };
                    }
                }
            }
        },
        placeholder: 'Edite sua notícia aqui. Use a barra de ferramentas para formatar o texto, adicionar imagens, links e muito mais...'
    });

    document.querySelector('form').addEventListener('submit', (e) => {
        const content = quill.root.innerHTML;
        if (content.trim() === '<p><br></p>' || content.trim() === '') {
            e.preventDefault();
            alert('Por favor, escreva o conteúdo da notícia.');
            return false;
        }
        document.querySelector('#content').value = content;
    });
});
</script>
