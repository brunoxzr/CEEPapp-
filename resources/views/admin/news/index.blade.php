@include('layouts.header', ['title' => 'Gerenciar Notícias'])

<main class="bg-slate-50 py-12">
<div class="max-w-7xl mx-auto px-6">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-red-800 mb-2">
                Gerenciar Notícias
            </h1>
            <p class="text-slate-600">
                Crie, edite e gerencie as notícias do portal institucional.
            </p>
        </div>

        <a href="{{ route('admin.news.create') }}"
           class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 transition shadow-md flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Criar notícia
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-700 rounded-lg text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-red-50 text-red-800">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Capa</th>
                    <th class="px-6 py-4 text-left font-semibold">Título</th>
                    <th class="px-6 py-4 text-left font-semibold">Autor</th>
                    <th class="px-6 py-4 text-left font-semibold">Data</th>
                    <th class="px-6 py-4 text-right font-semibold">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
            @forelse($news as $item)
                <tr class="hover:bg-red-50/40 transition">

                    <td class="px-6 py-4">
                        @if($item->cover_path)
                            <img src="{{ asset('storage/'.$item->cover_path) }}"
                                 class="w-28 h-16 object-cover bg-slate-100 border rounded-lg">
                        @else
                            <div class="w-28 h-16 bg-slate-100 border rounded-lg flex items-center justify-center">
                                <span class="text-xs text-slate-400">Sem capa</span>
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <strong class="text-slate-900 block mb-1">{{ $item->title }}</strong>
                        <div class="text-xs text-slate-500 font-mono">
                            /noticias/{{ $item->slug }}
                        </div>
                    </td>

                    <td class="px-6 py-4 text-slate-700">
                        {{ $item->author ?? 'CEEP Assaí' }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $item->published_at?->format('d/m/Y') ?? '—' }}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('portal.news.show', $item->slug) }}"
                               target="_blank"
                               class="px-3 py-1.5 border border-slate-300 rounded-lg text-xs font-semibold hover:bg-slate-50 transition"
                               title="Ver no site">
                                Ver
                            </a>

                            <a href="{{ route('admin.news.edit', $item->id) }}"
                               class="px-3 py-1.5 bg-yellow-400 text-yellow-900 rounded-lg text-xs font-bold hover:bg-yellow-300 transition">
                                Editar
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.news.destroy', $item->id) }}"
                                  class="inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta notícia?')">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1.5 bg-red-700 text-white rounded-lg text-xs font-bold hover:bg-red-800 transition">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-16 text-slate-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <p class="text-lg font-semibold mb-1">Nenhuma notícia cadastrada</p>
                        <p class="text-sm">Comece criando sua primeira notícia</p>
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    @if($news->hasPages())
    <div class="mt-8">
        {{ $news->links() }}
    </div>
    @endif

</div>
</main>

@include('layouts.footer')
