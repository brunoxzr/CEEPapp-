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
    </style>
</head>

<body class="min-h-screen flex bg-slate-100">

<!-- ================= LADO ESQUERDO (HERO) ================= -->
<div class="hidden lg:flex w-2/3 relative overflow-hidden">

    <img src="/img/bgLogin.jpg"
         class="absolute inset-0 w-full h-full object-cover scale-105"
         alt="CEEP Assaí">

    <!-- Overlay gradiente elegante -->
    <div class="absolute inset-0 bg-gradient-to-br from-red-900/90 via-red-800/75 to-red-700/60"></div>

    <div class="relative z-10 flex items-center justify-center w-full px-20 text-white">
        <div class="max-w-xl">
            <h1 class="text-4xl font-extrabold leading-tight">
                Bem-vindo à<br>
                Área Acadêmica do<br>
                <span class="text-yellow-300">CEEP Assaí</span>
            </h1>

            <p class="mt-3 text-lg text-red-100 leading-relaxed">
                Um ambiente digital moderno para alunos, professores e gestores,
                integrando informações acadêmicas, cronogramas e projetos técnicos.
            </p>

            <div class="mt-10 flex items-center gap-4 text-sm text-red-100">
                <span class="px-4 py-2 border border-red-300/40 rounded-full">
                    Ensino Público Estadual
                </span>
                <span class="px-4 py-2 border border-red-300/40 rounded-full">
                    Paraná
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ================= LADO DIREITO (LOGIN) ================= -->
<div class="w-full lg:w-1/3 flex items-center justify-center bg-white px-8">

    <div class="w-full max-w-md">

        <!-- Logo / Cabeçalho -->
        <div class="mb-10 text-center">
            <img src="/img/logo_ceep.jpeg" class="mx-auto w-24 mb-5" alt="CEEP Assaí">
            <h2 class="text-2xl font-black text-red-800">Área Acadêmica</h2>
            <p class="text-sm text-slate-500 mt-1">
                Acesso institucional
            </p>
        </div>

        <!-- Erros -->
        @if($errors->any())
            <div class="mb-5 p-4 text-sm bg-red-50 border border-red-200 text-red-700 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Card Login -->
        <div class="bg-white border rounded-2xl shadow-lg p-8">

            <form method="POST"
                  action="{{ route('login.unificado.submit') }}"
                  class="space-y-6">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm font-semibold text-slate-700">
                        E-mail institucional
                    </label>
                    <input type="email"
                           name="email"
                           required
                           class="w-full mt-2 px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-red-700
                                  focus:border-red-700 outline-none"
                           placeholder="seu@email.com">
                </div>

                <!-- SENHA -->
                <div>
                    <label class="text-sm font-semibold text-slate-700">
                        Senha
                    </label>
                    <input type="password"
                           name="senha"
                           required
                           class="w-full mt-2 px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-red-700
                                  focus:border-red-700 outline-none"
                           placeholder="••••••••">
                </div>

                <button
                    class="w-full py-3 bg-red-800 text-white font-bold rounded-xl
                           hover:bg-red-900 transition shadow-md">
                    Acessar
                </button>
            </form>

            <!-- Links -->
            <div class="mt-6 text-center text-sm text-slate-500 space-y-2">
                <p>
                    Não possui acesso?
                    <a href="{{ route('portal.contato') }}"
                       class="font-semibold text-red-700 hover:underline">
                        Entre em contato
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <p class="mt-10 text-xs text-center text-slate-400 leading-relaxed">
            Desenvolvido por <span class="font-semibold">Bruno Kay</span> © 2026<br>
            CEEP Assaí — Ensino Público Estadual
        </p>

    </div>
</div>

</body>
</html>
