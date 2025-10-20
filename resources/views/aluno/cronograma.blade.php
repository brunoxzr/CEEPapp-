@include('layouts.header', ['title' => 'Cronograma Semanal'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <h1 class="text-2xl font-bold mb-6 text-slate-800">📅 Cronograma da Semana</h1>

  @if($cronograma->isEmpty())
    <div class="bg-white rounded-xl shadow-soft p-6 text-center text-slate-500">
      Nenhuma aula registrada nesta semana para sua turma.
    </div>
  @else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'] as $dia)
        <div class="bg-white rounded-xl shadow-soft p-5 border border-slate-100">
          <h2 class="text-lg font-bold text-slate-700 mb-3 border-b pb-2">{{ $dia }}-feira</h2>

          @php
            $aulasDia = $cronograma->where('dia_semana', $dia);
          @endphp

          @if($aulasDia->isEmpty())
            <p class="text-slate-500 text-sm">Sem aulas cadastradas.</p>
          @else
            <ul class="space-y-3 text-sm">
              @foreach($aulasDia->sortBy('inicio') as $a)
                <li class="p-3 rounded border border-slate-200 hover:bg-slate-50 transition flex justify-between items-center">
                  <div>
                    <p class="font-semibold text-slate-800">{{ $a->disciplina }}</p>
                    <p class="text-slate-600">{{ $a->professor }}</p>
                    <p class="text-slate-500">Sala: {{ $a->sala ?? '—' }}</p>
                  </div>
                  <div class="text-right">
                    <span class="font-mono text-slate-700">
                      {{ \Carbon\Carbon::parse($a->inicio)->format('H:i') }}–{{ \Carbon\Carbon::parse($a->fim)->format('H:i') }}
                    </span>
                  </div>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      @endforeach
    </div>
  @endif
</section>

<div class="max-w-6xl mx-auto mt-8 px-4">
  <a href="{{ route('aluno.dashboard') }}" class="inline-block px-4 py-2 rounded bg-slate-600 text-white hover:bg-slate-700">
    ← Voltar ao Painel
  </a>
</div>

@include('layouts.footer')
