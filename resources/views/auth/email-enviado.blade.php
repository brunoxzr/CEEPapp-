<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>E-mail enviado — CEEP Assaí</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-100 px-6">

    <div class="w-full max-w-md bg-white border rounded-2xl shadow-lg p-8 text-center">

        <div class="mb-6 flex justify-center">
            <img src="/img/logo_ceep.jpeg"
                 alt="CEEP Assaí"
                 class="w-24 h-24 object-contain">
        </div>

        <h1 class="text-2xl font-black text-red-800 mb-2">
            Verifique seu e-mail
        </h1>

        <p class="text-slate-600 text-sm leading-relaxed">
            Se o e-mail informado estiver cadastrado, você receberá um link para redefinir sua senha.
            O link expira em 1 hora.
        </p>

        <a href="{{ route('login.unificado') }}"
           class="mt-6 inline-block px-5 py-3 bg-red-800 text-white font-bold rounded-xl hover:bg-red-900 transition shadow-md">
            Voltar para o login
        </a>

    </div>

</body>
</html>