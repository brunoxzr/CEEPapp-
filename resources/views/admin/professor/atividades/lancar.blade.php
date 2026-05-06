@extends('layouts.admin_professor')

@section('content')
<section class="max-w-7xl mx-auto px-6 mt-10 space-y-8">

  {{-- HEADER PREMIUM --}}
  <div class="bg-gradient-to-br from-red-800 via-red-700 to-red-600 text-white rounded-2xl shadow-xl p-8 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_#fde047,_transparent_60%)]"></div>

    <div class="relative">
      <h1 class="text-3xl font-black">
        {{ $atividade->tipo === 'chamada' ? 'Lançamento de Presença' : 'Correção de Atividade' }}
      </h1>

      <p class="mt-3 text-white/90 text-sm">
        <strong class="text-yellow-300 text-lg">{{ $atividade->titulo }}</strong><br>
        Turma: <span class="font-semibold">{{ $atividade->turma }}</span>

        @if($atividade->data_limite && $atividade->tipo === 'atividade')
          • Entrega até
          <span class="font-semibold">
            {{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y') }}
          </span>
        @endif
      </p>
    </div>
  </div>


  @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl shadow-sm">
      {{ session('success') }}
    </div>
  @endif


  <form method="POST"
        action="{{ route('professor.atividades.salvar', $atividade) }}"
        class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">

    @csrf

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">

        <thead class="bg-red-50 text-red-800">
          <tr>
            <th class="py-4 px-6 text-left font-bold uppercase text-xs">Aluno</th>
            <th class="py-4 px-6 text-center font-bold uppercase text-xs">
              {{ $atividade->tipo === 'chamada' ? 'Presença' : 'Status' }}
            </th>

            @if($atividade->tipo === 'atividade')
              <th class="py-4 px-6 text-center font-bold uppercase text-xs">Link</th>
              <th class="py-4 px-6 text-center font-bold uppercase text-xs">Nota</th>
              <th class="py-4 px-6 text-center font-bold uppercase text-xs">Feedback</th>
            @endif

          </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">

          @forelse($alunos as $aluno)

            @php
              $registro = $lancamentos[$aluno->id] ?? null;
              $status = $registro->status ?? 'pendente';
            @endphp

            <tr class="hover:bg-red-50/30 transition">

              {{-- ALUNO --}}
              <td class="py-4 px-6">
                <div class="font-semibold text-slate-800">
                  {{ $aluno->nome }}
                </div>

                @if($registro && $registro->entregue_em)
                  <div class="text-xs text-slate-500 mt-1">
                    Entregue em {{ \Carbon\Carbon::parse($registro->entregue_em)->format('d/m H:i') }}
                  </div>
                @endif
              </td>


              {{-- STATUS / PRESENÇA --}}
              <td class="py-4 px-6 text-center">

                @if($atividade->tipo === 'chamada')

                  {{-- CHECK PRESENÇA --}}
                  <label class="inline-flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="presenca[{{ $aluno->id }}]"
                        value="presente"
                        @checked($status === 'presente')
                        class="w-5 h-5 text-emerald-600 border-slate-300 rounded focus:ring-emerald-600"
                    >

                    <span class="text-sm font-semibold
                        {{ $status === 'presente' ? 'text-emerald-600' : 'text-slate-500' }}">
                        {{ $status === 'presente' ? 'Presente' : 'Ausente' }}
                    </span>

                  </label>

                @else

                  {{-- SELECT NORMAL --}}
                  <select name="status[{{ $aluno->id }}]"
                          class="border border-slate-300 rounded px-3 py-1 text-sm">

                      <option value="pendente" @selected($status=='pendente')>Pendente</option>
                      <option value="entregue" @selected($status=='entregue')>Entregue</option>
                      <option value="atrasado" @selected($status=='atrasado')>Atrasado</option>
                      <option value="corrigido" @selected($status=='corrigido')>Corrigido</option>

                  </select>

                @endif

              </td>


              @if($atividade->tipo === 'atividade')

                {{-- LINK DRIVE --}}
                <td class="py-4 px-6 text-center">
                  @if($registro && $registro->link_drive)
                    <a href="{{ $registro->link_drive }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition">
                      Abrir
                    </a>
                  @else
                    <span class="text-xs text-slate-400">—</span>
                  @endif
                </td>

                {{-- NOTA --}}
                <td class="py-4 px-6 text-center">
                  <input type="number"
                         step="0.1"
                         name="nota[{{ $aluno->id }}]"
                         value="{{ $registro->nota ?? '' }}"
                         class="w-20 border border-slate-300 rounded px-2 py-1 text-center">
                </td>

                {{-- FEEDBACK --}}
                <td class="py-4 px-6">
                  <input type="text"
                         name="feedback[{{ $aluno->id }}]"
                         value="{{ $registro->feedback ?? '' }}"
                         placeholder="Comentário..."
                         class="w-full border border-slate-300 rounded px-3 py-1 text-sm">
                </td>

              @endif

            </tr>

          @empty
            <tr>
              <td colspan="5" class="py-10 text-center text-slate-500">
                Nenhum aluno encontrado.
              </td>
            </tr>
          @endforelse

        </tbody>
      </table>
    </div>


    {{-- FOOTER --}}
    <div class="flex justify-between items-center px-6 py-5 bg-slate-50 border-t">

      <a href="{{ route('professor.atividades.disciplina', $atividade->disciplina_id) }}"
         class="px-5 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 transition font-semibold">
        ← Voltar
      </a>

      <button type="submit"
              class="px-6 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition font-semibold shadow-md">
        Salvar
      </button>

    </div>

  </form>

</section>
@endsection
