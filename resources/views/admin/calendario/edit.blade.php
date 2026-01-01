@include('layouts.admin_nav', ['title' => 'Editar Evento'])


<main class="max-w-4xl mx-auto px-6 mt-10">

    <h1 class="text-3xl font-black text-red-800 mb-6">
        ✏️ Editar evento institucional
    </h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.calendario.update', $evento->id) }}"
          class="bg-white rounded-2xl shadow border p-8 space-y-6">

        @csrf
        @method('PUT')

        {{-- TÍTULO --}}
        <div>
            <label class="font-bold block mb-1">Título</label>
            <input type="text" name="titulo" required
                   value="{{ old('titulo', $evento->titulo) }}"
                   class="w-full border rounded-lg px-4 py-3">
        </div>

        {{-- DESCRIÇÃO --}}
        <div>
            <label class="font-bold block mb-1">Descrição</label>
            <textarea name="descricao"
                      class="w-full border rounded-lg px-4 py-3"
                      rows="3">{{ old('descricao', $evento->descricao) }}</textarea>
        </div>

        {{-- DATA --}}
        <div>
            <label class="font-bold block mb-1">Data</label>
            <input type="date" name="data" required
                   value="{{ old('data', $evento->data->format('Y-m-d')) }}"
                   class="border rounded-lg px-4 py-3">
        </div>

        {{-- HORÁRIOS --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold block mb-1">Hora início</label>
                <input type="time" name="hora_inicio"
                       value="{{ old('hora_inicio', $evento->hora_inicio) }}"
                       class="border rounded-lg px-4 py-3 w-full">
            </div>

            <div>
                <label class="font-bold block mb-1">Hora fim</label>
                <input type="time" name="hora_fim"
                       value="{{ old('hora_fim', $evento->hora_fim) }}"
                       class="border rounded-lg px-4 py-3 w-full">
            </div>
        </div>

        {{-- TIPO --}}
        <div>
            <label class="font-bold block mb-1">Tipo</label>
            <select name="tipo" required class="border rounded-lg px-4 py-3 w-full">
                @foreach(['reuniao','conselho','evento','outro'] as $tipo)
                    <option value="{{ $tipo }}"
                        {{ old('tipo', $evento->tipo) === $tipo ? 'selected' : '' }}>
                        {{ ucfirst($tipo) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PÚBLICO --}}
        <div>
            <label class="font-bold block mb-1">Público</label>
            <select name="publico" required class="border rounded-lg px-4 py-3 w-full">
                @foreach(['alunos','professores','todos'] as $pub)
                    <option value="{{ $pub }}"
                        {{ old('publico', $evento->publico) === $pub ? 'selected' : '' }}>
                        {{ ucfirst($pub) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ATIVO --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="ativo"
                   class="w-5 h-5 accent-red-700"
                   {{ old('ativo', $evento->ativo) ? 'checked' : '' }}>
            <span class="font-semibold">Evento ativo</span>
        </div>

        {{-- AÇÕES --}}
        <div class="flex justify-between pt-6 border-t">
            <a href="{{ route('admin.calendario.index') }}"
               class="font-bold text-slate-600 hover:underline">
                ← Voltar
            </a>

            <button type="submit"
                    class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg hover:bg-red-800 shadow">
                Atualizar evento
            </button>
        </div>

    </form>
</main>
