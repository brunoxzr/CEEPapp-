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

<!-- ================= LADO ESQUERDO ================= -->
<div class="hidden lg:flex w-2/3 relative overflow-hidden">

    <img src="/img/bgLogin.jpg"
         class="absolute inset-0 w-full h-full object-cover scale-105"
         alt="CEEP Assaí">

    <div class="absolute inset-0 bg-gradient-to-br from-red-900/90 via-red-800/75 to-red-700/60"></div>

    <div class="relative z-10 flex items-center justify-center w-full px-20 text-white">
        <div class="max-w-xl">
            <h1 class="text-4xl font-extrabold leading-tight">
                Bem-vindo à<br>
                Área Acadêmica do<br>
                <span class="text-yellow-300">CEEP Assaí</span>
            </h1>

            <p class="mt-3 text-lg text-red-100 leading-relaxed">
                Um ambiente digital para alunos, professores e gestores acompanharem informações acadêmicas,
                cronogramas e atividades institucionais.
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

<!-- ================= LADO DIREITO ================= -->
<div class="w-full lg:w-1/3 flex items-center justify-center bg-white px-8">

    <div class="w-full max-w-md">

        <!-- Logo / Cabeçalho -->
        <div class="mb-10 text-center">

            <div class="flex justify-center items-center gap-6 mb-6">
                <img src="/img/logo_ceep.jpeg"
                     alt="CEEP Assaí"
                     class="w-28 h-28 object-contain">

                <img src="/img/logo_parana.png"
                     alt="Paraná"
                     class="w-28 h-28 object-contain">
            </div>

            <h2 class="text-2xl font-black text-red-800">
                Área Acadêmica
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Acesso institucional
            </p>
        </div>

        <!-- Mensagem de erro -->
        @if($errors->any())
            <div class="mb-5 p-4 text-sm bg-red-50 border border-red-200 text-red-700 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Mensagem de sucesso -->
        @if(session('success'))
            <div class="mb-5 p-4 text-sm bg-green-50 border border-green-200 text-green-700 rounded-xl">
                {{ session('success') }}
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
                           autocomplete="username"
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
                           autocomplete="current-password"
                           class="w-full mt-2 px-4 py-3 border rounded-xl
                                  focus:ring-2 focus:ring-red-700
                                  focus:border-red-700 outline-none"
                           placeholder="••••••••">
                </div>

                <!-- ESQUECI SENHA -->
                <div class="text-right -mt-3">
                    <a href="{{ route('senha.esqueci') }}"
                       class="text-sm font-semibold text-red-700 hover:underline">
                        Esqueci minha senha
                    </a>
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
