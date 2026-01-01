@include('layouts.admin_nav', ['title' => 'Calendário Institucional'])


@php
    use Carbon\Carbon;

    $primeiroDia = $inicioMes->copy()->startOfWeek(Carbon::SUNDAY);
    $ultimoDia   = $inicioMes->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
@endphp

<main class="max-w-7xl mx-auto px-6 mt-10 mb-20">

    {{-- ================= CABEÇALHO ================= --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <h1 class="text-3xl font-black text-red-800">
            📅 {{ Carbon::create($ano, $mes)->translatedFormat('F Y') }}
        </h1>

        <div class="flex gap-2 flex-wrap">

            {{-- MÊS ANTERIOR --}}
            <a href="{{ route('admin.calendario.index', [
                    'mes' => Carbon::create($ano, $mes)->subMonth()->month,
                    'ano' => Carbon::create($ano, $mes)->subMonth()->year
                ]) }}"
               class="px-4 py-2 bg-slate-200 rounded-lg font-bold hover:bg-slate-300">
                ←
            </a>

            {{-- PRÓXIMO MÊS --}}
            <a href="{{ route('admin.calendario.index', [
                    'mes' => Carbon::create($ano, $mes)->addMonth()->month,
                    'ano' => Carbon::create($ano, $mes)->addMonth()->year
                ]) }}"
               class="px-4 py-2 bg-slate-200 rounded-lg font-bold hover:bg-slate-300">
                →
            </a>

            {{-- NOVO EVENTO --}}
            <a href="{{ route('admin.calendario.create') }}"
               class="px-5 py-2 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
                + Novo evento
            </a>
        </div>
    </div>

    {{-- FLASH --}}
    @if(session('ok'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            {{ session('ok') }}
        </div>
    @endif

    {{-- ================= CALENDÁRIO ================= --}}
    <div class="grid grid-cols-7 gap-px bg-slate-300 rounded-xl overflow-hidden">

        {{-- DIAS DA SEMANA --}}
        @foreach(['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'] as $dia)
            <div class="bg-slate-100 text-center font-bold py-3">
                {{ $dia }}
            </div>
        @endforeach

        {{-- DIAS --}}
        @for($data = $primeiroDia; $data <= $ultimoDia; $data->addDay())

            @php
                $key = $data->format('Y-m-d');
                $ehMesAtual = $data->month == $mes;
                $ehHoje = $data->isToday();
            @endphp

            <div class="min-h-[140px] p-2 border
                {{ !$ehMesAtual ? 'bg-slate-50 text-slate-400' : 'bg-white' }}
                {{ $ehHoje ? 'ring-2 ring-yellow-400' : '' }}">

                {{-- DIA --}}
                <div class="flex justify-between items-center mb-1">
                    <span class="font-bold text-sm">
                        {{ $data->day }}
                    </span>

                    @if($ehHoje)
                        <span class="text-[10px] font-bold text-yellow-600">
                            HOJE
                        </span>
                    @endif
                </div>

                {{-- EVENTOS --}}
                @if(isset($eventos[$key]))
                    <div class="space-y-1">
                        @foreach($eventos[$key] as $e)

                            <div class="text-xs p-2 rounded bg-red-100 text-red-800 shadow-sm">

                                <p class="font-bold truncate">
                                    {{ $e->titulo }}
                                </p>

                                @if($e->hora_inicio)
                                    <p class="text-[11px] font-mono">
                                        {{ $e->hora_inicio }}
                                        @if($e->hora_fim)
                                            - {{ $e->hora_fim }}
                                        @endif
                                    </p>
                                @endif

                                <p class="text-[11px] italic">
                                    {{ ucfirst($e->tipo) }} • {{ ucfirst($e->publico) }}
                                </p>

                                {{-- AÇÕES --}}
                                <div class="flex gap-2 mt-1 text-[11px] font-bold">
                                    <a href="{{ route('admin.calendario.edit', $e->id) }}"
                                       class="text-blue-700 hover:underline">
                                        Editar
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.calendario.destroy', $e->id) }}"
                                          onsubmit="return confirm('Remover este evento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-700 hover:underline">
                                            Apagar
                                        </button>
                                    </form>
                                </div>

                            </div>

                        @endforeach
                    </div>
                @endif

            </div>
        @endfor
    </div>

</main>
