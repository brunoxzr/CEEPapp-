@include('layouts.admin_nav', ['title' => 'Disciplinas'])

<main class="flex-1 bg-slate-50 py-10">
  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-center justify-between mb-8">
      <h1 class="text-2xl font-black text-red-800">Disciplinas</h1>

      <a href="{{ route('admin.disciplinas.create') }}"
         class="px-5 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
        + Nova Disciplina
      </a>
    </div>

    @if(session('ok'))
      <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl">
        {{ session('ok') }}
      </div>
    @endif

    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
          <tr>
            <th class="px-6 py-4 text-left">Nome</th>
            <th class="px-6 py-4 text-left">Código</th>
            <th class="px-6 py-4 text-right">Ações</th>
          </tr>
        </thead>

        <tbody class="divide-y">
          @forelse($disciplinas as $d)
            <tr>
              <td class="px-6 py-4 font-semibold text-slate-800">
                {{ $d->nome }}
              </td>

              <td class="px-6 py-4 text-slate-500 font-mono">
                {{ $d->codigo }}
              </td>

              <td class="px-6 py-4 text-right flex justify-end gap-3">
                <a href="{{ route('admin.disciplinas.edit', $d->id) }}"
                   class="px-4 py-2 text-xs font-bold bg-slate-200 rounded-lg hover:bg-slate-300">
                  Editar
                </a>

                <form method="POST"
                      action="{{ route('admin.disciplinas.delete', $d->id) }}"
                      onsubmit="return confirm('Remover esta disciplina?')">
                  @csrf
                  @method('DELETE')
                  <button
                    class="px-4 py-2 text-xs font-bold bg-red-700 text-white rounded-lg hover:bg-red-800">
                    Excluir
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-6 py-10 text-center text-slate-500">
                Nenhuma disciplina cadastrada.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</main>
