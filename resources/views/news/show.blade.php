

@php
    $heroImage = $news->hero_path ?? $news->cover_path;
@endphp

@include('layouts.header', ['title' => $news->title])

@include('news.seo')

@if(!empty($heroImage))
<meta property="og:image" content="{{ asset('storage/'.$heroImage) }}">
@endif


<style>
/* =========================
   ESTILOS DO CONTEÚDO DA NOTÍCIA
   ========================= */

.ql-editor {
    font-size: 1.125rem;
    line-height: 1.85;
    color: #1e293b;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

.ql-editor p {
    margin-bottom: 1.25rem;
}

.ql-editor h1 {
    font-size: 2.25rem;
    font-weight: 800;
    line-height: 1.2;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #991b1b;
}

.ql-editor h2 {
    font-size: 1.875rem;
    font-weight: 700;
    line-height: 1.3;
    margin-top: 1.75rem;
    margin-bottom: 0.875rem;
    color: #dc2626;
}

.ql-editor h3 {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.4;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #991b1b;
}

.ql-editor h4, .ql-editor h5, .ql-editor h6 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.625rem;
    color: #1e293b;
}

.ql-editor .ql-size-small {
    font-size: 0.875em;
}

.ql-editor .ql-size-large {
    font-size: 1.35em;
}

.ql-editor .ql-size-huge {
    font-size: 1.8em;
    line-height: 1.25;
}

.ql-editor .ql-font-serif {
    font-family: Georgia, "Times New Roman", Times, serif;
}

.ql-editor .ql-font-monospace {
    font-family: "Courier New", Courier, monospace;
}

/* Imagens */
.ql-editor img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,.1);
    margin: 2rem 0;
}

.ql-align-right img {
    float: right;
    margin: 0 0 1.5rem 2rem;
    max-width: 45%;
}

.ql-align-left img {
    float: left;
    margin: 0 2rem 1.5rem 0;
    max-width: 45%;
}

.ql-align-center img {
    display: block;
    margin: 2rem auto;
    max-width: 85%;
}

/* Listas */
.ql-editor ul, .ql-editor ol {
    margin: 1.25rem 0;
    padding-left: 2rem;
}

.ql-editor li {
    margin-bottom: 0.5rem;
    line-height: 1.7;
}

.ql-editor .ql-indent-1 {
    margin-left: 3em;
}

.ql-editor .ql-indent-2 {
    margin-left: 6em;
}

.ql-editor .ql-indent-3 {
    margin-left: 9em;
}

.ql-editor .ql-indent-4 {
    margin-left: 12em;
}

.ql-editor .ql-indent-5 {
    margin-left: 15em;
}

.ql-editor .ql-indent-6 {
    margin-left: 18em;
}

.ql-editor .ql-indent-7 {
    margin-left: 21em;
}

.ql-editor .ql-indent-8 {
    margin-left: 24em;
}

/* Citações */
.ql-editor blockquote {
    border-left: 4px solid #dc2626;
    padding: 1rem 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #475569;
    background: #f8fafc;
    border-radius: 0 8px 8px 0;
}

/* Código */
.ql-editor pre {
    background: #1e293b;
    color: #e2e8f0;
    border-radius: 8px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    overflow-x: auto;
    font-size: 0.9rem;
    line-height: 1.6;
}

.ql-editor code {
    background: #f1f5f9;
    color: #dc2626;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.9em;
    font-family: 'Courier New', monospace;
}

.ql-editor pre code {
    background: transparent;
    color: inherit;
    padding: 0;
}

/* Links */
.ql-editor a {
    color: #dc2626;
    text-decoration: underline;
    transition: color 0.2s;
}

.ql-editor a:hover {
    color: #991b1b;
}

/* Alinhamento de texto */
.ql-editor .ql-align-center {
    text-align: center;
}

.ql-editor .ql-align-right {
    text-align: right;
}

.ql-editor .ql-align-justify {
    text-align: justify;
}

.ql-editor .ql-direction-rtl {
    direction: rtl;
    text-align: inherit;
}

/* Limpar floats */
.ql-editor p::after,
.ql-editor h1::after,
.ql-editor h2::after,
.ql-editor h3::after {
    content: "";
    display: block;
    clear: both;
}

/* Vídeo */
.ql-editor iframe {
    display: block;
    width: 100%;
    max-width: 100%;
    aspect-ratio: 16 / 9;
    height: auto;
    border-radius: 8px;
    margin: 2rem 0;
}

.ql-editor .ql-video {
    display: block;
    width: 100%;
    max-width: 100%;
}

.ql-editor sub,
.ql-editor sup {
    font-size: 0.75em;
    line-height: 0;
    position: relative;
    vertical-align: baseline;
}

.ql-editor sup {
    top: -0.5em;
}

.ql-editor sub {
    bottom: -0.25em;
}

@media (max-width: 768px) {
    .ql-editor .ql-indent-1,
    .ql-editor .ql-indent-2,
    .ql-editor .ql-indent-3,
    .ql-editor .ql-indent-4,
    .ql-editor .ql-indent-5,
    .ql-editor .ql-indent-6,
    .ql-editor .ql-indent-7,
    .ql-editor .ql-indent-8 {
        margin-left: 1.5rem;
    }

    .ql-editor .ql-size-huge {
        font-size: 1.45em;
    }
}

/* Espaçamento entre elementos */
.ql-editor > *:first-child {
    margin-top: 0;
}

.ql-editor > *:last-child {
    margin-bottom: 0;
}
/* =========================
   VEJA TAMBÉM — ESTILO EDITORIAL (G1)
   ========================= */

.veja-tambem article {
    transition: background-color .2s ease;
}

.veja-tambem article:hover {
    background-color: #fafafa;
}

/* Imagem */
.veja-tambem img {
    border-radius: 6px;
}

/* Chapéu (editoria) */
.veja-tambem .chapeu {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #b91c1c;
}

/* Título */
.veja-tambem h3 {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-weight: 700;
    font-size: 1.25rem;
    line-height: 1.25;
    color: #111827;
    transition: color .2s ease;
}

.veja-tambem a:hover h3 {
    color: #b91c1c;
}

/* Linha fina / resumo */
.veja-tambem p {
    font-size: 0.95rem;
    line-height: 1.55;
    color: #4b5563;
}

/* Meta */
.veja-tambem .meta {
    font-size: 0.8rem;
    color: #6b7280;
}

/* Separador */
.veja-tambem article + article {
    border-top: 1px solid #e5e7eb;
}

/* Mobile */
@media (max-width: 768px) {
    .veja-tambem h3 {
        font-size: 1.1rem;
    }

    .veja-tambem img {
        height: 180px;
    }
}

</style>

<main class="bg-white">


    <section class="relative {{ $heroImage ? 'h-[70vh] min-h-[500px]' : 'bg-gradient-to-br from-red-800 via-red-700 to-red-900 py-24' }}">
        @if($heroImage)
        <img
            src="{{ asset('storage/'.$heroImage) }}"
            class="absolute inset-0 w-full h-full object-cover"
            alt="{{ $news->title }}"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>
        @endif

        <div class="relative max-w-6xl mx-auto px-6 h-full flex items-end pb-16">
            <div class="w-full">
                <!-- Badge -->
                <div class="mb-4">
                    <span class="inline-block px-4 py-1.5 bg-red-700 text-white text-xs font-bold uppercase tracking-wider rounded-full">
                        Notícia
                    </span>
                </div>

                <!-- Título -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] mb-6 max-w-5xl drop-shadow-2xl">
                    {{ $news->title }}
                </h1>

                <!-- Metadados -->
                <div class="flex flex-wrap items-center gap-4 text-white/90 text-sm md:text-base">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-semibold">{{ $news->author ?? 'CEEP Assaí' }}</span>
                    </div>
                    <span class="text-white/60">•</span>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
@if($news->published_at)
<time datetime="{{ $news->published_at->toIso8601String() }}">
    {{ $news->published_at->format('d/m/Y \à\s H:i') }}
</time>
@endif

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CONTEÚDO ================= -->
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-6">

            <!-- CONTEÚDO PRINCIPAL -->
            <article class="prose prose-lg max-w-none">
                <div class="ql-editor">
                    {!! $news->safe_content !!}
                </div>
            </article>

            <!-- DIVISOR -->
            <div class="my-12 border-t border-slate-200"></div>

            <!-- BOTÃO VOLTAR -->
            <div class="flex justify-between items-center">
                <a href="{{ route('portal.news.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar para notícias
                </a>

                <!-- Compartilhar (opcional) -->
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <span>Compartilhar:</span>

                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="p-2 rounded-full bg-sky-100 text-sky-600 hover:bg-sky-200 transition"
                       title="Compartilhar no Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' ' . request()->url()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition"
                       title="Compartilhar no WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </a>
                    <button
    onclick="copyNewsLink()"
    class="p-2 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 transition"
    title="Copiar link">

    <!-- ÍCONE LINK -->
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5m5.828-1.172a4 4 0 010-5.656l3-3a4 4 0 115.656 5.656l-1.5 1.5"/>
    </svg>
</button>

<!-- FEEDBACK -->
<span id="copyFeedback" class="hidden text-sm text-green-600 font-semibold">
    Link copiado!
</span>

                </div>
            </div>

        </div>
    </section>

    <!-- ================= VEJA TAMBÉM ================= -->
    @if($recentNews->count())
    <section class="bg-slate-50 py-20 border-t">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-black text-red-800 mb-2">
                        Veja também
                    </h2>
                    <p class="text-slate-600">
                        Outras notícias do CEEP Assaí
                    </p>
                </div>
                <a href="{{ route('portal.news.index') }}"
                   class="hidden md:flex items-center gap-2 px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
                    Ver todas as notícias
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
<div class="divide-y divide-slate-200">
    @foreach($recentNews as $item)
        <article class="py-8">
            <a href="{{ route('portal.news.show', $item->slug) }}"
               class="flex flex-col md:flex-row gap-6 group">

                {{-- IMAGEM --}}
                <div class="w-full md:w-[260px] flex-shrink-0">
                    @if($item->cover_path)
                        <img
                            src="{{ asset('storage/'.$item->cover_path) }}"
                            alt="{{ $item->title }}"
                            class="w-full h-[160px] object-cover rounded-md"
                        >
                    @else
                        <div class="w-full h-[160px] bg-gradient-to-br from-red-800 to-red-900 flex items-center justify-center rounded-md">
                            <span class="text-white text-xs font-bold tracking-widest uppercase">
                                CEEP Assaí
                            </span>
                        </div>
                    @endif
                </div>

                {{-- TEXTO --}}
                <div class="flex-1 space-y-2">

                    {{-- CHAPÉU --}}
                    <span class="text-xs font-bold uppercase tracking-widest text-red-700">
                        Notícia
                    </span>

                    {{-- TÍTULO --}}
                    <h3 class="text-xl font-extrabold leading-snug text-slate-900 group-hover:text-red-700 transition">
                        {{ $item->title }}
                    </h3>

                    {{-- SUBTÍTULO / LINHA FINA --}}
                    @if($item->excerpt)
                        <p class="text-slate-600 leading-relaxed line-clamp-2">
                            {{ $item->excerpt }}
                        </p>
                    @endif

                    {{-- META --}}
                    <div class="text-sm text-slate-500">
                        {{ $item->published_at?->diffForHumans() }}
                        <span class="mx-1">•</span>
                        CEEP Assaí
                    </div>
                </div>

            </a>
        </article>
    @endforeach
</div>


            <div class="mt-10 text-center md:hidden">
                <a href="{{ route('portal.news.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
                    Ver todas as notícias
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>
    @endif

</main>
<script>
function copyNewsLink() {
    const url = "{{ request()->url() }}";

    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(showCopyFeedback);
    } else {
        // Fallback antigo
        const input = document.createElement("input");
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand("copy");
        document.body.removeChild(input);
        showCopyFeedback();
    }
}

function showCopyFeedback() {
    const el = document.getElementById("copyFeedback");
    el.classList.remove("hidden");

    setTimeout(() => {
        el.classList.add("hidden");
    }, 2000);
}
</script>


@include('layouts.footer')
