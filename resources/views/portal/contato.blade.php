@include('layouts.header', ['title' => 'Contato — CEEP Assaí'])

<main class="bg-slate-50 text-slate-800">

    <!-- HERO -->
    <section class="relative overflow-hidden bg-red-900 text-white">

        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-red-950 via-red-900 to-red-800"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-yellow-400/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full bg-red-500/20 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-24 lg:py-28 grid lg:grid-cols-2 gap-14 items-center">

            <div>
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 border border-white/15 backdrop-blur text-sm font-semibold text-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4 text-yellow-300"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.75 6.75l7.32 5.12a1.5 1.5 0 001.86 0l7.32-5.12" />
                    </svg>

                    Fale com o CEEP
                </div>

                <h1 class="mt-7 text-4xl md:text-5xl xl:text-6xl font-black leading-tight tracking-tight">
                    Atendimento do<br>
                    <span class="text-yellow-300">CEEP Assaí</span>
                </h1>

                <p class="mt-6 text-lg leading-relaxed text-red-50/90 max-w-xl">
                    Entre em contato com a secretaria para informações sobre cursos, matrículas,
                    documentos, projetos escolares e atendimento institucional.
                </p>

                <div class="mt-9 flex flex-col sm:flex-row gap-4">
                    <a href="#localizacao"
                       class="inline-flex items-center justify-center gap-3 px-6 py-3 rounded-2xl bg-yellow-400 text-red-950 font-black hover:bg-yellow-300 transition shadow-lg shadow-black/20">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 21s7-4.35 7-11a7 7 0 10-14 0c0 6.65 7 11 7 11z" />
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 10.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        </svg>
                        Ver localização
                    </a>

                    <a href="tel:+554332622063"
                       class="inline-flex items-center justify-center gap-3 px-6 py-3 rounded-2xl bg-white/10 border border-white/20 text-white font-bold hover:bg-white/15 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5A2.25 2.25 0 0021 19.5v-2.05a1.5 1.5 0 00-1.03-1.424l-3.11-1.036a1.5 1.5 0 00-1.66.51l-.75.94a11.25 11.25 0 01-4.89-4.89l.94-.75a1.5 1.5 0 00.51-1.66L9.974 6.03A1.5 1.5 0 008.55 5H6.5A2.25 2.25 0 004.25 7.25v-.5z" />
                        </svg>
                        Ligar para a secretaria
                    </a>
                </div>
            </div>

            <!-- BLOCO VISUAL -->
            <div class="hidden lg:block">
                <div class="relative rounded-[2rem] border border-white/15 bg-white/10 backdrop-blur-xl p-8 shadow-2xl shadow-black/20">

                    <div class="absolute -top-5 -right-5 w-20 h-20 rounded-3xl bg-yellow-400/20 border border-yellow-300/30"></div>

                    <div class="w-14 h-14 rounded-2xl bg-yellow-400 text-red-950 flex items-center justify-center mb-7">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8 7V3m8 4V3M4.5 11h15M6.75 21h10.5a2.25 2.25 0 002.25-2.25V7.5a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 7.5v11.25A2.25 2.25 0 006.75 21z" />
                        </svg>
                    </div>

                    <h2 class="text-2xl font-black text-white">
                        Atendimento presencial
                    </h2>

                    <p class="mt-3 text-red-50/80 leading-relaxed">
                        A secretaria realiza atendimento para solicitações escolares,
                        orientações acadêmicas e informações gerais sobre a instituição.
                    </p>

                    <div class="mt-8 space-y-4">

                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-yellow-300"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                            <p class="font-semibold text-red-50">Matrículas e transferências</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-yellow-300"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                            <p class="font-semibold text-red-50">Informações sobre cursos técnicos</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-yellow-300"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                            <p class="font-semibold text-red-50">Documentação escolar</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-yellow-300"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </span>
                            <p class="font-semibold text-red-50">Projetos, estágios e atividades</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- CONTATO DIRETO -->
    <section class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">

            <div class="max-w-2xl mb-14">
                <span class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-[0.22em] text-red-800">
                    <span class="w-8 h-px bg-red-700"></span>
                    Atendimento
                </span>

                <h2 class="mt-4 text-3xl md:text-4xl font-black text-slate-950 tracking-tight">
                    Secretaria do CEEP Assaí
                </h2>

                <p class="mt-4 text-lg leading-relaxed text-slate-600">
                    Para atendimento presencial ou por telefone, utilize as informações abaixo.
                    O suporte técnico do portal fica separado para facilitar o direcionamento correto.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 items-start">

                <!-- CARD SECRETARIA -->
                <div class="lg:col-span-1 rounded-3xl border border-slate-200 bg-slate-50 p-7 shadow-sm">

                    <h3 class="text-xl font-black text-red-900 mb-6">
                        Informações da secretaria
                    </h3>

                    <div class="space-y-6">

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-red-100 text-red-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 21s7-4.35 7-11a7 7 0 10-14 0c0 6.65 7 11 7 11z" />
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 10.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-black text-slate-900">Endereço</p>
                                <p class="mt-1 text-slate-600 leading-relaxed">
                                    Rua Edgar Bardal, s/n<br>
                                    Assaí — PR<br>
                                    CEP 86220-000
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-red-100 text-red-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5A2.25 2.25 0 0021 19.5v-2.05a1.5 1.5 0 00-1.03-1.424l-3.11-1.036a1.5 1.5 0 00-1.66.51l-.75.94a11.25 11.25 0 01-4.89-4.89l.94-.75a1.5 1.5 0 00.51-1.66L9.974 6.03A1.5 1.5 0 008.55 5H6.5A2.25 2.25 0 004.25 7.25v-.5z" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-black text-slate-900">Telefone</p>
                                <a href="tel:+554332622063"
                                   class="mt-1 inline-block text-red-800 font-bold hover:underline">
                                    (43) 3262-2063
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-red-100 text-red-800 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 6v6l4 2" />
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-black text-slate-900">Horário de atendimento</p>
                                <p class="mt-1 text-slate-600 leading-relaxed">
                                    Segunda a sexta-feira<br>
                                    Horário comercial
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- MAPA -->
                <div id="localizacao"
                     class="lg:col-span-2 h-[460px] rounded-3xl overflow-hidden border border-slate-200 shadow-xl shadow-slate-200/80 bg-slate-100">

                    <iframe
                        title="Localização do CEEP Assaí"
                        class="w-full h-full"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=Centro+Estadual+de+Educação+Profissional+Assaí&output=embed">
                    </iframe>
                </div>

            </div>

            <!-- SUPORTE TÉCNICO -->
            <div class="mt-10 rounded-3xl border border-slate-200 bg-white p-7 md:p-8 shadow-sm">

                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-8">

                    <div class="max-w-2xl">
                        <div class="w-13 h-13 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-red-900 text-white flex items-center justify-center shadow-lg shadow-red-900/20">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-7 h-7"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.607 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-slate-950">
                            Suporte técnico do portal
                        </h3>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Problemas de acesso, área do aluno, inconsistências no sistema ou dúvidas técnicas
                            relacionadas ao CEEPapp devem ser encaminhadas ao suporte responsável.
                        </p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 w-full md:max-w-xl">

                        <a href="mailto:bruno.kay2304@gmail.com"
                           class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 hover:border-red-200 hover:bg-red-50 transition">

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-white border border-slate-200 text-red-800 flex items-center justify-center shrink-0 group-hover:border-red-200">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M3.75 6.75l7.32 5.12a1.5 1.5 0 001.86 0l7.32-5.12" />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="font-black text-slate-900">E-mail</p>
                                    <p class="mt-1 text-sm text-slate-600 break-all">
                                        bruno.kay2304@gmail.com
                                    </p>
                                </div>
                            </div>
                        </a>

                        <a href="tel:+5543988506395"
                           class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 hover:border-red-200 hover:bg-red-50 transition">

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-white border border-slate-200 text-red-800 flex items-center justify-center shrink-0 group-hover:border-red-200">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5A2.25 2.25 0 0021 19.5v-2.05a1.5 1.5 0 00-1.03-1.424l-3.11-1.036a1.5 1.5 0 00-1.66.51l-.75.94a11.25 11.25 0 01-4.89-4.89l.94-.75a1.5 1.5 0 00.51-1.66L9.974 6.03A1.5 1.5 0 008.55 5H6.5A2.25 2.25 0 004.25 7.25v-.5z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-black text-slate-900">Telefone / WhatsApp</p>
                                    <p class="mt-1 text-sm text-slate-600">
                                        (43) 98850-6395
                                    </p>
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="py-20 bg-slate-100 border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <div class="mx-auto w-14 h-14 rounded-2xl bg-red-900 text-white flex items-center justify-center mb-6 shadow-lg shadow-red-900/20">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-7 h-7"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 12l9-9 9 9" />
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5.25 10.5V21h13.5V10.5" />
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 21v-6h6v6" />
                </svg>
            </div>

            <h3 class="text-2xl md:text-3xl font-black text-slate-950 mb-4">
                O CEEP Assaí está de portas abertas
            </h3>

            <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                Educação técnica, projetos reais e atendimento próximo da comunidade escolar.
            </p>

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-3 px-7 py-3 rounded-2xl bg-red-800 text-white font-black hover:bg-red-900 transition shadow-lg shadow-red-900/20">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>

                Voltar ao portal
            </a>

        </div>
    </section>

</main>

@include('layouts.footer')