@include('layouts.header', ['title' => 'Notícias — CEEP Assaí'])

<section class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-14">
        <h1 class="text-3xl font-black text-red-900 mb-2">Notícias</h1>
        <p class="text-slate-600">
            Acompanhe as notícias e comunicados do CEEP Assaí.
        </p>
    </div>
</section>

<section class="bg-slate-50 py-16">
    <div class="max-w-6xl mx-auto px-4">

        <!-- BUSCA -->
        <form method="GET" class="mb-10">
            <div class="flex gap-3 max-w-md">
                <input
                    type="text"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Pesquisar notícias..."
                    class="w-full rounded-md border border-slate-300 px-4 py-2 focus:ring-red-500 focus:border-red-500"
                >
                <button
                    class="px-5 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 transition">
                    Buscar
                </button>
            </div>
        </form>

        <!-- LISTA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($news as $item)
                <article class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition">
                    <div class="aspect-[16/9] bg-slate-200">
                        @if($item->cover_path)
                            <img src="{{ asset('storage/'.$item->cover_path) }}"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="p-6">
                        <p class="text-xs text-slate-500 font-semibold">
                            {{ $item->published_at->format('d/m/Y') }}
                        </p>

                        <h2 class="text-lg font-bold mt-2">
                            {{ $item->title }}
                        </h2>

                        <p class="text-sm text-slate-600 mt-3 line-clamp-3">
                            {{ $item->excerpt }}
                        </p>

                        <a href="{{ route('portal.news.show', $item->slug) }}"
                           class="inline-block mt-4 text-sm font-semibold text-red-700">
                            Ler notícia →
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-slate-500">Nenhuma notícia encontrada.</p>
            @endforelse
        </div>

        <!-- PAGINAÇÃO -->
        <div class="mt-12">
            {{ $news->links() }}
        </div>

    </div>
</section>

@include('layouts.footer')
