@include('layouts.header', ['title' => 'Contato — CEEP Assaí'])

<main class="bg-slate-50">

  <!-- HERO -->
  <section class="relative overflow-hidden bg-gradient-to-br from-red-800 via-red-700 to-red-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">

      <div>
        <p class="uppercase tracking-[0.3em] text-xs font-bold text-yellow-300 mb-4">
          Fale com o CEEP
        </p>

        <h1 class="text-4xl md:text-5xl font-black leading-tight mb-6">
          Estamos aqui pra te<br>
          <span class="text-yellow-300">atender de verdade</span>
        </h1>

        <p class="text-white/90 text-lg leading-relaxed max-w-xl">
          Dúvidas sobre cursos, matrícula, documentos ou projetos?
          A secretaria do CEEP Assaí está pronta para te orientar.
          Atendimento humano, direto e sem enrolação.
        </p>

        <div class="mt-8 flex flex-wrap gap-4">
          <a href="#localizacao"
             class="px-6 py-3 rounded-xl bg-yellow-400 text-red-900 font-black hover:bg-yellow-300 transition shadow-lg">
            📍 Onde estamos
          </a>

          <a href="tel:+554332622063"
             class="px-6 py-3 rounded-xl bg-white/10 border border-white/30 font-semibold hover:bg-white/20 transition">
            📞 Ligar para a secretaria
          </a>
        </div>
      </div>

      <!-- BLOCO VISUAL -->
      <div class="hidden md:block">
        <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
          <p class="text-lg font-black text-yellow-300 mb-4">
            Atendimento Presencial
          </p>

          <ul class="space-y-3 text-white/90 text-sm">
            <li>✔ Matrículas e transferências</li>
            <li>✔ Informações sobre cursos técnicos</li>
            <li>✔ Documentação escolar</li>
            <li>✔ Projetos, estágios e atividades</li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <!-- CONTATO DIRETO -->
  <section class="py-24 bg-white border-t">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-start">

      <!-- INFO -->
      <div>
        <h2 class="text-3xl font-black text-red-800 mb-6">
          📌 Secretaria do CEEP Assaí
        </h2>

        <p class="text-slate-700 text-lg leading-relaxed mb-8">
          Se preferir, venha até nós ou entre em contato por telefone.
          Nossa equipe está pronta para ajudar.
        </p>

        <div class="space-y-5 text-slate-800">

          <div class="flex items-start gap-4">
            <span class="text-2xl">📍</span>
            <div>
              <p class="font-bold">Endereço</p>
              <p class="text-slate-600">
                Rua Edgar Bardal, s/n<br>
                Assaí – PR • CEP 86220-000
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="text-2xl">📞</span>
            <div>
              <p class="font-bold">Telefone da Secretaria</p>
              <p class="text-slate-600">(43) 3262-2063</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="text-2xl">🕘</span>
            <div>
              <p class="font-bold">Horário de Atendimento</p>
              <p class="text-slate-600">
                Segunda a sexta-feira<br>
                Horário comercial
              </p>
            </div>
          </div>

        </div>
      </div>

      <!-- MAPA -->
      <div id="localizacao" class="w-full h-[420px] rounded-3xl overflow-hidden border shadow-lg">
        <iframe
          class="w-full h-full"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://www.google.com/maps?q=Centro+Estadual+de+Educação+Profissional+Assaí&output=embed">
        </iframe>
      </div>

    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="py-20 bg-slate-100 border-t">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h3 class="text-2xl md:text-3xl font-black text-red-800 mb-4">
        O CEEP Assaí está de portas abertas
      </h3>
      <p class="text-slate-600 text-lg mb-8">
        Educação técnica, projetos reais e pessoas que fazem acontecer.
      </p>

      <a href="{{ route('home') }}"
         class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-red-700 text-white font-bold hover:bg-red-800 transition shadow">
        ← Voltar ao portal
      </a>
    </div>
  </section>

</main>

@include('layouts.footer')
