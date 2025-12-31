@include('layouts.admin_nav', ['title' => 'Gestor — Professores'])
@include('layouts.sidebar')

<main class="bg-slate-50 py-10">
  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-center justify-between mb-10">
      <h1 class="text-2xl font-black">Professores</h1>

      <a href="{{ route('admin.professores.create') }}"
         class="px-5 py-3 bg-red-700 text-white rounded-xl font-bold hover:bg-red-800">
        Criar Professor
      </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($professores as $professor)
        <div class="bg-white border rounded-xl p-6 shadow flex flex-col justify-between">

          {{-- INFO --}}
          <div>
            <h2 class="text-lg font-bold text-red-800">
              {{ $professor->nome }}
            </h2>

            <p class="text-sm text-slate-600">
              {{ $professor->email }}
            </p>

            {{-- DISCIPLINAS --}}
            <div class="mt-4">
              <p class="text-xs font-bold text-slate-500 uppercase mb-2">
                Disciplinas
              </p>

              @forelse($professor->disciplinas as $d)
                <span class="inline-block px-3 py-1 text-xs font-semibold
                             bg-slate-100 rounded-full mr-2 mb-2">
                  {{ $d->nome }}
                </span>
              @empty
                <span class="text-xs text-red-600">
                  Nenhuma disciplina atribuída
                </span>
              @endforelse
            </div>
          </div>

          {{-- AÇÕES --}}
          <div class="mt-6 flex flex-wrap gap-3">

            {{-- EDITAR DADOS --}}
            <a href="{{ route('admin.usuarios.edit', ['tipo' => 'admin', 'id' => $professor->id]) }}"
               class="px-3 py-2 text-xs font-bold rounded-lg
                      bg-slate-100 text-slate-700 hover:bg-slate-200">
              ✏️ Editar dados
            </a>

            {{-- EDITAR DISCIPLINAS --}}
            <a href="{{ route('admin.professores.edit', $professor->id) }}"
               class="px-3 py-2 text-xs font-bold rounded-lg
                      bg-red-700 text-white hover:bg-red-800">
              📚 Disciplinas
            </a>
<form method="POST"
      action="{{ route('admin.professores.delete', ['tipo' => 'admin', 'id' => $professor->id]) }}"
      onsubmit="return confirm('Tem certeza que deseja excluir este professor? Essa ação não pode ser desfeita.')">
  @csrf
  @method('DELETE')

  <button
    type="submit"
    class="px-3 py-2 text-xs font-bold rounded-lg
           bg-red-100 text-red-700 hover:bg-red-200">
    🗑️ Excluir
  </button>
</form>


          </div>

        </div>
      @endforeach
    </div>

  </div>
</main>

@include('layouts.footer')
