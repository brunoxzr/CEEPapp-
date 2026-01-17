@include('layouts.aluno_nav', ['title' => 'Meu Perfil Profissional'])

@php
    $aluno = \App\Models\Aluno::find(session('aluno_id'));
@endphp

<main class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen py-16">
    <div class="max-w-5xl mx-auto px-6">

        <!-- ================= HEADER ================= -->
        <div class="mb-12">
            <div class="flex items-center gap-3">
                <svg class="w-8 h-8 text-red-800" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5.121 17.804A13.937 13.937 0 0112 15
                             c2.5 0 4.847.655 6.879 1.804
                             M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>

                <h1 class="text-4xl font-black text-red-800">
                    Meu Perfil Profissional
                </h1>
            </div>

            <p class="text-slate-700 mt-3 max-w-2xl">
                Este é o perfil exibido no <strong>Hub de RH do CEEP</strong>.
                Preencha com atenção — empresas verão estas informações.
            </p>
        </div>

        <!-- ================= LINK PÚBLICO ================= -->
        @if(!empty($aluno?->slug))
            <div class="mb-10 p-6 rounded-2xl bg-gradient-to-r from-green-100 to-emerald-100
                        border border-green-300 shadow flex gap-4">
                <svg class="w-6 h-6 text-green-700 mt-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M13.828 10.172a4 4 0 010 5.656l-3 3
                             a4 4 0 01-5.656-5.656l1.5-1.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.172 13.828a4 4 0 010-5.656l3-3
                             a4 4 0 015.656 5.656l-1.5 1.5"/>
                </svg>

                <div>
                    <p class="text-sm font-bold text-green-900 mb-1">
                        Seu perfil público
                    </p>

                    <a href="{{ url('/perfil/'.$aluno->slug) }}"
                       target="_blank"
                       class="text-green-800 font-semibold underline break-all">
                        {{ url('/perfil/'.$aluno->slug) }}
                    </a>

                    <p class="text-xs text-green-700 mt-2">
                        Este link aparece no Hub de RH.
                    </p>
                </div>
            </div>
        @else
            <div class="mb-10 p-6 rounded-2xl bg-yellow-100 border border-yellow-300 shadow">
                <p class="text-sm font-semibold text-yellow-900">
                    Seu perfil público será criado automaticamente ao salvar este formulário.
                </p>
            </div>
        @endif

        <!-- ================= FORM ================= -->
        <form method="POST" enctype="multipart/form-data"
              class="bg-white rounded-3xl shadow-2xl border p-12 space-y-12">
            @csrf

            <!-- ================= FOTO ================= -->
            <section>
                <h2 class="text-lg font-black text-red-800 mb-4">
                    Foto de Perfil
                </h2>

                <div class="flex items-center gap-8">

                    <!-- PREVIEW -->
                    <div class="w-36 h-36 rounded-full overflow-hidden
                                border-4 border-red-700/30 bg-slate-200
                                flex items-center justify-center">

                        <img id="fotoPreview"
                             src="{{ !empty($perfil?->foto) ? asset('storage/'.$perfil->foto) : '' }}"
                             class="w-full h-full object-cover {{ empty($perfil?->foto) ? 'hidden' : '' }}">

                        <span id="fotoPlaceholder"
                              class="text-slate-500 text-sm {{ !empty($perfil?->foto) ? 'hidden' : '' }}">
                            Sem foto
                        </span>
                    </div>

                    <div>
                        <input type="file" name="foto" id="fotoInput" accept="image/*"
                               class="block text-sm
                                      file:mr-4 file:py-2 file:px-5
                                      file:rounded-full file:border-0
                                      file:bg-red-700 file:text-white
                                      hover:file:bg-red-800 transition">
                        <p class="text-xs text-slate-600 mt-2">
                            Foto nítida, fundo neutro e boa iluminação.
                        </p>
                    </div>
                </div>
            </section>

            <!-- ================= LINKS ================= -->
            <section>
                <h2 class="text-lg font-black text-red-800 mb-4">
                    Links Profissionais
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            LinkedIn
                        </label>
                        <input type="url" name="linkedin"
                               value="{{ $perfil->linkedin ?? '' }}"
                               placeholder="https://linkedin.com/in/seu-nome"
                               class="w-full rounded-xl border-2 border-slate-300
                                      bg-slate-50 px-4 py-3
                                      focus:border-red-600 focus:ring-2 focus:ring-red-200">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            GitHub
                        </label>
                        <input type="url" name="github"
                               value="{{ $perfil->github ?? '' }}"
                               placeholder="https://github.com/seuusuario"
                               class="w-full rounded-xl border-2 border-slate-300
                                      bg-slate-50 px-4 py-3
                                      focus:border-red-600 focus:ring-2 focus:ring-red-200">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Portfólio
                        </label>
                        <input type="url" name="portfolio"
                               value="{{ $perfil->portfolio ?? '' }}"
                               placeholder="https://seusite.com"
                               class="w-full rounded-xl border-2 border-slate-300
                                      bg-slate-50 px-4 py-3
                                      focus:border-red-600 focus:ring-2 focus:ring-red-200">
                    </div>
                </div>
            </section>

            <!-- ================= BIO ================= -->
            <section>
                <h2 class="text-lg font-black text-red-800 mb-4">
                    Apresentação Profissional
                </h2>

                <textarea name="bio" rows="4"
                          placeholder="Fale brevemente sobre você, suas habilidades e interesses."
                          class="w-full rounded-xl border-2 border-slate-300
                                 bg-slate-50 px-4 py-3
                                 focus:border-red-600 focus:ring-2 focus:ring-red-200">{{ $perfil->bio ?? '' }}</textarea>
            </section>

            <!-- ================= CURSO / ETAPA ================= -->
            <section>
                <h2 class="text-lg font-black text-red-800 mb-4">
                    Dados Acadêmicos
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Curso
                        </label>
                        <select name="curso"
                                class="w-full rounded-xl border-2 border-slate-300
                                       bg-slate-50 px-4 py-3
                                       focus:border-red-600 focus:ring-2 focus:ring-red-200">
                            @foreach([
                                'Agronegócio',
                                'Desenvolvimento de Sistemas',
                                'Edificações',
                                'EletroEletrônica',
                                'Enfermagem',
                                'Mecânica Industrial'
                            ] as $curso)
                                <option value="{{ $curso }}"
                                    @selected(($perfil->curso ?? '') === $curso)>
                                    {{ $curso }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Etapa
                        </label>
                        <select name="ano"
                                class="w-full rounded-xl border-2 border-slate-300
                                       bg-slate-50 px-4 py-3
                                       focus:border-red-600 focus:ring-2 focus:ring-red-200">
                            @foreach([
                                'Primeiro Ano',
                                'Segundo Ano',
                                'Terceiro Ano',
                                'Formado'
                            ] as $ano)
                                <option value="{{ $ano }}"
                                    @selected(($perfil->ano ?? '') === $ano)>
                                    {{ $ano }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>

            <!-- ================= BOTÃO ================= -->
            <div class="pt-6 flex justify-end">
                <button type="submit"
                        class="px-12 py-4 bg-red-700 text-white font-black
                               rounded-2xl hover:bg-red-800 transition shadow-lg">
                    Salvar Perfil
                </button>
            </div>

        </form>
    </div>
</main>

<!-- ================= JS PREVIEW ================= -->
<script>
document.getElementById('fotoInput')?.addEventListener('change', function (e) {
    const file = e.target.files[0]
    if (!file) return

    const preview = document.getElementById('fotoPreview')
    const placeholder = document.getElementById('fotoPlaceholder')

    const reader = new FileReader()
    reader.onload = () => {
        preview.src = reader.result
        preview.classList.remove('hidden')
        placeholder.classList.add('hidden')
    }
    reader.readAsDataURL(file)
})
</script>

@include('layouts.footer')
