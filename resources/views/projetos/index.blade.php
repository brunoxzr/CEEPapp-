@include('layouts.header', ['title' => 'Projetos Técnicos'])

<main class="bg-slate-50">
<section class="max-w-7xl mx-auto px-6 py-16">

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-black text-red-800 mb-4">
            Projetos Técnicos
        </h1>
        <p class="text-slate-700 leading-relaxed max-w-3xl">
            Conheça os projetos desenvolvidos pelos alunos do CEEP Assaí em cada curso técnico.
        </p>
    </div>



    {{-- GRID --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projetos as $p)
            <a href="{{ route('projetos.show', $p->id) }}"
               class="group bg-white rounded-xl border shadow hover:shadow-xl transition overflow-hidden">

                @if($p->capa)
                    <img src="{{ asset('storage/'.$p->capa) }}"
                         class="h-44 w-full object-cover">
                @endif

                <div class="p-5">
                    <h2 class="font-black text-lg text-red-800 group-hover:underline">
                        {{ $p->titulo }}
                    </h2>

                    <p class="text-sm text-slate-600 mt-2 line-clamp-3">
                        {{ $p->descricao }}
                    </p>

                    <div class="mt-4 flex justify-between items-center text-xs">
                        <span class="px-2 py-1 rounded bg-red-50 text-red-700 font-bold">
                            {{ $p->curso }}
                        </span>

                        <span class="text-slate-500">
                            Prof. {{ $p->professor->nome }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-slate-500 text-lg">Nenhum projeto publicado ainda.</p>
            </div>
        @endforelse
    </div>

</section>
</main>

@include('layouts.footer')
