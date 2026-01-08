@include('layouts.admin_nav', ['title' => 'Leitura por Turma'])

<main class="max-w-4xl mx-auto px-6 mt-10">

    <h1 class="text-2xl font-black text-red-800 mb-2">
        {{ $comunicado->titulo }}
    </h1>

    <p class="text-slate-600 mb-6">
        Turma: <b>{{ $comunicado->turma ?? '—' }}</b>
    </p>

    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-red-50 text-red-800">
                <tr>
                    <th class="p-3 text-left">Aluno</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Lido em</th>
                </tr>
            </thead>

            <tbody>
                @foreach($alunos as $aluno)
                    @php
                        $leitura = $aluno->leituras->first();
                    @endphp

                    <tr class="border-t">
                        <td class="p-3 font-medium">
                            {{ $aluno->nome }}
                        </td>

                        <td class="p-3 text-center">
                            @if($leitura)
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold">
                                    Lido
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold">
                                    Não lido
                                </span>
                            @endif
                        </td>

                        <td class="p-3 text-center text-xs text-slate-500">
                            {{ $leitura?->lido_em?->format('d/m/Y H:i') ?? '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>
