{{-- resources/views/index.blade.php --}}
@include('layouts.header', ['title' => 'CEEPApp — Sistema Acadêmico'])

<!-- HERO -->
<section class="relative bg-gradient-to-br from-red-700 to-red-900 text-white py-24">
  <div class="max-w-6xl mx-auto px-4 text-center">

    <h1 class="text-5xl md:text-6xl font-black tracking-wide mb-6 drop-shadow-lg">
      CEEPApp
    </h1>

    <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90 mb-10">
      Plataforma acadêmica oficial do CEEP de Assaí — boletins digitais, cronograma atualizado,
      organização escolar e indicadores educacionais em um só lugar.
    </p>

    <div class="flex flex-col md:flex-row gap-4 justify-center">
      <a href="{{ route('aluno.login') }}"
         class="px-7 py-3 rounded-xl bg-yellow-400 text-red-900 font-bold shadow-lg hover:bg-yellow-300 transition">
        Entrar como Aluno
      </a>

      <a href="{{ route('admin.login') }}"
         class="px-7 py-3 rounded-xl bg-white text-red-700 font-bold shadow-lg hover:bg-slate-100 transition">
        Entrar como Gestor
      </a>
    </div>

  </div>

  <!-- detalhe amarelo decorativo -->
  <div class="absolute bottom-0 left-0 right-0 h-2 bg-yellow-400"></div>
</section>

<!-- CARDS -->
<section class="max-w-6xl mx-auto px-4 py-20 grid md:grid-cols-3 gap-8">

  <div class="bg-white rounded-2xl shadow-xl p-7 text-center border-t-4 border-red-700">
    <h3 class="text-xl font-bold mb-3 text-red-800">Boletins Digitais</h3>
    <p class="text-slate-600 text-sm">
      Notas atualizadas e prontas para consulta com transparência e rapidez.
    </p>
  </div>

  <div class="bg-white rounded-2xl shadow-xl p-7 text-center border-t-4 border-yellow-400">
    <h3 class="text-xl font-bold mb-3 text-yellow-600">Cronograma Diário</h3>
    <p class="text-slate-600 text-sm">
      Acompanhe horários, aulas e professores com acesso organizado.
    </p>
  </div>

  <div class="bg-white rounded-2xl shadow-xl p-7 text-center border-t-4 border-red-900">
    <h3 class="text-xl font-bold mb-3 text-red-900">SAEB Integrado</h3>
    <p class="text-slate-600 text-sm">
      Dados de aprendizagem reunidos no perfil de cada aluno.
    </p>
  </div>

</section>

<!-- SOBRE -->
<section class="bg-red-50 py-20 border-t border-red-100">
  <div class="max-w-5xl mx-auto px-4 text-center">

    <h2 class="text-3xl font-black text-red-900 mb-6">Sobre o CEEPApp</h2>

    <p class="text-slate-700 max-w-3xl mx-auto mb-8 text-lg">
      O CEEPApp foi desenvolvido para modernizar e fortalecer a gestão acadêmica do CEEP.
      Criado com foco em **simplicidade**, **eficiência** e **experiência do usuário**,
      ele reúne as informações essenciais da rotina escolar em um ambiente único.
    </p>

    <p class="text-sm text-slate-500">
      Desenvolvido por <strong>Bruno</strong> — CEEP Assaí
    </p>
  </div>
</section>

@include('layouts.footer')
