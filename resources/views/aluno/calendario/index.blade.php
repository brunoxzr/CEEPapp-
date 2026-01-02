@include('layouts.aluno_nav', ['title' => 'Calendário Institucional'])

@php
    use Carbon\Carbon;

    $primeiroDia = $inicioMes->copy()->startOfWeek(Carbon::SUNDAY);
    $ultimoDia   = $inicioMes->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
@endphp

<main class="max-w-7xl mx-auto px-6 mt-10 mb-20">

    {{-- ================= CABEÇALHO ================= --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-6">

        <div>
            <h1 class="text-3xl font-black text-red-800">
                Calendário Institucional
            </h1>
            <p class="text-slate-600 mt-1">
                {{ Carbon::create($ano, $mes)->translatedFormat('F Y') }}
            </p>
        </div>

        {{-- FILTRO --}}
        <form method="GET" class="flex gap-2 flex-wrap">

            <select name="tipo"
                    class="border rounded-lg px-4 py-2 text-sm">
                <option value="">Todos os tipos</option>
                <option value="reuniao" @selected($tipo=='reuniao')>Reunião</option>
                <option value="conselho" @selected($tipo=='conselho')>Conselho</option>
                <option value="evento" @selected($tipo=='evento')>Evento</option>
                <option value="outro" @selected($tipo=='outro')>Outro</option>
            </select>

            <button class="px-4 py-2 bg-red-700 text-white font-bold rounded-lg">
                Filtrar
            </button>
        </form>
    </div>

    {{-- ================= CALENDÁRIO ================= --}}
    <div class="grid grid-cols-7 gap-px bg-slate-300 rounded-xl overflow-hidden">

        {{-- SEMANA --}}
        @foreach(['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'] as $d)
            <div class="bg-slate-100 text-center font-bold py-3">
                {{ $d }}
            </div>
        @endforeach

        {{-- DIAS --}}
        @for($data = $primeiroDia; $data <= $ultimoDia; $data->addDay())

            @php
                $key = $data->format('Y-m-d');
                $ehHoje = $data->isToday();
                $ehMesAtual = $data->month == $mes;
            @endphp

            <div class="min-h-[130px] p-2
                {{ !$ehMesAtual ? 'bg-slate-50 text-slate-400' : 'bg-white' }}
                {{ $ehHoje ? 'ring-2 ring-yellow-400' : '' }}">

                <div class="flex justify-between text-sm font-bold mb-1">
                    <span>{{ $data->day }}</span>
                    @if($ehHoje)
                        <span class="text-yellow-600 text-[10px]">HOJE</span>
                    @endif
                </div>

                {{-- EVENTOS --}}
                @if(isset($eventos[$key]))
                    <div class="space-y-1">
                        @foreach($eventos[$key] as $e)
                            <div class="bg-red-100 text-red-800 text-xs p-2 rounded shadow">
                                <p class="font-bold truncate">
                                    {{ $e->titulo }}
                                </p>

                                @if($e->hora_inicio)
                                    <p class="font-mono text-[11px]">
                                        {{ $e->hora_inicio }}
                                        @if($e->hora_fim)
                                            - {{ $e->hora_fim }}
                                        @endif
                                    </p>
                                @endif

                                <p class="italic text-[11px]">
                                    {{ ucfirst($e->tipo) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        @endfor
    </div>

</main>

@include('layouts.footer')
