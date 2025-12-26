@include('layouts.header', ['title' => 'Gerenciar Notícias'])

<main class="bg-slate-50 py-12">
<div class="max-w-6xl mx-auto px-6">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black text-red-800">
            Notícias
        </h1>

        <a href="{{ route('admin.news.create') }}"
           class="px-6 py-3 bg-red-700 text-white font-bold rounded hover:bg-red-800">
            ➕ Criar notícia
        </a>
    </div>

    <div class="bg-white rounded-xl shadow border overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3 text-left">Capa</th>
                    <th class="px-4 py-3 text-left">Título</th>
                    <th class="px-4 py-3 text-left">Data</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y">
            @forelse($news as $item)
                <tr>

                    <td class="px-4 py-3">
                        @if($item->cover_path)
                            <img src="{{ asset('storage/'.$item->cover_path) }}"
                                 class="w-24 h-14 object-contain bg-slate-100 border rounded">
                        @else
                            <span class="text-xs text-slate-400">—</span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        <strong>{{ $item->title }}</strong>
                        <div class="text-xs text-slate-500">
                            /noticias/{{ $item->slug }}
                        </div>
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ $item->published_at?->format('d/m/Y') ?? '—' }}
                    </td>

                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('portal.news.show', $item->slug) }}"
                           target="_blank"
                           class="px-3 py-1 border rounded text-xs">
                            Ver
                        </a>

                        <a href="{{ route('admin.news.edit', $item->id) }}"
                           class="px-3 py-1 bg-yellow-400 rounded text-xs font-bold">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('admin.news.destroy', $item->id) }}"
                              class="inline"
                              onsubmit="return confirm('Excluir notícia?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 bg-red-700 text-white rounded text-xs">
                                Excluir
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-10 text-slate-500">
                        Nenhuma notícia cadastrada
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $news->links() }}
    </div>

</div>
</main>

@include('layouts.footer')
