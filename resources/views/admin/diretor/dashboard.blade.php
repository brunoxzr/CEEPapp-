@include('layouts.admin_nav', ['title' => 'Diretor — Painel Master'])

<div class="flex min-h-screen">
  @include('layouts.sidebar')
  <main class="flex-1 bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
        <div>
          <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Painel Master</p>
          <h1 class="text-3xl font-black text-red-800 mt-2">Diretor — Dashboard Completo</h1>
          <p class="text-slate-600 mt-2 max-w-2xl">Acesso total a todos os módulos e informações do sistema.</p>
        </div>
        <div class="bg-white border rounded-2xl px-5 py-4 shadow-sm">
          <p class="text-sm text-slate-500">Logado como</p>
          <p class="font-bold text-slate-900">{{ $admin->nome }}</p>
          <p class="text-xs text-slate-500">{{ $admin->email }}</p>
        </div>
      </div>

      <!-- Cards principais -->
      <div class="grid md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Alunos</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totAlunos }}</p>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Boletins</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totBoletins ?? '-' }}</p>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Aulas hoje</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $hoje ?? '-' }}</p>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Notícias</p>
          <p class="text-3xl font-black text-slate-900 mt-2">{{ $totNoticias }}</p>
        </div>
      </div>

      <!-- Gráficos -->
      <div class="grid md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900 mb-4">Alunos por turma</h2>
          <canvas id="chartAlunosTurma"></canvas>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900 mb-4">Boletins por ano</h2>
          <canvas id="chartBoletinsAno"></canvas>
        </div>
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900 mb-4">Notícias por mês</h2>
          <canvas id="chartNoticiasMes"></canvas>
        </div>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Atalhos -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900">Atalhos</h2>
          <p class="text-sm text-slate-600 mt-2">Acesso total a todos os módulos.</p>
          <div class="mt-6 grid sm:grid-cols-2 gap-4">
            <a href="{{ route('admin.news.index') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Notícias</p>
              <p class="text-xs text-slate-500">Publicar / editar</p>
            </a>
            <a href="{{ route('admin.usuarios') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Usuários</p>
              <p class="text-xs text-slate-500">Alunos e gestores</p>
            </a>
            <a href="{{ route('admin.cronograma.index') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Cronograma</p>
              <p class="text-xs text-slate-500">Horários e aulas</p>
            </a>
            <a href="{{ route('admin.saeb') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">SAEB</p>
              <p class="text-xs text-slate-500">Resultados e relatórios</p>
            </a>
            <a href="{{ route('admin.projetos') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Projetos Técnicos</p>
              <p class="text-xs text-slate-500">Gerenciar projetos</p>
            </a>
            <a href="{{ route('admin.professores') }}" class="p-4 border rounded-xl hover:bg-slate-50 transition">
              <p class="font-bold text-slate-900">Professores</p>
              <p class="text-xs text-slate-500">Gerenciar professores</p>
            </a>
            <a href="{{ route('admin.diretor.dashboard') }}" class="p-4 border rounded-xl bg-red-900 text-white hover:bg-red-800 transition">
              <p class="font-bold">Permissões</p>
              <p class="text-xs">Controle de permissões</p>
            </a>
          </div>
        </div>

        <!-- Últimas notícias -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
          <h2 class="text-lg font-black text-slate-900">Últimas notícias</h2>
          <p class="text-sm text-slate-600 mt-2">Visão rápida do portal.</p>
          <div class="mt-6 space-y-4">
            @forelse($ultimasNoticias as $n)
              <div class="flex items-start justify-between gap-4 border rounded-xl p-4 hover:bg-slate-50 transition">
                <div>
                  <p class="font-bold text-slate-900 leading-snug">{{ $n->title }}</p>
                  <p class="text-xs text-slate-500 mt-1">
                    {{ optional($n->published_at)->format('d/m/Y') }}
                  </p>
                </div>
                <span class="text-slate-400">›</span>
              </div>
            @empty
              <p class="text-sm text-slate-500">Sem notícias ainda.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Exemplo de dados fictícios, troque para dados reais do controller se desejar
const alunosPorTurma = @json($alunosPorTurma ?? ["1A"=>10,"1B"=>8,"2A"=>12]);
const boletinsPorAno = @json($boletinsPorAno ?? [2023=>40,2024=>55,2025=>30]);
const noticiasPorMes = @json($noticiasPorMes ?? ["01/2025"=>2,"02/2025"=>3,"03/2025"=>1]);

new Chart(document.getElementById('chartAlunosTurma'), {
  type: 'bar',
  data: {
    labels: Object.keys(alunosPorTurma),
    datasets: [{
      label: 'Alunos',
      data: Object.values(alunosPorTurma),
      backgroundColor: '#b91c1c',
    }]
  },
  options: {responsive: true, plugins: {legend: {display: false}}}
});

new Chart(document.getElementById('chartBoletinsAno'), {
  type: 'line',
  data: {
    labels: Object.keys(boletinsPorAno),
    datasets: [{
      label: 'Boletins',
      data: Object.values(boletinsPorAno),
      borderColor: '#b91c1c',
      backgroundColor: 'rgba(185,28,28,0.1)',
      fill: true,
      tension: 0.3
    }]
  },
  options: {responsive: true, plugins: {legend: {display: false}}}
});

new Chart(document.getElementById('chartNoticiasMes'), {
  type: 'bar',
  data: {
    labels: Object.keys(noticiasPorMes),
    datasets: [{
      label: 'Notícias',
      data: Object.values(noticiasPorMes),
      backgroundColor: '#b91c1c',
    }]
  },
  options: {responsive: true, plugins: {legend: {display: false}}}
});
</script>

    <!-- FEEDBACK -->
    @if(session('success'))
      <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl">
        {{ $errors->first() }}
      </div>
    @endif

    <!-- BUSCA -->
    <div class="bg-white border rounded-2xl p-6 shadow-sm mb-8">
      <form method="GET" action="{{ route('admin.diretor.dashboard') }}"
            class="flex flex-col sm:flex-row gap-4">

        <div class="flex-1">
          <label class="text-sm font-semibold text-slate-700">Buscar gestor</label>
          <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            class="mt-2 w-full border rounded-xl px-4 py-3 focus:border-red-500 focus:ring-red-500"
            placeholder="Nome ou e-mail">
        </div>

        <div class="sm:w-48 flex items-end gap-3">
          <button class="w-full px-5 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
            Buscar
          </button>

          <a href="{{ route('admin.diretor.dashboard') }}"
             class="px-5 py-3 border rounded-xl font-semibold hover:bg-slate-50">
            Limpar
          </a>
        </div>
      </form>
    </div>

    <!-- LISTA DE GESTORES -->
    <div class="grid lg:grid-cols-2 gap-8">

      @forelse($gestores as $g)
        @php
          $permsAtivas = $map[$g->id] ?? [];
        @endphp

        <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

          <!-- HEADER CARD -->
          <div class="p-6 flex justify-between gap-6">
            <div>
              <h2 class="text-lg font-black text-slate-900">{{ $g->nome }}</h2>
              <p class="text-sm text-slate-500">{{ $g->email }}</p>

              <span class="mt-3 inline-flex text-xs font-bold px-3 py-1 rounded-full
                           bg-slate-100 text-slate-700">
                GESTOR
              </span>
            </div>

            <div class="text-right">
              <p class="text-xs text-slate-500">Permissões</p>
              <p class="text-2xl font-black text-red-700">
                {{ count($permsAtivas) }}
              </p>
            </div>
          </div>

          <!-- CONFIG -->
          <div class="border-t">
            <button
              type="button"
              onclick="togglePerm('{{ $g->id }}')"
              class="w-full flex justify-between items-center px-6 py-4
                     text-sm font-bold text-slate-800 hover:bg-slate-50">
              <span>Configurar permissões</span>
              <span id="chev-{{ $g->id }}" class="text-xl text-slate-400">+</span>
            </button>

            <div id="perm-{{ $g->id }}" class="hidden px-6 pb-6">
              <form method="POST"
                    action="{{ route('admin.diretor.permissoes', $g->id) }}">
                @csrf

                <div class="grid sm:grid-cols-2 gap-4">
                  @foreach($permissoes as $p)
                    <div>DEBUG: Permissão {{ $p->id }} - {{ $p->descricao }}</div>
                    <label class="flex gap-3 p-4 border rounded-xl hover:bg-slate-50 cursor-pointer">
                      <input
                        type="checkbox"
                        name="permissoes[]"
                        value="{{ $p->id }}"
                        class="mt-1 w-5 h-5 accent-red-700"
                        {{ in_array($p->id, $permsAtivas) ? 'checked' : '' }}
                      >
                      <div>
                        <p class="font-bold text-slate-900">{{ $p->descricao }}</p>
                        <p class="text-xs text-slate-500 font-mono">{{ $p->chave }}</p>
                      </div>
                    </label>
                  @endforeach
                </div>

                <div class="mt-6 flex justify-between items-center gap-4">
                  <p class="text-xs text-slate-500">
                    O Diretor ignora essas permissões (acesso total).
                  </p>

                  <button class="px-6 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800">
                    Salvar
                  </button>
                </div>
              </form>
            </div>
          </div>

        </div>
      @empty
        <div class="lg:col-span-2 bg-white border rounded-2xl p-10 text-center text-slate-600">
          Nenhum gestor encontrado.
        </div>
      @endforelse

    </div>

    </div>
  </main>
</div>

<script>
function togglePerm(id) {
  document.querySelectorAll('[id^="perm-"]').forEach(e => e.classList.add('hidden'));
  document.querySelectorAll('[id^="chev-"]').forEach(e => e.textContent = '+');

  const box = document.getElementById('perm-' + id);
  const chev = document.getElementById('chev-' + id);

  if (box.classList.contains('hidden')) {
    box.classList.remove('hidden');
    chev.textContent = '–';
  }
}
</script>

{{-- <pre>{{ var_dump($permissoes) }}</pre> --}}
@include('layouts.footer')
