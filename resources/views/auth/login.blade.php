<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área Acadêmica — CEEP Assaí</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont,
                         "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial;
        }

        .glass {
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100">

<div class="min-h-screen flex">

    <!-- ================= LADO ESQUERDO ================= -->
    <section class="hidden lg:flex w-2/3 relative overflow-hidden">

        <img src="/img/bgLogin.jpg"
             class="absolute inset-0 w-full h-full object-cover scale-105"
             alt="CEEP Assaí">

        <div class="absolute inset-0 bg-gradient-to-br from-red-950/95 via-red-900/85 to-red-700/70"></div>
        <div class="absolute inset-0 bg-black/10"></div>

        <!-- Detalhes decorativos -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-yellow-300/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-400/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex items-center justify-center w-full px-20 text-white">
            <div class="max-w-2xl">



                <h1 class="mt-8 text-5xl font-black leading-tight tracking-tight">
                    Bem-vindo à<br>
                    Área Acadêmica do<br>
                    <span class="text-yellow-300">CEEP Assaí</span>
                </h1>

                <p class="mt-5 text-lg text-red-50/90 leading-relaxed">
                    Um ambiente digital para alunos, professores e gestores acompanharem informações acadêmicas,
                    cronogramas, atividades institucionais e comunicados escolares.
                </p>

                <div class="mt-10 grid grid-cols-2 gap-4 max-w-lg">



                </div>

            </div>
        </div>
    </section>

    <!-- ================= LADO DIREITO ================= -->
    <section class="w-full lg:w-1/3 relative flex items-center justify-center bg-white px-6 sm:px-8 py-10">

        <!-- Botão voltar para portal -->
        <a href="{{ url('/') }}"
           class="absolute top-6 left-6 inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-red-800 transition group">

            <span class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center bg-white shadow-sm group-hover:border-red-200 group-hover:bg-red-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2.2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 19l-7-7 7-7" />
                </svg>
            </span>

            <span class="hidden sm:inline">
                Voltar para o portal
            </span>
        </a>

        <div class="w-full max-w-md">

            <!-- Logo / Cabeçalho -->
            <div class="mb-8 text-center">

                <div class="flex justify-center items-center gap-5 mb-6">
                    <div class="w-24 h-24 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-center bg-white">
                        <img src="/img/logo_ceep.jpeg"
                             alt="CEEP Assaí"
                             class="w-20 h-20 object-contain">
                    </div>

                    <div class="w-24 h-24 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-center bg-white">
                        <img src="/img/logo_parana.png"
                             alt="Paraná"
                             class="w-20 h-20 object-contain">
                    </div>
                </div>

                <h2 class="text-3xl font-black text-red-900 tracking-tight">
                    Área Acadêmica
                </h2>

                <p class="text-sm text-slate-500 mt-2">
                    Acesse sua conta institucional
                </p>
            </div>

            <!-- Mensagem de erro -->
            @if($errors->any())
                <div class="mb-5 p-4 text-sm bg-red-50 border border-red-200 text-red-700 rounded-2xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Mensagem de sucesso -->
            @if(session('success'))
                <div class="mb-5 p-4 text-sm bg-green-50 border border-green-200 text-green-700 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Login -->
            <div class="bg-white border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/70 p-7 sm:p-8">

                <form method="POST"
                      action="{{ route('login.unificado.submit') }}"
                      class="space-y-5">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm font-bold text-slate-700">
                            E-mail institucional
                        </label>

                        <div class="relative mt-2">
                            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>

                            <input type="email"
                                   name="email"
                                   required
                                   autocomplete="username"
                                   class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-2xl bg-slate-50
                                          focus:bg-white focus:ring-2 focus:ring-red-700/20
                                          focus:border-red-700 outline-none transition"
                                   placeholder="seu@email.com">
                        </div>
                    </div>

                    <!-- SENHA -->
                    <div>
                        <label class="text-sm font-bold text-slate-700">
                            Senha
                        </label>

                        <div class="relative mt-2">
                            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-.75 11.25h10.5A2.25 2.25 0 0019.5 19.5v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>

                            <input type="password"
                                   name="senha"
                                   required
                                   autocomplete="current-password"
                                   class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-2xl bg-slate-50
                                          focus:bg-white focus:ring-2 focus:ring-red-700/20
                                          focus:border-red-700 outline-none transition"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- ESQUECI SENHA -->
                    <div class="text-right">
                        <a href="{{ route('senha.esqueci') }}"
                           class="text-sm font-bold text-red-800 hover:text-red-900 hover:underline">
                            Esqueci minha senha
                        </a>
                    </div>

                    <button type="submit"
                            class="w-full py-3.5 bg-red-800 text-white font-black rounded-2xl
                                   hover:bg-red-900 transition shadow-lg shadow-red-900/20
                                   active:scale-[0.99]">
                        Acessar sistema
                    </button>
                </form>

                <!-- Links -->
                <div class="mt-6 pt-6 border-t border-slate-100 text-center text-sm text-slate-500">
                    <p>
                        Não possui acesso?
                        <a href="{{ route('portal.contato') }}"
                           class="font-bold text-red-800 hover:underline">
                            Entre em contato
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-8 text-xs text-center text-slate-400 leading-relaxed">
                Desenvolvido por <span class="font-semibold text-slate-500">Bruno Kay</span> © 2026<br>
                CEEP Assaí — Ensino Público Estadual
            </p>

        </div>
    </section>

</div>

</body>
</html>