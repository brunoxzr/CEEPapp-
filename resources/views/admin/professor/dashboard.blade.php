@include('layouts.admin_professor')


<section class="max-w-6xl mx-auto px-4 mt-10 space-y-10">

  {{-- HEADER --}}
  <header>
    <h1 class="text-3xl font-black text-red-800">
      Olá, {{ $admin->nome }}
    </h1>
    <p class="text-slate-600 mt-1">
      Gerencie suas aulas, atividades e projetos com praticidade.
    </p>
  </header>

  {{-- AÇÕES PRINCIPAIS --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- ATIVIDADES --}}
    <a href="{{ route('professor.atividades.index') }}"
       class="bg-white border rounded-2xl p-6 shadow hover:shadow-lg transition group">

      <div class="flex items-center justify-between gap-4">
        <div>
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">
            Atividades
          </p>
          <h2 class="text-xl font-black text-red-800 mt-1">
            Gestão de Atividades
          </h2>
          <p class="text-sm text-slate-600 mt-1">
            Marque entregas, notas e observações por aluno.
          </p>
        </div>

        {{-- SVG Clipboard --}}
        <svg class="w-10 h-10 text-red-700 group-hover:scale-110 transition"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
      </div>
    </a>

    {{-- MEUS PROJETOS --}}
    <a href="{{ route('professor.projetos.index') }}"
       class="bg-white border rounded-2xl p-6 shadow hover:shadow-lg transition group">

      <div class="flex items-center justify-between gap-4">
        <div>
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">
            Projetos
          </p>
          <h2 class="text-xl font-black text-red-800 mt-1">
            Projetos Técnicos
          </h2>
          <p class="text-sm text-slate-600 mt-1">
            Acompanhe projetos desenvolvidos com as turmas.
          </p>
        </div>

        {{-- SVG Folder --}}
        <svg class="w-10 h-10 text-red-700 group-hover:scale-110 transition"
             fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
        </svg>
      </div>
    </a>

    {{-- CRIAR PROJETO --}}
    <a href="{{ route('professor.projetos.create') }}"
       class="bg-red-700 text-white rounded-2xl p-6 shadow hover:bg-red-800 transition">

      <p class="text-xs font-bold uppercase tracking-widest text-red-100">
        Novo
      </p>
      <h2 class="text-xl font-black mt-1">
        Criar Projeto Técnico
      </h2>
      <p class="text-sm text-red-100 mt-1">
        Cadastre um novo projeto para suas turmas.
      </p>
    </a>

  </div>

  {{-- AULAS DO DIA --}}
  <section>
    <h2 class="text-2xl font-black text-red-800 mb-4">
      Aulas de hoje — {{ $diaHoje ?? '—' }}
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
              <p class="font-black text-red-800">
                {{ $aula->disciplina }}
              </p>
              <p class="text-slate-600 text-sm">
                Turma: <strong>{{ $aula->turma }}</strong>
              </p>
            </div>

            <div class="text-right font-mono text-red-700 font-bold leading-tight">
              {{ \Carbon\Carbon::parse($aula->inicio)->format('H:i') }}<br>
              {{ \Carbon\Carbon::parse($aula->fim)->format('H:i') }}
            </div>

          </div>
        @endforeach
      </div>
    @endif
  </section>

</section>

@include('layouts.footer')
