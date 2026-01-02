@include('layouts.header', ['title' => 'Notícias — CEEP Assaí'])
@push('preload-images')
    @if($news->count())
        @php $featured = $news->first(); @endphp
        @if($featured->cover_path)
            <link rel="preload" as="image" href="{{ asset('storage/'.$featured->cover_path) }}">
        @endif
    @endif
@endpush
<style>
    /* =========================
   FEED DE NOTÍCIAS — PADRÃO G1
   ========================= */

.g1-feed {
    max-width: 100%;
}

/* ITEM */
.g1-item {
    padding-bottom: 2.5rem;
    border-bottom: 1px solid #e5e7eb;
}

/* THUMB */
.g1-thumb {
    width: 100%;
    max-width: 280px;
    height: 170px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 6px;
    background: #e5e7eb;
}

.g1-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.g1-thumb-fallback {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #991b1b, #7f1d1d);
    color: white;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
}

/* TEXTO */
.g1-content {
    flex: 1;
}

/* CHAPÉU */
.g1-chapeu {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #b91c1c;
    display: inline-block;
    margin-bottom: 0.35rem;
}

/* TÍTULO */
.g1-title {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 1.4rem;
    line-height: 1.25;
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.5rem;
    transition: color .2s ease;
}

.g1-item a:hover .g1-title {
    color: #b91c1c;
}

/* RESUMO */
.g1-excerpt {
    font-size: 0.95rem;
    line-height: 1.55;
    color: #4b5563;
    margin-bottom: 0.5rem;
}

/* META */
.g1-meta {
    font-size: 0.8rem;
    color: #6b7280;
}

/* MOBILE */
@media (max-width: 768px) {
    .g1-thumb {
        max-width: 100%;
        height: 200px;
    }

    .g1-title {
        font-size: 1.15rem;
    }
}

</style>
<main class="bg-white text-slate-800">

<!-- ================= HERO NOTÍCIA DESTAQUE ================= -->
@if($news->count() > 0 && !($search ?? null))
@php $featured = $news->first(); @endphp

<section class="border-b bg-white">
    <div class="max-w-7xl mx-auto px-6 py-16">

        <a href="{{ route('portal.news.show', $featured->slug) }}"
           class="grid lg:grid-cols-2 gap-12 items-center group">

            <!-- TEXTO -->
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-red-700 mb-4 inline-block">
                    Destaque
                </span>

                <h1 class="text-3xl md:text-4xl font-black leading-tight group-hover:text-red-700 transition mb-4">
                    {{ $featured->title }}
                </h1>

                @if($featured->excerpt)
                <p class="text-slate-600 text-lg leading-relaxed line-clamp-3 mb-4">
                    {{ $featured->excerpt }}
                </p>
                @endif

                <div class="flex items-center gap-4 text-sm text-slate-500">
                    <span>{{ $featured->published_at?->format('d/m/Y') }}</span>
                    @if($featured->author)
                    <span>•</span>
                    <span>{{ $featured->author }}</span>
                    @endif
                </div>
            </div>

            <!-- IMAGEM -->
            <div class="aspect-[16/9] overflow-hidden rounded-xl bg-slate-200 shadow-lg">
                @if($featured->cover_path)
                <img
                    src="{{ asset('storage/'.$featured->cover_path) }}"
                    alt="{{ $featured->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-red-800 to-red-900 flex items-center justify-center">
                    <span class="text-white font-bold">CEEP Assaí</span>
                </div>
                @endif
            </div>

        </a>

    </div>
</section>
@endif

<!-- ================= PESQUISA ================= -->
<section class="py-12 bg-white border-b">
    <div class="max-w-7xl mx-auto px-6">
        <form method="GET" action="{{ route('portal.news.index') }}" class="max-w-2xl mx-auto">
            <div class="relative">
                <input type="text"
                       name="q"
                       value="{{ $search ?? '' }}"
                       placeholder="Pesquisar notícias..."
                       class="w-full rounded-xl border-2 border-slate-300 bg-white text-slate-900 px-6 py-4 pl-14 pr-14 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition text-lg">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                @if($search ?? null)
                <a href="{{ route('portal.news.index') }}"
                   class="absolute right-4 top-1/2 -translate-y-1/2 p-2 rounded-lg hover:bg-slate-100 transition"
                   title="Limpar pesquisa">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
            @if($search ?? null)
            <div class="mt-4 text-center">
                <p class="text-sm text-slate-600">
                    <strong>{{ $news->total() }}</strong> resultado{{ $news->total() !== 1 ? 's' : '' }} encontrado{{ $news->total() !== 1 ? 's' : '' }} para "<strong>{{ $search }}</strong>"
                </p>
            </div>
            @endif
        </form>
    </div>
</section>

<!-- ================= GRID DE NOTÍCIAS ================= -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">

        @if($news->count() === 0)
        <div class="text-center py-20">
            <svg class="w-24 h-24 mx-auto mb-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">Nenhuma notícia encontrada</h3>
            <p class="text-slate-600 mb-6">
                @if($search ?? null)
                    Tente pesquisar com outros termos.
                @else
                    Ainda não há notícias publicadas.
                @endif
            </p>
            @if($search ?? null)
            <a href="{{ route('portal.news.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md">
                Ver todas as notícias
            </a>
            @endif
        </div>
        @else
<div class="g1-feed space-y-12">

    @foreach($search ? $news : $news->skip(1) as $item)
        <article class="g1-item">
            <a href="{{ route('portal.news.show', $item->slug) }}"
               class="flex flex-col md:flex-row gap-6 group">

                {{-- IMAGEM --}}
                <div class="g1-thumb">
                    @if($item->cover_path)
                        <img
                            src="{{ asset('storage/'.$item->cover_path) }}"
                            alt="{{ $item->title }}">
                    @else
                        <div class="g1-thumb-fallback">
                            CEEP Assaí
                        </div>
                    @endif
                </div>

                {{-- TEXTO --}}
                <div class="g1-content">
                    <span class="g1-chapeu">Notícia</span>

                    <h2 class="g1-title">
                        {{ $item->title }}
                    </h2>

                    @if($item->excerpt)
                        <p class="g1-excerpt">
                            {{ $item->excerpt }}
                        </p>
                    @endif

                    <div class="g1-meta">
                        {{ $item->published_at?->diffForHumans() }} • CEEP Assaí
                    </div>
                </div>

            </a>
        </article>
    @endforeach

</div>
<div class="g1-feed space-y-12">

    @foreach($search ? $news : $news->skip(1) as $item)
        <article class="g1-item">
            <a href="{{ route('portal.news.show', $item->slug) }}"
               class="flex flex-col md:flex-row gap-6 group">

                {{-- IMAGEM --}}
                <div class="g1-thumb">
                    @if($item->cover_path)
                        <img
                            src="{{ asset('storage/'.$item->cover_path) }}"
                            alt="{{ $item->title }}">
                    @else
                        <div class="g1-thumb-fallback">
                            CEEP Assaí
                        </div>
                    @endif
                </div>

                {{-- TEXTO --}}
                <div class="g1-content">
                    <span class="g1-chapeu">Notícia</span>

                    <h2 class="g1-title">
                        {{ $item->title }}
                    </h2>

                    @if($item->excerpt)
                        <p class="g1-excerpt">
                            {{ $item->excerpt }}
                        </p>
                    @endif

                    <div class="g1-meta">
                        {{ $item->published_at?->diffForHumans() }} • CEEP Assaí
                    </div>
                </div>

            </a>
        </article>
    @endforeach

</div>


        <!-- PAGINAÇÃO -->
        @if($news->hasPages())
        <div class="mt-16 flex justify-center">
            {{ $news->links() }}
        </div>
        @endif

        @endif

    </div>
</section>

</main>

@include('layouts.footer')
