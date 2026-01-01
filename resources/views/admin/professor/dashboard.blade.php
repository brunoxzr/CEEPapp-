@include('layouts.admin_nav', ['title' => 'Dashboard do Professor'])
<section class="max-w-6xl mx-auto px-4 mt-8 space-y-8">

  {{-- HEADER --}}
  <div>
    <h1 class="text-3xl font-black text-red-800">
      👨‍🏫 Olá, {{ $admin->nome }}
    </h1>
    <p class="text-slate-600 mt-1">
      Aqui estão suas aulas e seus projetos técnicos.
    </p>
  </div>

  {{-- AÇÕES PRINCIPAIS --}}
  <div class="grid sm:grid-cols-2 gap-6">

    {{-- MEUS PROJETOS --}}
    <a href="{{ route('professor.projetos.index') }}"
       class="bg-white border rounded-2xl p-6 shadow hover:shadow-lg transition group">

      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">
            Projetos
          </p>
          <h2 class="text-xl font-black text-red-800 mt-1">
            📁 Meus Projetos Técnicos
          </h2>
          <p class="text-sm text-slate-600 mt-1">
            Gerencie e publique projetos com seus alunos.
          </p>
        </div>
        <span class="text-3xl group-hover:scale-110 transition">🚀</span>
      </div>
    </a>

    {{-- CRIAR PROJETO --}}
    <a href="{{ route('professor.projetos.create') }}"
       class="bg-red-700 text-white rounded-2xl p-6 shadow hover:bg-red-800 transition">

      <p class="text-xs font-bold uppercase tracking-widest text-red-100">
        Novo
      </p>
      <h2 class="text-xl font-black mt-1">
        ➕ Criar Projeto Técnico
      </h2>
      <p class="text-sm text-red-100 mt-1">
        Cadastre um novo projeto para os alunos participarem.
      </p>
    </a>

  </div>

  {{-- AULAS DO DIA --}}
  <div>
    <h2 class="text-2xl font-black text-red-800 mb-4">
      📘 Suas aulas de hoje ({{ $diaHoje ?? '—' }})
    </h2>

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
              <p class="text-slate-600 text-sm">
                Turma: <strong>{{ $aula->turma }}</strong>
              </p>
            </div>

            <div class="text-right font-mono text-red-700 font-bold">
              {{ \Carbon\Carbon::parse($aula->inicio)->format('H:i') }}<br>
              {{ \Carbon\Carbon::parse($aula->fim)->format('H:i') }}
            </div>

          </div>
        @endforeach
      </div>
    @endif
  </div>

</section>

@include('layouts.footer')
