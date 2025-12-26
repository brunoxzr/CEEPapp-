@include('layouts.header', ['title' => 'Institucional (Admin) — CEEP Assaí'])

<main class="bg-slate-50 py-10">
  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-end justify-between gap-6 mb-8">
      <div>
        <h1 class="text-3xl font-black text-red-900">Institucional</h1>
        <p class="text-slate-600 mt-1">Cadastre direção, coordenação, pedagogia e equipe técnica (com foto e perfil).</p>
      </div>

      <a href="{{ route('admin.institucional.create') }}"
         class="px-5 py-3 bg-red-700 text-white font-bold rounded-xl hover:bg-red-800 transition">
        + Adicionar pessoa
      </a>
    </div>

    @if(session('ok'))
      <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-semibold">
        {{ session('ok') }}
      </div>
    @endif

    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-slate-50 text-slate-700">
            <tr>
              <th class="text-left px-5 py-4 font-black">Pessoa</th>
              <th class="text-left px-5 py-4 font-black">Cargo</th>
              <th class="text-left px-5 py-4 font-black">Nível</th>
              <th class="text-left px-5 py-4 font-black">Ordem</th>
              <th class="text-left px-5 py-4 font-black">Status</th>
              <th class="text-right px-5 py-4 font-black">Ações</th>
            </tr>
          </thead>

          <tbody class="divide-y">
            @forelse($pessoas as $p)
              <tr class="hover:bg-slate-50/70">
                <td class="px-5 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                      @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" class="w-full h-full object-cover" alt="{{ $p->nome }}">
                      @endif
                    </div>
                    <div class="leading-tight">
                      <div class="font-black text-slate-900">{{ $p->nome }}</div>
                      <div class="text-xs text-slate-500 font-mono">{{ $p->slug }}</div>
                    </div>
                  </div>
                </td>

                <td class="px-5 py-4 font-semibold text-slate-800">{{ $p->cargo }}</td>
                <td class="px-5 py-4">
                  <span class="px-3 py-1 rounded-full bg-red-50 text-red-800 font-black">
                    {{ $p->nivel }}
                  </span>
                </td>
                <td class="px-5 py-4 font-mono text-slate-700">{{ $p->ordem }}</td>
                <td class="px-5 py-4">
                  @if($p->ativo)
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-black">Ativo</span>
                  @else
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-black">Oculto</span>
                  @endif
                </td>

                <td class="px-5 py-4">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.institucional.edit', $p->id) }}"
                       class="px-3 py-2 rounded-lg bg-yellow-400 text-red-950 font-black hover:bg-yellow-300 transition">
                      Editar
                    </a>

                    <form method="POST"
                          action="{{ route('admin.institucional.destroy', $p->id) }}"
                          onsubmit="return confirm('Excluir esta pessoa do Institucional?')">
                      @csrf
                      @method('DELETE')
                      <button class="px-3 py-2 rounded-lg bg-red-700 text-white font-black hover:bg-red-800 transition">
                        Excluir
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                  Nenhuma pessoa cadastrada ainda.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-8">
      {{ $pessoas->links() }}
    </div>

  </div>
</main>

@include('layouts.footer')
