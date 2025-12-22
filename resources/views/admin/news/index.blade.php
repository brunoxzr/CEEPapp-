@include('layouts.header', ['title' => 'Gerenciar Notícias'])

<section class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">Notícias</h1>
        <a href="{{ route('admin.news.create') }}"
           class="px-4 py-2 bg-red-700 text-white rounded">
            Nova Notícia
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-3 text-left">Título</th>
                <th class="p-3">Data</th>
                <th class="p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->title }}</td>
                    <td class="p-3 text-center">
                        {{ $item->published_at?->format('d/m/Y') }}
                    </td>
                    <td class="p-3 text-center">
                        {{ $item->is_active ? 'Publicado' : 'Rascunho' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@include('layouts.footer')
