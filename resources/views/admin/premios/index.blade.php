@include('layouts.header', ['title' => 'Prêmios e Reconhecimentos'])

<main class="max-w-7xl mx-auto px-6 py-12">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-black text-red-800">
            Prêmios e Reconhecimentos
        </h1>

        <a href="{{ route('admin.premios.create') }}"
           class="px-5 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
            + Novo Prêmio
        </a>
    </div>

    <!-- FLASH -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- LISTA -->
    @if($premios->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($premios as $premio)
                <div class="bg-white rounded-2xl shadow border overflow-hidden flex flex-col">

                    {{-- IMAGEM --}}
                    @if($premio->imagem)
                        <img src="{{ asset('storage/'.$premio->imagem) }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                            Sem imagem
                        </div>
                    @endif

                    <div class="p-6 flex-1 flex flex-col">

                        {{-- TOPO --}}
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-red-700">
                                {{ $premio->ano ?? '—' }}
                            </span>

                            {{-- STATUS --}}
                            @if($premio->ativo)
                                <span class="text-xs font-bold px-2 py-1 rounded bg-green-100 text-green-700">
                                    Ativo
                                </span>
                            @else
                                <span class="text-xs font-bold px-2 py-1 rounded bg-slate-200 text-slate-600">
                                    Inativo
                                </span>
                            @endif
                        </div>

                        {{-- TÍTULO --}}
                        <h3 class="mt-1 font-black text-lg text-slate-900">
                            {{ $premio->titulo }}
                        </h3>

                        {{-- DESCRIÇÃO --}}
                        <p class="mt-3 text-sm text-slate-600 line-clamp-3">
                            {{ $premio->descricao }}
                        </p>

                        {{-- PARTICIPANTES --}}
                        <div class="mt-4 text-sm text-slate-500">
                            👥 {{ $premio->alunos->count() }} aluno(s) participante(s)
                        </div>

                        {{-- AÇÕES --}}
                        <div class="mt-auto pt-6 flex gap-3 justify-end">

                            {{-- VER (PÚBLICO) --}}
                            <a href="{{ route('portal.premios.show', $premio) }}"
                               target="_blank"
                               class="px-4 py-2 text-sm font-bold rounded-lg border border-slate-300
                                      text-slate-700 hover:bg-slate-100 transition">
                                Ver
                            </a>

                            {{-- EDITAR --}}
                            <a href="{{ route('admin.premios.edit', $premio) }}"
                               class="px-4 py-2 text-sm font-bold rounded-lg
                                      bg-red-700 text-white hover:bg-red-800 transition">
                                Editar
                            </a>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="text-center py-20 text-slate-500">
            Nenhum prêmio cadastrado ainda.
        </div>
    @endif

</main>

@include('layouts.footer')
