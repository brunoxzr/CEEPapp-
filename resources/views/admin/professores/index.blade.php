@include('layouts.admin_nav', ['title' => 'Gestor — Professores'])
@include('layouts.sidebar')

<main class="bg-slate-50 py-10">
  <div class="max-w-7xl mx-auto px-6">

    <div class="flex items-center justify-between mb-10">
      <h1 class="text-2xl font-black">Professores</h1>

      <a href="{{ route('admin.usuarios') }}"
         class="px-5 py-3 bg-red-700 text-white rounded-xl font-bold hover:bg-red-800">
        Criar Professor
      </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($professores as $professor)
        <div class="bg-white border rounded-xl p-6 shadow">

          <h2 class="text-lg font-bold text-red-800">
            {{ $professor->nome }}
          </h2>

          <p class="text-sm text-slate-600">
            {{ $professor->email }}
          </p>

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

          <a href="{{ route('admin.professores.edit', $professor->id) }}"
             class="mt-4 inline-block text-sm font-bold text-red-700 hover:underline">
            Editar disciplinas →
          </a>
        </div>
      @endforeach
    </div>

  </div>
</main>

@include('layouts.footer')
