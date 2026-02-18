@include('layouts.header', [
    'title' => $perfil->aluno->nome . ' — Perfil Profissional | CEEP Assaí'
])

@php
    $curso = $perfil->curso;

    $tema = match ($curso) {
        'Desenvolvimento de Sistemas' => [
            'bg' => 'from-blue-50 to-slate-100',
            'cor' => 'blue',
        ],
        'Agropecuária' => [
            'bg' => 'from-green-50 to-lime-100',
            'cor' => 'green',
        ],
        'Enfermagem' => [
            'bg' => 'from-red-50 to-rose-100',
            'cor' => 'red',
        ],
        'Edificações' => [
            'bg' => 'from-orange-50 to-amber-100',
            'cor' => 'orange',
        ],
        'Eletrotécnica' => [
            'bg' => 'from-yellow-50 to-yellow-100',
            'cor' => 'yellow',
        ],
        'Mecânica Industrial' => [
            'bg' => 'from-slate-100 to-gray-200',
            'cor' => 'slate',
        ],
        default => [
            'bg' => 'from-slate-50 to-slate-100',
            'cor' => 'red',
        ],
    };
@endphp

<main class="min-h-screen py-20 bg-gradient-to-br {{ $tema['bg'] }} relative overflow-hidden">

    <!-- ELEMENTOS DE FUNDO -->
    @if($curso === 'Desenvolvimento de Sistemas')
        <svg class="absolute -top-24 -right-24 w-96 h-96 text-blue-200/40"
             fill="none" stroke="currentColor" stroke-width="1"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
        </svg>
    @elseif($curso === 'Agropecuária')
        <svg class="absolute -top-24 -right-24 w-96 h-96 text-green-200/40"
             fill="none" stroke="currentColor" stroke-width="1"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 22s8-4 8-10V6l-8-4-8 4v6c0 6 8 10 8 10z"/>
        </svg>
    @elseif($curso === 'Enfermagem')
        <svg class="absolute -top-24 -right-24 w-96 h-96 text-red-200/40"
             fill="none" stroke="currentColor" stroke-width="1"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6v12M6 12h12"/>
        </svg>
    @elseif($curso === 'Edificações')
        <svg class="absolute -top-24 -right-24 w-96 h-96 text-orange-200/40"
             fill="none" stroke="currentColor" stroke-width="1"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 10l9-7 9 7v11a1 1 0 01-1 1H4a1 1 0 01-1-1z"/>
        </svg>
    @endif

    <div class="relative z-10 max-w-4xl mx-auto px-6">

        <!-- CARD -->
        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl border p-12">

            <!-- TOPO -->
            <div class="flex flex-col items-center text-center">

                <!-- FOTO -->
                <div class="w-40 h-40 rounded-full overflow-hidden
                            border-4 border-{{ $tema['cor'] }}-600 bg-slate-100 shadow-lg">
                    @if($perfil->foto)
                        <img src="{{ asset('storage/'.$perfil->foto) }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center
                                    text-slate-400 text-sm">
                            Sem foto
                        </div>
                    @endif
                </div>

                <!-- NOME -->
                <h1 class="mt-8 text-4xl font-black text-{{ $tema['cor'] }}-800">
                    {{ $perfil->aluno?->nome }}

                </h1>

                <!-- CURSO -->
                <p class="mt-2 text-slate-700 font-semibold">
                    {{ $perfil->curso }} • {{ $perfil->ano }}
                </p>
            </div>

            <!-- BIO -->
            @if($perfil->bio)
            <div class="mt-12 text-center">
                <h2 class="text-xl font-bold text-{{ $tema['cor'] }}-800 mb-4">
                    Sobre
                </h2>

                <p class="text-slate-700 leading-relaxed max-w-2xl mx-auto">
                    {{ $perfil->bio }}
                </p>
            </div>
            @endif

            <!-- LINKS -->
            <div class="mt-12 flex flex-wrap justify-center gap-4">

                @if($perfil->linkedin)
                    <a href="{{ $perfil->linkedin }}" target="_blank"
                       class="px-6 py-3 rounded-xl bg-blue-50 text-blue-700
                              font-semibold hover:bg-blue-100 transition">
                        LinkedIn
                    </a>
                @endif

                @if($perfil->github)
                    <a href="{{ $perfil->github }}" target="_blank"
                       class="px-6 py-3 rounded-xl bg-slate-100 text-slate-800
                              font-semibold hover:bg-slate-200 transition">
                        GitHub
                    </a>
                @endif

                @if($perfil->portfolio)
                    <a href="{{ $perfil->portfolio }}" target="_blank"
                       class="px-6 py-3 rounded-xl bg-yellow-100 text-yellow-800
                              font-semibold hover:bg-yellow-200 transition">
                        Portfólio
                    </a>
                @endif

            </div>
@if($perfil->aluno && $perfil->aluno->reconhecimentos && $perfil->aluno->reconhecimentos->count())

    <div class="mt-16">

        <h2 class="text-xl font-black text-center text-{{ $tema['cor'] }}-800 mb-8">
            Reconhecimentos & Premiações
        </h2>

        <div class="grid sm:grid-cols-2 gap-6 max-w-3xl mx-auto">

            @foreach($perfil->aluno->reconhecimentos as $premio)
                <div class="relative bg-white border rounded-2xl p-6
                            shadow-sm hover:shadow-lg transition
                            group overflow-hidden">

                    <!-- detalhe lateral -->
                    <div class="absolute left-0 top-0 h-full w-1
                                bg-{{ $tema['cor'] }}-600"></div>

                    <h3 class="font-bold text-slate-800 text-lg">
                        {{ $premio->titulo }}
                    </h3>

                    @if($premio->ano)
                        <p class="text-sm text-slate-500 mt-1">
                            {{ $premio->ano }}
                        </p>
                    @endif

                    @if($premio->descricao)
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            {{ $premio->descricao }}
                        </p>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
@endif

            <!-- VOLTAR -->
            <div class="mt-16 text-center">
                <a href="{{ url('/hub-rh') }}"
                   class="font-bold text-{{ $tema['cor'] }}-700 hover:underline">
                    ← Voltar ao Hub de Talentos
                </a>
            </div>

        </div>
    </div>
</main>

@include('layouts.footer')
