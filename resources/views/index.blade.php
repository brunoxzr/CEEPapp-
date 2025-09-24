{{-- resources/views/index.blade.php --}}
@include('layouts.header', ['title' => 'CEEPApp — Sistema Acadêmico'])

<section class="relative bg-gradient-to-br from-blue-600 to-indigo-700 text-white py-20">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-6">CEEPApp</h1>
    <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto">
      Plataforma acadêmica integrada para alunos e gestores do CEEP e Colégio Carrão.
      Boletins digitais, cronograma diário e resultados do SAEB em um só lugar.
    </p>
    <div class="flex flex-col md:flex-row gap-4 justify-center">
      <a href="{{ route('aluno.login') }}"
         class="px-6 py-3 rounded-lg bg-white text-blue-700 font-semibold shadow hover:bg-slate-100">
        Entrar como Aluno
      </a>
      <a href="{{ route('admin.login') }}"
         class="px-6 py-3 rounded-lg bg-white text-indigo-700 font-semibold shadow hover:bg-slate-100">
        Entrar como Gestor
      </a>
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-3 gap-8">
  <div class="bg-white rounded-xl shadow-soft p-6 text-center">
    <h3 class="text-xl font-bold mb-3 text-blue-700">Boletins Digitais</h3>
    <p class="text-slate-600 text-sm">Notas sempre atualizadas, acessíveis online pelos alunos e responsáveis.</p>
  </div>
  <div class="bg-white rounded-xl shadow-soft p-6 text-center">
    <h3 class="text-xl font-bold mb-3 text-indigo-700">Cronograma Diário</h3>
    <p class="text-slate-600 text-sm">Gestores lançam horários e professores, alunos acessam com praticidade.</p>
  </div>
  <div class="bg-white rounded-xl shadow-soft p-6 text-center">
    <h3 class="text-xl font-bold mb-3 text-green-700">SAEB Integrado</h3>
    <p class="text-slate-600 text-sm">Resultados processados automaticamente e vinculados a cada aluno.</p>
  </div>
</section>

<section class="bg-slate-50 py-16">
  <div class="max-w-5xl mx-auto px-4 text-center">
    <h2 class="text-2xl font-bold mb-4">Sobre o CEEPApp</h2>
    <p class="text-slate-700 max-w-3xl mx-auto mb-6">
      O CEEPApp foi desenvolvido para modernizar a gestão acadêmica e simplificar o acesso dos alunos.
      Todo o sistema foi feito com foco na **transparência**, **facilidade de uso** e **inovação educacional**.
    </p>
    <p class="text-sm text-slate-500">Desenvolvido por <strong>Bruno</strong> e <strong>Grêmio Areté</strong> — CEEP</p>
  </div>
</section>

@include('layouts.footer')
