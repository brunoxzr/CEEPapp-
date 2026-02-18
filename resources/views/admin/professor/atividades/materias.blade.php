@extends('layouts.admin_professor')

@section('title', 'Minhas Matérias')

@section('content')
<section class="max-w-7xl mx-auto px-6 mt-10 space-y-8">

  {{-- ================= HEADER PREMIUM ================= --}}
  <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

    <div class="relative">
      <h1 class="text-3xl font-black">
        Minhas Matérias
      </h1>

      <p class="mt-2 text-white/90 text-sm">
        Selecione a disciplina para acessar as atividades.
      </p>
    </div>

  </div>


  {{-- ================= LISTA ================= --}}
  @if($vinculos->isEmpty())

    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-6 rounded-xl shadow-sm text-center">
      Nenhuma matéria encontrada no cronograma.
    </div>

  @else

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

      @foreach($vinculos as $v)

        <a
          href="{{ route('professor.atividades.disciplina', [
            'disciplina' => \App\Models\Disciplina::where('nome', $v->disciplina)->value('id')
          ]) }}"
          class="group bg-white border border-slate-200 rounded-2xl p-6 shadow-md hover:shadow-xl transition duration-200 hover:-translate-y-1"
        >

          <div class="flex items-center justify-between mb-4">

            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-700 font-black text-lg">
              📘
            </div>

            <span class="text-xs px-3 py-1 rounded-full bg-red-50 text-red-700 font-semibold">
              {{ $v->turma }}
            </span>

          </div>

          <h2 class="text-xl font-black text-slate-800 group-hover:text-red-700 transition">
            {{ $v->disciplina }}
          </h2>

          <p class="text-sm text-slate-500 mt-2">
            Clique para visualizar as atividades
          </p>

        </a>

      @endforeach

    </div>

  @endif

</section>
@endsection
