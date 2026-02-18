@extends('layouts.admin_professor')

@section('content')
<section class="max-w-5xl mx-auto px-6 mt-10 space-y-8">

  {{-- ================= HEADER PREMIUM ================= --}}
  <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

    <div class="relative">
      <h1 class="text-3xl font-black">
        Nova Atividade
      </h1>

      <p class="mt-2 text-white/90 text-sm">
        Disciplina:
        <span class="text-yellow-300 font-semibold text-base">
          {{ $disciplina->nome }}
        </span>
      </p>

      <p class="text-sm text-white/80 mt-1">
        Turmas atendidas:
        <span class="font-semibold">
          {{ $turmas->implode(', ') }}
        </span>
      </p>
    </div>

  </div>


  {{-- ================= ERROS ================= --}}
  @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-5 rounded-xl shadow-sm">
      <p class="font-bold mb-2">Verifique os campos abaixo:</p>
      <ul class="list-disc list-inside text-sm space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif


  {{-- ================= FORM CARD ================= --}}
  <form method="POST"
        action="{{ route('professor.atividades.store', $disciplina->id) }}"
        class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 space-y-8">

    @csrf

    {{-- TÍTULO --}}
    <div>
      <label class="block text-sm font-bold text-slate-700 mb-2">
        Título da atividade
      </label>

      <input type="text"
             name="titulo"
             value="{{ old('titulo') }}"
             required
             class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">
    </div>


    {{-- DESCRIÇÃO --}}
    <div>
      <label class="block text-sm font-bold text-slate-700 mb-2">
        Descrição / Enunciado
      </label>

      <textarea name="descricao"
                rows="5"
                class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition resize-none">{{ old('descricao') }}</textarea>
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
          @foreach($turmas as $turma)
            <option value="{{ $turma }}"
              @selected(old('turma') == $turma)>
              {{ $turma }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- DATA LIMITE --}}
      <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">
          Data limite (opcional)
        </label>

        <input type="date"
               name="data_limite"
               value="{{ old('data_limite') }}"
               class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700 focus:border-red-700 transition">
      </div>

    </div>
{{-- TIPO + VISIBILIDADE --}}
<div class="grid md:grid-cols-2 gap-6">

  {{-- TIPO --}}
  <div>
    <label class="block text-sm font-bold text-slate-700 mb-2">
      Tipo
    </label>

    <select name="tipo"
            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-700">

      <option value="atividade" @selected(old('tipo')=='atividade')>
        Atividade (com entrega)
      </option>

      <option value="chamada" @selected(old('tipo')=='chamada')>
        Chamada (presença)
      </option>

    </select>
  </div>

  {{-- VISÍVEL --}}
  <div class="flex items-center gap-3 mt-8">

    <input type="checkbox"
           name="visivel_aluno"
           value="1"
           checked
           class="w-5 h-5 text-red-700 rounded border-slate-300">

    <label class="text-sm font-semibold text-slate-700">
      Mostrar para o aluno
    </label>

  </div>

</div>


    {{-- ================= FOOTER ================= --}}
    <div class="flex justify-between items-center pt-6 border-t">

      <a href="{{ route('professor.atividades.disciplina', $disciplina->id) }}"
         class="text-slate-600 hover:text-red-800 transition font-semibold">
        ← Voltar
      </a>

      <button type="submit"
              class="px-8 py-3 bg-red-700 text-white rounded-lg hover:bg-red-800 transition font-bold shadow-md">
        Salvar atividade
      </button>

    </div>

  </form>

</section>
@endsection
