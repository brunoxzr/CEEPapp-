@include('layouts.header', ['title' => 'Notícias — CEEP Assaí'])

<main class="bg-white text-slate-800">

<!-- ================= HERO NOTÍCIA ================= -->
@if($news->count())
@php $featured = $news->first(); @endphp

<section class="border-b">
    <div class="max-w-7xl mx-auto px-6 py-16">

        <a href="{{ route('portal.news.show', $featured->slug) }}"
           class="grid lg:grid-cols-2 gap-12 items-center group">

            <!-- TEXTO -->
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-red-700">
                    Destaque
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-black leading-tight group-hover:text-red-700 transition">
                    {{ $featured->title }}
                </h1>

                <p class="mt-4 text-slate-600 text-lg leading-relaxed line-clamp-3">
                    {{ $featured->excerpt }}
                </p>

                <p class="mt-4 text-xs text-slate-500">
                    {{ $featured->published_at?->format('d/m/Y') }}
                </p>
            </div>

            <!-- IMAGEM -->
            <div class="aspect-[16/9] overflow-hidden rounded-xl bg-slate-200">
                <img
                    src="{{ asset('storage/'.$featured->cover_path) }}"
                    alt="{{ $featured->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>

        </a>

    </div>
</section>
@endif

<!-- ================= GRID DE NOTÍCIAS ================= -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($news->skip(1) as $item)
                <article class="bg-white border rounded-xl overflow-hidden hover:shadow-xl transition">

                    <!-- IMAGEM -->
                    <div class="aspect-[16/9] bg-slate-200 overflow-hidden">
                        <img
                            src="{{ asset('storage/'.$item->cover_path) }}"
                            alt="{{ $item->title }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- TEXTO -->
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-2">
                            {{ $item->published_at?->format('d/m/Y') }}
                        </p>

                        <h2 class="font-bold text-lg leading-snug hover:text-red-700 transition">
                            <a href="{{ route('portal.news.show', $item->slug) }}">
                                {{ $item->title }}
                            </a>
                        </h2>

                        <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
                            {{ $item->excerpt }}
                        </p>
                    </div>

                </article>
            @endforeach

        </div>

        <!-- PAGINAÇÃO -->
        <div class="mt-20 flex justify-center">
            {{ $news->links() }}
        </div>

    </div>
</section>

</main>

@include('layouts.footer')
