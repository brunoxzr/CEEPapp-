@include('layouts.header', [
    'title' => $perfil->aluno->nome . ' — Perfil Profissional | CEEP Assaí'
])

<main class="bg-slate-50 min-h-screen py-16">

    <div class="max-w-4xl mx-auto px-6">

        <!-- CARD PRINCIPAL -->
        <div class="bg-white rounded-3xl shadow-xl border p-10">

            <!-- TOPO -->
            <div class="flex flex-col items-center text-center">

                <!-- FOTO -->
                <div class="w-36 h-36 rounded-full overflow-hidden
                            border-4 border-red-700/30 bg-slate-100">
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
                <h1 class="mt-6 text-3xl font-black text-slate-900">
                    {{ $perfil->aluno->nome }}
                </h1>

                <!-- CURSO -->
<p class="mt-2 text-slate-600 font-medium">
    {{ $perfil->curso }} • {{ $perfil->ano }}
</p>

            </div>

            <!-- BIO -->
            @if($perfil->bio)
            <div class="mt-10 text-center">
                <h2 class="text-lg font-bold text-red-800 mb-3">
                    Sobre
                </h2>

                <p class="text-slate-700 leading-relaxed max-w-2xl mx-auto">
                    {{ $perfil->bio }}
                </p>
            </div>
            @endif

            <!-- LINKS -->
            <div class="mt-10 flex flex-wrap justify-center gap-4">

                @if($perfil->linkedin)
                    <a href="{{ $perfil->linkedin }}" target="_blank"
                       class="px-5 py-2 rounded-xl bg-blue-50 text-blue-700
                              font-semibold hover:bg-blue-100 transition">
                        LinkedIn
                    </a>
                @endif

                @if($perfil->github)
                    <a href="{{ $perfil->github }}" target="_blank"
                       class="px-5 py-2 rounded-xl bg-slate-100 text-slate-800
                              font-semibold hover:bg-slate-200 transition">
                        GitHub
                    </a>
                @endif

                @if($perfil->portfolio)
                    <a href="{{ $perfil->portfolio }}" target="_blank"
                       class="px-5 py-2 rounded-xl bg-yellow-100 text-yellow-800
                              font-semibold hover:bg-yellow-200 transition">
                        Portfólio
                    </a>
                @endif

            </div>

            <!-- VOLTAR -->
            <div class="mt-12 text-center">
                <a href="{{ url('/hub-rh') }}"
                   class="inline-flex items-center gap-2 text-red-700
                          font-semibold hover:underline">
                    ← Voltar ao Hub de Talentos
                </a>
            </div>

        </div>

    </div>

</main>

@include('layouts.footer')
