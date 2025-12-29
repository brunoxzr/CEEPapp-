@include('layouts.admin_nav', ['title' => 'Novo Projeto Técnico'])
@include('layouts.sidebar')

<section class="max-w-4xl mx-auto px-4 mt-8 space-y-6">

  {{-- HEADER --}}
  <div class="bg-white border rounded-2xl p-6 shadow-sm">
    <h1 class="text-3xl font-black text-red-800">
      🚀 Criar Projeto Técnico
    </h1>
    <p class="text-slate-600 mt-1">
      Publique um projeto para os alunos participarem e para exibição pública no CEEP.
    </p>
  </div>

  {{-- FORM --}}
  <form action="{{ route('professor.projetos.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white border rounded-2xl p-6 shadow-sm space-y-6">
    @csrf

    {{-- TÍTULO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Título do Projeto</label>
      <input type="text" name="titulo" required
             class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600"
             placeholder="Ex: Sistema de Monitoramento Escolar com IA">
    </div>

    {{-- CURSO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Curso</label>
      <select name="curso" required
              class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">
        <option value="">Selecione</option>
        <option value="Desenvolvimento de Sistemas">Desenvolvimento de Sistemas</option>
        <option value="Enfermagem">Enfermagem</option>
        <option value="Mecânica">Mecânica</option>
        <option value="Eletrotécnica">Eletrotécnica</option>
        <option value="Edificações">Edificações</option>
        <option value="Agropecuária">Agropecuária</option>
      </select>
    </div>

    {{-- DESCRIÇÃO --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Descrição do Projeto</label>
      <textarea name="descricao" rows="5" required
                class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600"
                placeholder="Explique o objetivo, tecnologias utilizadas e proposta do projeto..."></textarea>
    </div>

    {{-- IMAGEM --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Imagem do Projeto (opcional)</label>
      <input type="file" name="imagem" accept="image/*"
             class="w-full rounded-xl border-slate-300">
    </div>

    {{-- STATUS --}}
    <div>
      <label class="block font-bold text-slate-700 mb-1">Status</label>
      <select name="status" required
              class="w-full rounded-xl border-slate-300 focus:ring-red-600 focus:border-red-600">
        <option value="rascunho">Rascunho (somente professor)</option>
        <option value="publicado">Publicado (visível no site)</option>
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
        💾 Publicar Projeto
      </button>
    </div>

  </form>

</section>

@include('layouts.footer')
