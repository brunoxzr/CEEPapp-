@include('layouts.header', ['title' => $projeto->titulo])

<section class="max-w-5xl mx-auto px-4 mt-10">

    <a href="{{ route('projetos.index') }}"
       class="text-sm font-bold text-red-700 hover:underline">
        ← Voltar aos projetos
    </a>

    <h1 class="text-3xl font-black text-red-800 mt-4">
        {{ $projeto->titulo }}
    </h1>

    <p class="text-slate-600 mt-2">
        Curso: <strong>{{ $projeto->curso }}</strong> ·
        Professor: <strong>{{ $projeto->professor->nome }}</strong>
    </p>

    @if($projeto->capa)
        <img src="{{ asset('storage/'.$projeto->capa) }}"
             class="w-full rounded-xl mt-6 shadow">
    @endif

    <div class="prose max-w-none mt-6">
        {!! nl2br(e($projeto->descricao)) !!}
    </div>

    {{-- CONTRIBUIÇÕES (vai ganhar poder no passo 3) --}}
    <div class="mt-10">
        <h2 class="text-xl font-black text-red-800 mb-4">
            👥 Alunos que participaram
        </h2>

        @if($projeto->contribuicoes->isEmpty())
            <p class="text-slate-500">Contribuições em breve.</p>
        @else
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach($projeto->contribuicoes as $c)
                    <div class="border rounded-xl p-4 bg-white shadow">
                        <p class="font-black">{{ $c->aluno->nome }}</p>
                        <p class="text-sm text-slate-600">{{ $c->descricao }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</section>

@include('layouts.footer')
