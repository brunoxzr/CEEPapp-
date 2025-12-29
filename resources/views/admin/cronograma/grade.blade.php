@php
$horarios = [
    '07:20–08:10',
    '08:10–09:00',
    '09:10–09:50',
    '10:10–11:00',
    '11:00–11:40',
    '11:40–12:30',
];

$turmas = $itens->pluck('turma')->unique();
@endphp

<table class="w-full border">
<thead class="bg-red-700 text-white">
<tr>
    <th class="p-2">Turma</th>
    @foreach($horarios as $h)
        <th class="p-2">{{ $h }}</th>
    @endforeach
</tr>
</thead>

<tbody>
@foreach($turmas as $turma)
<tr class="border-b">
    <td class="font-bold p-2">{{ $turma }}</td>

    @foreach($horarios as $h)
        @php
            $aula = $itens->first(fn($i) =>
                $i->turma === $turma &&
                (\Carbon\Carbon::parse($i->inicio)->format('H:i') . '–' .
                 \Carbon\Carbon::parse($i->fim)->format('H:i')) === $h
            );
        @endphp

        <td class="p-2 text-sm border">
            @if($aula)
                <strong>{{ $aula->disciplina->nome }}</strong><br>
                <span class="text-xs">{{ $aula->professor->nome }}</span>
            @else
                —
            @endif
        </td>
    @endforeach
</tr>
@endforeach
</tbody>
</table>
