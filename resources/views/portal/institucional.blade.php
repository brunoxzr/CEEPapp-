@include('layouts.header', ['title' => 'Institucional — CEEP Assaí'])

<main class="bg-slate-50">

  <!-- HERO -->
  <section class="relative overflow-hidden bg-gradient-to-r from-red-800 to-red-950 text-white">
    <div class="absolute inset-0 opacity-20">
      <div class="absolute -top-24 -left-24 w-96 h-96 bg-yellow-400/30 blur-3xl rounded-full"></div>
      <div class="absolute -bottom-28 -right-24 w-[520px] h-[520px] bg-red-400/20 blur-3xl rounded-full"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-24 text-center">
      <p class="text-xs font-black uppercase tracking-[0.25em] text-yellow-300">CEEP Assaí</p>
      <h1 class="text-4xl md:text-5xl font-black mt-4">Estrutura Institucional</h1>
      <p class="text-red-100 max-w-2xl mx-auto mt-5">
        Veja a hierarquia em formato de <span class="font-black text-white">pirâmide (degraus)</span> e clique em “Ver mais” para abrir o perfil.
      </p>
    </div>
  </section>

  @php
    $labels = [
      1 => 'Direção',
      2 => 'Coordenação',
      3 => 'Pedagogia',
      4 => 'Equipe Técnica',
      5 => 'Equipe',
    ];
  @endphp

  <!-- PIRÂMIDE (DEGRAUS) -->
  <section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-6 space-y-14">

      @forelse($pessoas as $nivel => $grupo)
        @php
          // largura do degrau (nível 1 maior)
          // nível 1: 100%, nível 2: 92%, nível 3: 84%...
          $width = max(62, 100 - (($nivel - 1) * 10));
        @endphp

        <div class="flex justify-center">
          <div class="w-full md:w-[{{ $width }}%]">
            <div class="flex items-center justify-center gap-3 mb-6">
              <span class="px-4 py-2 rounded-full bg-red-50 text-red-800 font-black text-sm">
                {{ $labels[$nivel] ?? 'Equipe' }}
              </span>
              <span class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">
                Nível {{ $nivel }}
              </span>
            </div>

            <div class="relative bg-white border rounded-3xl shadow-sm p-6 md:p-10">
              <!-- efeito “degrau” -->
              <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-[92%] h-6 rounded-3xl bg-slate-200/40 blur-sm"></div>

              <div class="flex flex-wrap justify-center gap-6 md:gap-8">
                @foreach($grupo as $p)
                  <article class="group w-72 rounded-2xl border bg-white overflow-hidden hover:shadow-xl transition">
                    <div class="p-6 text-center">
                      <div class="mx-auto w-28 h-28 rounded-full overflow-hidden bg-slate-200 ring-4 ring-red-700/10">
                        @if($p->foto)
                          <img src="{{ asset('storage/'.$p->foto) }}"
                               class="w-full h-full object-cover"
                               alt="{{ $p->nome }}">
                        @endif
                      </div>

                      <h3 class="mt-4 font-black text-slate-900 group-hover:text-red-700 transition">
                        {{ $p->nome }}
                      </h3>

                      <p class="text-red-700 font-semibold text-sm mt-1">
                        {{ $p->cargo }}
                      </p>

                      <div class="mt-4">
                        @if(!empty($p->slug))
                          <a href="{{ route('portal.institucional.show', $p->slug) }}"
                             class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-red-700 text-white font-black hover:bg-red-800 transition">
                            Ver mais
                            <span aria-hidden="true">→</span>
                          </a>
                        @else
                          <span class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-600 font-black">
                            Perfil indisponível
                          </span>
                        @endif
                      </div>
                    </div>
                  </article>
                @endforeach
              </div>
            </div>
          </div>
        </div>

      @empty
        <div class="text-center text-slate-600 bg-white border rounded-2xl p-10">
          Nenhuma pessoa cadastrada no Institucional.
        </div>
      @endforelse

    </div>
  </section>

</main>

@include('layouts.footer')
