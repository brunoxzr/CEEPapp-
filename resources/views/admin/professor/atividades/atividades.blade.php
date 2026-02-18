@extends('layouts.admin_professor')

@section('content')
<section class="max-w-7xl mx-auto px-6 mt-10 space-y-8">

  {{-- ================= HEADER PREMIUM ================= --}}
  <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

    <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">

      <div>
        <h1 class="text-3xl font-black">
          Atividades
        </h1>

        <p class="mt-2 text-white/90 text-sm">
          Disciplina:
          <span class="text-yellow-300 font-semibold text-base">
            {{ $disciplina->nome }}
          </span>
        </p>

        <p class="text-sm text-white/80 mt-1">
          Turmas:
          <span class="font-semibold">
            {{ $turmas->implode(', ') }}
          </span>
        </p>
      </div>

      <div>
        <a href="{{ route('professor.atividades.create', $disciplina->id) }}"
           class="px-6 py-3 bg-yellow-400 text-red-900 font-bold rounded-lg hover:bg-yellow-300 transition shadow-lg">
          + Nova atividade
        </a>
      </div>

    </div>

  </div>


  {{-- ================= FLASH ================= --}}
  @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl shadow-sm">
      {{ session('success') }}
    </div>
  @endif


  {{-- ================= LISTA ================= --}}
  @if($atividades->isEmpty())

    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-6 rounded-xl shadow-sm text-center">
      Nenhuma atividade cadastrada para esta disciplina.
    </div>

  @else

    <div class="grid gap-6">

      @foreach($atividades as $atividade)

        <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 hover:shadow-lg transition duration-200">

          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            {{-- INFORMAÇÕES --}}
            <div class="space-y-2">

              <h3 class="text-xl font-bold text-slate-800">
                {{ $atividade->titulo }}
              </h3>

              <div class="flex flex-wrap items-center gap-3 text-sm">

                <span class="px-3 py-1 rounded-full bg-red-50 text-red-700 font-semibold">
                  Turma: {{ $atividade->turma }}
                </span>

                @if($atividade->data_limite)
                  <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 font-semibold">
                    Entrega: {{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y') }}
                  </span>
                @endif

              </div>

            </div>

            {{-- BOTÕES --}}
            <div class="flex gap-3">

              <a href="{{ route('professor.atividades.lancar', $atividade) }}"
                 class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">
                Lançar
              </a>

              <a href="{{ route('professor.atividades.edit', [
                  'disciplina' => $atividade->disciplina_id,
                  'atividade'  => $atividade->id
              ]) }}"
                 class="px-5 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition font-semibold shadow-sm">
                Editar
              </a>

            </div>

          </div>

        </div>

      @endforeach

    </div>

  @endif

</section>
@endsection
