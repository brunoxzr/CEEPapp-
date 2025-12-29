@include('layouts.admin_nav', ['title' => 'Meu Cronograma'])
@include('layouts.sidebar')

<section class="max-w-5xl mx-auto px-4 mt-8">

  <h1 class="text-3xl font-black text-red-800 mb-6">
    📘 Suas aulas de hoje ({{ $diaHoje }})
  </h1>

  @if($aulasHoje->isEmpty())
    <div class="bg-white rounded-xl p-6 border text-center text-slate-500">
      Nenhuma aula programada para hoje.
    </div>
  @else
    <div class="space-y-4">
      @foreach($aulasHoje as $aula)
        <div class="bg-white border rounded-xl p-4 flex justify-between items-center shadow-sm">

          <div>
            <p class="font-black text-red-800">{{ $aula->disciplina }}</p>
            <p class="text-slate-600 text-sm">Turma: {{ $aula->turma }}</p>
          </div>

          <div class="text-right font-mono text-red-700 font-bold">
            {{ \Carbon\Carbon::parse($aula->inicio)->format('H:i') }}<br>
            {{ \Carbon\Carbon::parse($aula->fim)->format('H:i') }}
          </div>

        </div>
      @endforeach
    </div>
  @endif

</section>

@include('layouts.footer')
