@include('layouts.header', ['title' => 'CEEP Assaí — Hub de Talentos'])

<main class="bg-slate-50 text-slate-800 min-h-screen">

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-red-800 to-red-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <span class="text-xs font-bold uppercase tracking-widest text-yellow-300">
            Hub de Talentos • CEEP Assaí
        </span>

        <h1 class="mt-3 text-4xl font-extrabold">
            Alunos em Destaque
        </h1>

        <p class="mt-4 text-red-100 max-w-2xl">
            Lista de alunos com perfis profissionais disponíveis para consulta por empresas,
            instituições e parceiros do CEEP Assaí.
        </p>
    </div>
</section>

<!-- ================= FILTROS ================= -->
<section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 py-8">

        <form class="grid md:grid-cols-3 gap-4">

            <!-- CURSO -->
            <select name="curso"
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-600">
                <option value="">Todos os cursos</option>
                @foreach([
                    'Agropecuária',
                    'Desenvolvimento de Sistemas',
                    'Edificações',
                    'EletroEletrônica',
                    'Enfermagem',
                    'Mecânica Industrial'
                ] as $curso)
                    <option value="{{ $curso }}" @selected(request('curso') === $curso)>
                        {{ $curso }}
                    </option>
                @endforeach
            </select>

            <!-- ANO -->
            <select name="ano"
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-600">
                <option value="">Todos os anos</option>
                @foreach(['Primeiro Ano','Segundo Ano','Terceiro Ano', 'Formado'] as $ano)
                    <option value="{{ $ano }}" @selected(request('ano') === $ano)>
                        {{ $ano }}
                    </option>
                @endforeach
            </select>

            <!-- BOTÃO -->
            <button
                class="bg-red-700 text-white font-bold rounded-lg px-6 py-2
                       hover:bg-red-800 transition">
                Filtrar
            </button>

        </form>

    </div>
</section>

<!-- ================= LISTAGEM VERTICAL ================= -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-6">

        @if($perfis->count())
        <div class="bg-white rounded-xl border shadow-sm divide-y">

            @foreach($perfis as $perfil)
            <div class="flex items-center gap-6 p-6 hover:bg-slate-50 transition">

                <!-- FOTO -->
                <div class="flex-shrink-0">
                    @if($perfil->foto)
                        <img src="{{ asset('storage/'.$perfil->foto) }}"
                             class="w-16 h-16 rounded-full object-cover
                                    border-2 border-red-700/30">
                    @else
                        <div class="w-16 h-16 rounded-full bg-slate-200"></div>
                    @endif
                </div>

                <!-- INFO -->
                <div class="flex-1">
                    <h3 class="font-bold text-slate-900">
                        {{ $perfil->aluno->nome }}
                    </h3>

                    <p class="text-sm text-slate-600">
                        {{ $perfil->curso }} • {{ $perfil->ano }}
                    </p>
                </div>

                <!-- AÇÃO -->
                <div>
                    @if(!empty($perfil->aluno?->slug))
                        <a href="{{ route('aluno.public', $perfil->aluno->slug) }}"
                           class="px-4 py-2 bg-red-700 text-white text-sm font-semibold
                                  rounded-lg hover:bg-red-800 transition">
                            Ver perfil
                        </a>
                    @else
                        <span class="px-4 py-2 bg-slate-300 text-slate-600 text-sm
                                     rounded-lg cursor-not-allowed">
                            Indisponível
                        </span>
                    @endif
                </div>

            </div>
            @endforeach

        </div>
        @else
            <p class="text-center text-slate-500">
                Nenhum aluno encontrado com os filtros selecionados.
            </p>
        @endif

    </div>
</section>

</main>

@include('layouts.footer')
