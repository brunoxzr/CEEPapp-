@include('layouts.admin_nav', ['title' => 'Editar Projeto Técnico'])
@include('layouts.sidebar')

<section class="max-w-4xl mx-auto px-4 mt-8 space-y-6">

  {{-- HEADER --}}
  <div class="bg-white border rounded-2xl p-6 shadow-sm">
    <h1 class="text-3xl font-black text-red-800">
      ✏️ Editar Projeto Técnico
    </h1>
    <p class="text-slate-600 mt-1">
      Atualize as informações do projeto publicado.
    </p>
  </div>

  {{-- FORM --}}
  <form action="{{ route('professor.projetos.update', $projeto->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white border rounded-2xl p-6 shadow-sm space-y-6">

    @csrf
    @method('PUT')

    {{-- TÍTULO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Título do Projeto</label>
      <input type="text" name="titulo" required
             value="{{ old('titulo', $projeto->titulo) }}"
             class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">
    </div>

    {{-- CURSO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Curso</label>
      <select name="curso" required
              class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">
        @foreach([
          'Desenvolvimento de Sistemas',
          'Enfermagem',
          'Mecânica',
          'Eletrotécnica',
          'Edificações',
          'Agropecuária'
        ] as $curso)
          <option value="{{ $curso }}"
            @selected(old('curso', $projeto->curso) === $curso)>
            {{ $curso }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- DESCRIÇÃO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Descrição</label>
      <textarea name="descricao" rows="5" required
                class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">{{ old('descricao', $projeto->descricao) }}</textarea>
    </div>

    {{-- IMAGEM ATUAL --}}
    @if($projeto->imagem)
      <div>
        <label class="block font-bold text-slate-700 mb-2">Imagem Atual</label>
        <img src="{{ asset('storage/'.$projeto->imagem) }}"
             class="rounded-xl max-h-56 border shadow">
      </div>
    @endif

    {{-- NOVA IMAGEM --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Alterar Imagem (opcional)</label>
      <input type="file" name="imagem" accept="image/*"
             class="w-full rounded-xl border-slate-300">
    </div>

    {{-- STATUS --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Status</label>
      <select name="status" required
              class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">
        <option value="rascunho" @selected($projeto->status === 'rascunho')>
          Rascunho
        </option>
        <option value="publicado" @selected($projeto->status === 'publicado')>
          Publicado
        </option>
      </select>
    </div>

    {{-- AÇÕES --}}
    <div class="flex justify-between items-center pt-4">
      <a href="{{ route('professor.projetos.index') }}"
         class="px-5 py-2.5 rounded-xl border font-bold text-slate-600 hover:bg-slate-50">
        ← Voltar
      </a>

      <button type="submit"
              class="px-6 py-2.5 rounded-xl bg-red-700 text-white font-black hover:bg-red-800 shadow">
        💾 Salvar Alterações
      </button>
    </div>

  </form>

</section>

@include('layouts.footer')
