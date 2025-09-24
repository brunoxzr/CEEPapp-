<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.header', ['title' => 'Painel do Aluno'])

<section class="max-w-6xl mx-auto px-4 mt-8">
  <div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2">
      <div class="bg-white rounded-xl shadow-soft p-6">
        <h2 class="text-xl font-bold">Olá, {{ $aluno->nome }}</h2>
        <p class="text-sm text-slate-600">Turma: <strong>{{ $aluno->turma ?? '—' }}</strong> • Escola: <strong>{{ $aluno->escola }}</strong></p>

        <div class="mt-6">
          <h3 class="font-semibold mb-3">Últimas Notas</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
              <thead>
                <tr class="bg-slate-100 text-slate-700">
                  <th class="py-2 px-3 text-left">Disciplina</th>
                  <th class="py-2 px-3 text-left">Nota</th>
                  <th class="py-2 px-3 text-left">Tipo</th>
                  <th class="py-2 px-3 text-left">Ano</th>
                </tr>
              </thead>
              <tbody>
                @forelse($boletins as $b)
                <tr class="border-b hover:bg-slate-50">
                  <td class="py-2 px-3">{{ $b->disciplina }}</td>
                  <td class="py-2 px-3 font-semibold">{{ number_format($b->nota,2,',','.') }}</td>
                  <td class="py-2 px-3">{{ $b->tipo }}</td>
                  <td class="py-2 px-3">{{ $b->ano }}</td>
                </tr>
                @empty
                <tr>
                  <td class="py-3 px-3 text-slate-500" colspan="4">Nenhuma nota recente.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-4">
            <a href="{{ route('aluno.boletim') }}" class="inline-block px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Ver boletim completo</a>
          </div>
        </div>
      </div>
    </div>

    <aside>
      <div class="bg-white rounded-xl shadow-soft p-6">
        <h3 class="font-semibold mb-3">Cronograma de Hoje</h3>
        <ul class="space-y-2 text-sm">
          @forelse($cronograma as $c)
          <li class="p-3 rounded border flex items-center justify-between">
            <div>
              <p class="font-semibold">{{ $c->disciplina }}</p>
              <p class="text-slate-600">{{ $c->professor }} — Sala {{ $c->sala ?? '—' }}</p>
            </div>
            <div class="text-right">
              <p class="font-mono">{{ \Carbon\Carbon::parse($c->inicio)->format('H:i') }}–{{ \Carbon\Carbon::parse($c->fim)->format('H:i') }}</p>
            </div>
          </li>
          @empty
          <li class="text-slate-500">Sem aulas registradas hoje para sua turma.</li>
          @endforelse
        </ul>
      </div>
    </aside>
  </div>

  <div class="mt-8 grid md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-soft p-6">
      <h4 class="font-semibold">Dica rápida</h4>
      <p class="text-sm text-slate-600">Mantenha seu e-mail atualizado na secretaria para receber avisos.</p>
    </div>
    <div class="bg-white rounded-xl shadow-soft p-6">
      <h4 class="font-semibold">SAEB</h4>
      <p class="text-sm text-slate-600">Resultados SAEB aparecerão aqui quando publicados pela escola.</p>
    </div>
    <div class="bg-white rounded-xl shadow-soft p-6">
      <h4 class="font-semibold">Atalhos</h4>
      <ul class="text-sm list-disc ml-5">
        <li><a class="hover:underline" href="{{ route('aluno.boletim') }}">Boletim</a></li>
        <li>Horários</li>
        <li>Comunicados</li>
      </ul>
    </div>
  </div>
</section>

@include('layouts.footer')
