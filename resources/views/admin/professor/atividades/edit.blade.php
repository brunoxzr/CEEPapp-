@extends('layouts.admin_professor')

@section('content')
<section class="max-w-5xl mx-auto px-6 mt-10 space-y-8">

  {{-- ================= HEADER PREMIUM ================= --}}
  <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

    <div class="relative">
      <h1 class="text-3xl font-black">
        Editar {{ $atividade->tipo === 'chamada' ? 'Chamada' : 'Atividade' }}
      </h1>

      <p class="mt-2 text-white/90 text-sm">
        Disciplina:
        <span class="text-yellow-300 font-semibold text-base">
          {{ $disciplina->nome }}
        </span>
      </p>
    </div>
  </div>


  {{-- ================= FORM CARD ================= --}}
  <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 space-y-8">

    <form method="POST"
          action="{{ route('professor.atividades.update', [$disciplina->id, $atividade->id]) }}"
          class="space-y-8">

      @csrf
      @method('PUT')

      {{-- TIPO --}}
      <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">
          Tipo
        </label>

        <select name="tipo"
                required
                class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">

          <option value="atividade" @selected($atividade->tipo === 'atividade')>
            Atividade (aparece para o aluno)
          </option>

          <option value="chamada" @selected($atividade->tipo === 'chamada')>
            Chamada (controle interno de presença)
          </option>

        </select>
      </div>


      {{-- VISIBILIDADE --}}
      <div class="flex items-center gap-3">
        <input type="checkbox"
               name="visivel_aluno"
               value="1"
               @checked($atividade->visivel_aluno)
               class="w-5 h-5 text-red-700 border-slate-300 rounded focus:ring-red-600">

        <label class="text-sm font-semibold text-slate-700">
          Visível para o aluno
        </label>
      </div>


      {{-- TÍTULO --}}
      <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">
          Título
        </label>

        <input type="text"
               name="titulo"
               value="{{ old('titulo', $atividade->titulo) }}"
               required
               class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">
      </div>


      {{-- DESCRIÇÃO --}}
      <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">
          Descrição
        </label>

        <textarea name="descricao"
                  rows="5"
                  class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition resize-none">{{ old('descricao', $atividade->descricao) }}</textarea>
      </div>


      {{-- TURMA + DATA --}}
      <div class="grid md:grid-cols-2 gap-6">

        {{-- TURMA --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-2">
            Turma
          </label>

          <select name="turma"
                  required
                  class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">

            @foreach($turmas as $t)
              <option value="{{ $t }}"
                @selected($atividade->turma === $t)>
                {{ $t }}
              </option>
            @endforeach

          </select>
        </div>

        {{-- DATA LIMITE --}}
        <div>
          <label class="block text-sm font-bold text-slate-700 mb-2">
            Data limite
          </label>

          <input type="date"
                 name="data_limite"
                 value="{{ old('data_limite', $atividade->data_limite) }}"
                 class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">
        </div>

      </div>


      {{-- ================= AÇÕES ================= --}}
      <div class="flex justify-between items-center pt-6 border-t">

        <a href="{{ route('professor.atividades.disciplina', $disciplina->id) }}"
           class="text-slate-600 hover:text-red-800 transition font-semibold">
          ← Cancelar
        </a>

        <button type="submit"
                class="px-8 py-3 bg-red-700 text-white rounded-lg hover:bg-red-800 transition font-bold shadow-md">
          Salvar alterações
        </button>

      </div>

    </form>


    {{-- ================= EXCLUIR ================= --}}
    <div class="pt-6 border-t">

      <form method="POST"
            action="{{ route('professor.atividades.destroy', [$disciplina->id, $atividade->id]) }}"
            onsubmit="return confirm('Excluir esta atividade? Essa ação não pode ser desfeita.');">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold shadow-sm">
          Excluir atividade
        </button>

      </form>

    </div>

  </div>

</section>
@endsection
