@include('layouts.header', ['title' => $projeto->titulo])

<main class="bg-slate-50">
<section class="max-w-5xl mx-auto px-6 py-16">

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

    {{-- CONTRIBUIÇÕES --}}
    <div class="mt-10 border-t pt-10">
        <h2 class="text-xl font-black text-red-800 mb-6">
            Alunos que participaram
        </h2>

        @if($projeto->contribuicoes->isEmpty())
            <p class="text-slate-500">Nenhuma contribuição registrada ainda.</p>
        @else
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach($projeto->contribuicoes as $c)
                    <div class="border rounded-xl p-5 bg-white shadow-sm hover:shadow transition">
                        <p class="font-bold text-slate-900">{{ $c->aluno->nome }}</p>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">{{ $c->descricao }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</section>
</main>

@include('layouts.footer')
