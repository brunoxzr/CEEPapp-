@include('layouts.admin_nav', ['title' => 'Meus Projetos Técnicos'])
@include('layouts.sidebar')

<section class="max-w-6xl mx-auto px-4 mt-8 space-y-6">

  {{-- HEADER --}}
  <div class="flex justify-between items-center">
    <div>
      <h1 class="text-3xl font-black text-red-800">
        📁 Meus Projetos Técnicos
      </h1>
      <p class="text-slate-600 mt-1">
        Projetos desenvolvidos com seus alunos.
      </p>
    </div>

    <a href="{{ route('professor.projetos.create') }}"
       class="px-5 py-2.5 rounded-xl bg-red-700 text-white font-bold hover:bg-red-800 shadow">
      ➕ Novo Projeto
    </a>
  </div>

  {{-- LISTAGEM --}}
  @if($projetos->isEmpty())
    <div class="bg-white rounded-xl border p-8 text-center text-slate-500">
      Nenhum projeto cadastrado ainda.
    </div>
  @else
    <div class="grid md:grid-cols-2 gap-6">
      @foreach($projetos as $p)
        <div class="bg-white border rounded-2xl p-6 shadow hover:shadow-lg transition">

          <div class="flex justify-between items-start">
            <div>
              <h2 class="text-xl font-black text-red-800">
                {{ $p->titulo }}
              </h2>
              <p class="text-sm text-slate-600 mt-1">
                {{ Str::limit($p->descricao, 120) }}
              </p>
            </div>

            <span class="text-xs px-3 py-1 rounded-full font-bold
              {{ $p->status === 'publicado'
                ? 'bg-emerald-100 text-emerald-700'
                : 'bg-slate-100 text-slate-600' }}">
              {{ ucfirst($p->status) }}
            </span>
          </div>

          <div class="mt-4 flex justify-between items-center">
            <span class="text-xs text-slate-500">
              Criado em {{ $p->created_at->format('d/m/Y') }}
            </span>

            <a href="{{ route('professor.projetos.edit', $p->id) }}"
               class="text-sm font-bold text-red-700 hover:underline">
              ✏️ Editar
            </a>
          </div>

        </div>
      @endforeach
    </div>
  @endif

</section>

@include('layouts.footer')
