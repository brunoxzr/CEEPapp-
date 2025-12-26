@include('layouts.header', ['title' => $pessoa->nome.' — Institucional'])

<main class="bg-slate-50">

  <!-- HERO PERFIL -->
  <section class="relative overflow-hidden bg-gradient-to-r from-red-800 to-red-950 text-white">
    <div class="absolute inset-0 opacity-20">
      <div class="absolute -top-24 -left-24 w-96 h-96 bg-yellow-400/30 blur-3xl rounded-full"></div>
      <div class="absolute -bottom-28 -right-24 w-[520px] h-[520px] bg-red-400/20 blur-3xl rounded-full"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-14">
      <div class="flex flex-col md:flex-row items-start md:items-center gap-8">

        <div class="w-32 h-32 rounded-3xl overflow-hidden bg-white/10 ring-4 ring-white/10 shrink-0">
          @if($pessoa->foto)
            <img src="{{ asset('storage/'.$pessoa->foto) }}" class="w-full h-full object-cover" alt="{{ $pessoa->nome }}">
          @endif
        </div>

        <div class="flex-1">
          <p class="text-xs font-black uppercase tracking-[0.25em] text-yellow-300">Institucional</p>
          <h1 class="text-4xl md:text-5xl font-black mt-3 leading-tight">{{ $pessoa->nome }}</h1>
          <p class="text-red-100 mt-3 text-lg">
            {{ $pessoa->cargo }}
          </p>

          <div class="mt-6 flex flex-wrap gap-3">
            <span class="px-4 py-2 rounded-full bg-white/10 border border-white/10 font-black text-sm">
              Nível {{ $pessoa->nivel }}
            </span>
            <a href="{{ route('portal.institucional') }}"
               class="px-4 py-2 rounded-full bg-white/10 border border-white/10 font-black text-sm hover:bg-white/15 transition">
              ← Voltar para a pirâmide
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CONTEÚDO -->
  <section class="py-14">
    <div class="max-w-4xl mx-auto px-6">

      <div class="bg-white border rounded-3xl shadow-sm p-8 md:p-10">
        <h2 class="text-2xl font-black text-slate-900">Sobre</h2>

        @if($pessoa->biografia)
          <div class="mt-4 text-slate-700 leading-relaxed whitespace-pre-line">
            {{ $pessoa->biografia }}
          </div>
        @else
          <p class="mt-4 text-slate-600">
            Biografia não informada.
          </p>
        @endif
      </div>

      <!-- RECENTES -->
      <div class="mt-12">
        <div class="flex items-end justify-between gap-6 mb-6">
          <h3 class="text-xl md:text-2xl font-black text-slate-900">Outros membros</h3>
          <a href="{{ route('portal.institucional') }}" class="text-sm font-black text-red-700 hover:underline">
            Ver todos
          </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($recentes as $p)
            <a href="{{ route('portal.institucional.show', $p->slug) }}"
               class="group bg-white border rounded-2xl p-6 hover:shadow-xl transition">
              <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-200">
                  @if($p->foto)
                    <img src="{{ asset('storage/'.$p->foto) }}" class="w-full h-full object-cover" alt="{{ $p->nome }}">
                  @endif
                </div>
                <div class="leading-tight">
                  <div class="font-black text-slate-900 group-hover:text-red-700 transition">{{ $p->nome }}</div>
                  <div class="text-sm text-red-700 font-semibold">{{ $p->cargo }}</div>
                  <div class="text-xs text-slate-500 font-mono">Nível {{ $p->nivel }}</div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>

    </div>
  </section>

</main>

@include('layouts.footer')
