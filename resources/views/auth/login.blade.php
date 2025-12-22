<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área Acadêmica — CEEP Assaí</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex">

<!-- LADO ESQUERDO (IMAGEM) -->
<div class="hidden lg:flex w-2/3 relative">
    <img src="/img/bgLogin.jpg"
         class="absolute inset-0 w-full h-full object-cover"
         alt="CEEP Assaí">

    <div class="absolute inset-0 bg-red-900/70"></div>

    <div class="relative z-10 flex items-center justify-center w-full px-16 text-white">
        <h1 class="text-4xl font-extrabold leading-tight max-w-xl">
            Bem-vindo à<br>
            Área Acadêmica do<br>
            <span class="text-yellow-300">CEEP Assaí</span>
        </h1>
    </div>
</div>

<!-- LADO DIREITO (LOGIN) -->
<div class="w-full lg:w-1/3 flex items-center justify-center bg-white px-8">

    <div class="w-full max-w-md">

        <div class="mb-10 text-center">
            <img src="/img/logoCeep.png" class="mx-auto w-20 mb-4">
            <h2 class="text-2xl font-black text-red-800">Área Acadêmica</h2>
            <p class="text-sm text-slate-500 mt-1">
                Alunos e gestores
            </p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 text-sm bg-red-50 border border-red-200 text-red-700 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.unificado.submit') }}" class="space-y-5">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-semibold text-slate-700">E-mail</label>
                <input type="email"
                       name="email"
                       required
                       class="w-full mt-1 px-4 py-2 border rounded focus:ring-2 focus:ring-yellow-400 outline-none"
                       placeholder="seu@email.com">
            </div>

            <!-- SENHA -->
            <div>
                <label class="text-sm font-semibold text-slate-700">Senha</label>
                <input type="password"
                       name="senha"
                       required
                       class="w-full mt-1 px-4 py-2 border rounded focus:ring-2 focus:ring-yellow-400 outline-none"
                       placeholder="••••••••">
            </div>

            <button
                class="w-full py-2.5 bg-red-800 text-white font-bold rounded hover:bg-red-900 transition">
                Acessar
            </button>
        </form>

        <p class="mt-8 text-xs text-center text-slate-500">
            © CEEP Assaí — Ensino Público Estadual
        </p>

    </div>
</div>

</body>
</html>
