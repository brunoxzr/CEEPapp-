<?php /** @var \App\Models\Aluno $aluno */ ?>
@include('layouts.aluno_nav', ['title' => 'Atividade'])

<main class="max-w-4xl mx-auto px-6 py-10 space-y-8">

    <!-- HERO -->
    <section class="bg-white rounded-2xl shadow border border-slate-200 p-8">

        <h1 class="text-2xl font-black text-red-800">
            {{ $atividade->titulo }}
        </h1>

        <p class="mt-4 text-slate-700 leading-relaxed">
            {{ $atividade->descricao }}
        </p>

        <p class="mt-4 text-sm text-slate-500">
            Prazo:
            {{ optional($atividade->data_limite)->format('d/m/Y H:i') ?? 'Sem prazo' }}
        </p>

    </section>

    <!-- STATUS -->
    @if($entrega)
    <section class="bg-white rounded-2xl shadow border border-slate-200 p-6">

        <h2 class="font-bold text-red-800 mb-4">Status da Entrega</h2>

        <p class="text-sm">
            Status:
            <span class="font-black uppercase">
                {{ $entrega->status }}
            </span>
        </p>

        @if($entrega->link_drive)
            <p class="mt-2">
                <a href="{{ $entrega->link_drive }}"
                   target="_blank"
                   class="text-blue-600 font-semibold hover:underline">
                    Ver link enviado
                </a>
            </p>
        @endif

        @if($entrega->nota)
            <p class="mt-3 text-green-700 font-black">
                Nota: {{ $entrega->nota }}
            </p>
        @endif

        @if($entrega->feedback)
            <div class="mt-3 bg-slate-50 p-4 rounded-xl text-sm">
                <strong>Feedback:</strong>
                <p class="mt-1">{{ $entrega->feedback }}</p>
            </div>
        @endif

    </section>
    @endif

    <!-- FORM ENVIO -->
    <section class="bg-white rounded-2xl shadow border border-slate-200 p-8">

        <h2 class="text-lg font-black text-red-800 mb-6">
            Enviar atividade
        </h2>

        <form method="POST"
              action="{{ route('aluno.atividades.enviar', $atividade->id) }}"
              class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Link do Google Drive
                </label>

                <input type="url"
                       name="link_drive"
                       required
                       value="{{ $entrega->link_drive ?? '' }}"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-600 focus:outline-none">
            </div>

            <button type="submit"
                    class="px-6 py-3 bg-yellow-400 text-red-900 font-black rounded-xl hover:bg-yellow-300 transition shadow">
                Enviar atividade
            </button>

        </form>

    </section>

</main>

@include('layouts.footer')
