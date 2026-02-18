@include('layouts.header', ['title' => 'Inscrições — Smart Agro 2026 | CEEP Assaí'])

<main class="bg-white text-slate-800">

<!-- HERO -->
<section class="relative overflow-hidden border-b">
    <div class="absolute inset-0 bg-gradient-to-r from-red-800 to-red-900"></div>

    <div class="relative max-w-5xl mx-auto px-6 py-28 text-white">

        <span class="uppercase tracking-[0.3em] text-xs font-bold text-yellow-300">
            Hackathon Smart Agro 2026
        </span>

        <h1 class="text-4xl md:text-5xl font-black mt-4">
            Inscrição Interna CEEP Assaí
        </h1>

        <p class="mt-6 text-red-100 max-w-2xl">
            Transforme sua pesquisa em uma solução real para o agronegócio.
            Esta é a etapa interna de seleção para participação no Hackathon Smart Agro 2026.
        </p>

    </div>
</section>

<!-- FORMULÁRIO -->
<section class="py-20">
    <div class="max-w-4xl mx-auto px-6">

        @if(session('success'))
            <div class="mb-8 p-5 bg-green-50 border border-green-200 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 p-5 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('smartagro.inscricoes.store') }}"
              class="bg-white border rounded-2xl shadow-lg p-10 space-y-10">

            @csrf

            <!-- DADOS DO RESPONSÁVEL -->
            <div>
                <h2 class="text-2xl font-black text-red-800 mb-6">
                    Dados do Representante do Projeto
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <input type="text" name="aluno_nome" placeholder="Nome completo"
                           class="border rounded-xl px-4 py-3 w-full" required>

                    <input type="email" name="aluno_email" placeholder="E-mail"
                           class="border rounded-xl px-4 py-3 w-full" required>

                    <input type="text" name="aluno_telefone" placeholder="Telefone"
                           class="border rounded-xl px-4 py-3 w-full">

                    <select name="turma"
        class="border rounded-xl px-4 py-3 w-full"
        required>
    <option value="">Selecione sua turma</option>
    @foreach($turmas as $turma)
        <option value="{{ $turma }}">
            {{ $turma }}
        </option>
    @endforeach
</select>


                    <select name="ano" class="border rounded-xl px-4 py-3 w-full" required>
                        <option value="">Selecione o ano</option>
                        <option>1º Ano</option>
                        <option>2º Ano</option>
                        <option>3º Ano</option>
                    </select>

                    <input type="text" name="professor_orientador"
                           placeholder="Professor Orientador"
                           class="border rounded-xl px-4 py-3 w-full" required>
                </div>
            </div>

            <!-- INTEGRANTES -->
            <div>
                <h2 class="text-2xl font-black text-red-800 mb-6">
                    Integrantes da Equipe (máx. 4)
                </h2>

                <div class="grid gap-4">
                    <input type="text" name="integrante_1" placeholder="Integrante 1" class="border rounded-xl px-4 py-3">
                    <input type="text" name="integrante_2" placeholder="Integrante 2" class="border rounded-xl px-4 py-3">
                    <input type="text" name="integrante_3" placeholder="Integrante 3" class="border rounded-xl px-4 py-3">
                    <input type="text" name="integrante_4" placeholder="Integrante 4" class="border rounded-xl px-4 py-3">
                </div>
            </div>

            <!-- PROJETO -->
            <div>
                <h2 class="text-2xl font-black text-red-800 mb-6">
                    Projeto
                </h2>

                <div class="space-y-6">
                    <input type="text" name="titulo_projeto"
                           placeholder="Título do Projeto"
                           class="border rounded-xl px-4 py-3 w-full" required>

                    <select name="area"
                            class="border rounded-xl px-4 py-3 w-full" required>
                        <option value="">Área do projeto</option>
                        <option>Agronegócio</option>
                        <option>Biotecnologia</option>
                        <option>Transformação Digital</option>
                        <option>Alimentos</option>
                    </select>

                    <textarea name="problema"
                              placeholder="Qual problema no agro sua pesquisa resolve?"
                              rows="4"
                              class="border rounded-xl px-4 py-3 w-full"
                              required></textarea>

                    <textarea name="solucao"
                              placeholder="Como sua solução funciona?"
                              rows="4"
                              class="border rounded-xl px-4 py-3 w-full"
                              required></textarea>

                    <textarea name="potencial_startup"
                              placeholder="Por que pode se tornar uma startup?"
                              rows="4"
                              class="border rounded-xl px-4 py-3 w-full"
                              required></textarea>

                    <textarea name="diferencial"
                              placeholder="Quais os principais diferenciais?"
                              rows="4"
                              class="border rounded-xl px-4 py-3 w-full"
                              required></textarea>
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="px-8 py-3 bg-yellow-400 text-red-900 font-black rounded-xl hover:bg-yellow-300 transition shadow-lg">
                    Enviar Inscrição
                </button>
            </div>

        </form>
    </div>
</section>

</main>

@include('layouts.footer')
