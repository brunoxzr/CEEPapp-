@include('layouts.header', ['title' => $news->title])

<main class="bg-white">

    <!-- HERO / CAPA -->
    @if($news->cover_path)
    <section class="relative h-[65vh] min-h-[420px]">
        <img
            src="{{ asset('storage/'.$news->cover_path) }}"
            class="absolute inset-0 w-full h-full object-cover"
            alt="{{ $news->title }}"
        >
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative max-w-6xl mx-auto px-6 h-full flex items-end pb-12">
            <div>
                <p class="text-sm uppercase tracking-widest text-yellow-300 font-semibold mb-3">
                    Notícia
                </p>

                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight max-w-4xl">
                    {{ $news->title }}
                </h1>

                <p class="mt-4 text-sm text-slate-200">
                    Por <strong>{{ $news->author ?? 'CEEP Assaí' }}</strong>
                    • {{ $news->published_at?->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </section>
    @endif

    <!-- CONTEÚDO -->
    <section class="py-20">
        <div class="max-w-3xl mx-auto px-6">

            <!-- TEXTO -->
            <article
                class="prose prose-lg max-w-none prose-slate
                       prose-img:rounded-lg
                       prose-img:shadow
                       prose-img:mx-auto">

                {!! $news->content !!}
            </article>

            <!-- AUTOR -->
            <div class="mt-16 border-t pt-6 text-sm text-slate-600">
                <strong>Autor:</strong> {{ $news->author ?? 'CEEP Assaí' }}
            </div>

        </div>
    </section>

    <!-- NOTÍCIAS RELACIONADAS -->
    @if($recentNews->count())
    <section class="bg-slate-50 py-20 border-t">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="text-2xl font-black mb-10">
                Últimas notícias
            </h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentNews as $item)
                    <a href="{{ route('portal.news.show', $item->slug) }}"
                       class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition">

                        @if($item->cover_path)
                        <div class="aspect-[16/9] bg-slate-200">
                            <img
                                src="{{ asset('storage/'.$item->cover_path) }}"
                                class="w-full h-full object-cover"
                                alt="{{ $item->title }}"
                            >
                        </div>
                        @endif

                        <div class="p-5">
                            <p class="text-xs text-slate-500">
                                {{ $item->published_at?->format('d/m/Y') }}
                            </p>

                            <h3 class="font-bold mt-2 leading-snug">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
    @endif

</main>

@include('layouts.footer')
