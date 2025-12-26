@include('layouts.header', ['title' => 'Adicionar Pessoa — Institucional'])

<main class="bg-slate-50 py-12">
  <div class="max-w-5xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-900 mb-2">Adicionar pessoa</h1>
    <p class="text-slate-600 mb-8">
      Dica: <span class="font-semibold">Nível 1</span> fica no topo (Direção). Níveis maiores descem a pirâmide.
    </p>

    @if ($errors->any())
      <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 font-semibold">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST"
          action="{{ route('admin.institucional.store') }}"
          enctype="multipart/form-data"
          class="bg-white border rounded-2xl shadow-sm p-8 space-y-8">
      @csrf

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="block font-black mb-2">Nome</label>
          <input type="text" name="nome" id="nome"
                 value="{{ old('nome') }}"
                 class="w-full border rounded-xl px-4 py-3 focus:ring-red-500 focus:border-red-500"
                 placeholder="Ex: Maria Carolina" required>
          <p class="text-xs text-slate-500 mt-1">Exemplo: “Nome Sobrenome”.</p>
        </div>

        <div>
          <label class="block font-black mb-2">Cargo</label>
          <input type="text" name="cargo"
                 value="{{ old('cargo') }}"
                 class="w-full border rounded-xl px-4 py-3 focus:ring-red-500 focus:border-red-500"
                 placeholder="Ex: Diretora / Coordenador / Pedagogo" required>
          <p class="text-xs text-slate-500 mt-1">Vai aparecer abaixo do nome.</p>
        </div>
      </div>

      <div class="grid md:grid-cols-3 gap-6">
        <div>
          <label class="block font-black mb-2">Nível (hierarquia)</label>
          <input type="number" name="nivel" min="1" max="10"
                 value="{{ old('nivel', 1) }}"
                 class="w-full border rounded-xl px-4 py-3 focus:ring-red-500 focus:border-red-500" required>
          <p class="text-xs text-slate-500 mt-1">1 = topo (Direção). 2 = abaixo…</p>
        </div>

        <div>
          <label class="block font-black mb-2">Ordem (dentro do nível)</label>
          <input type="number" name="ordem" min="0" max="9999"
                 value="{{ old('ordem', 0) }}"
                 class="w-full border rounded-xl px-4 py-3 focus:ring-red-500 focus:border-red-500">
          <p class="text-xs text-slate-500 mt-1">Menor aparece primeiro.</p>
        </div>

        <div>
          <label class="block font-black mb-2">Ativo</label>
          <label class="flex items-center gap-3 bg-slate-50 border rounded-xl px-4 py-3 cursor-pointer">
            <input type="checkbox" name="ativo" value="1" {{ old('ativo', 1) ? 'checked' : '' }}>
            <span class="font-semibold text-slate-700">Mostrar no portal</span>
          </label>
        </div>
      </div>

      <div>
        <label class="block font-black mb-2">Slug (URL do perfil)</label>
        <input type="text" name="slug" id="slug"
               value="{{ old('slug') }}"
               class="w-full border rounded-xl px-4 py-3 font-mono text-sm focus:ring-red-500 focus:border-red-500"
               placeholder="deixe vazio para gerar automático">
        <p class="text-xs text-slate-500 mt-1">
          Exemplo: <code class="bg-slate-100 px-1">maria-carolina</code>.
          Se deixar vazio, gera pelo nome.
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-6 items-start">
        <div>
          <label class="block font-black mb-2">Foto (opcional)</label>
          <input type="file" name="foto" id="foto" accept="image/*" class="block w-full text-sm">
          <p class="text-xs text-slate-500 mt-1">Recomendado: foto quadrada. O portal recorta em círculo.</p>
        </div>

        <div class="bg-slate-50 border rounded-2xl p-5">
          <div class="font-black text-slate-800 mb-3">Prévia</div>
          <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-200" id="previewBox"></div>
            <div>
              <div class="font-black text-slate-900" id="previewNome">Seu nome aqui</div>
              <div class="text-red-700 font-semibold" id="previewCargo">Seu cargo aqui</div>
              <div class="text-xs text-slate-500 font-mono" id="previewSlug">slug</div>
            </div>
          </div>
        </div>
      </div>

      <div>
        <label class="block font-black mb-2">Biografia / Função</label>
        <textarea name="biografia" rows="7"
                  class="w-full border rounded-2xl px-4 py-3 focus:ring-red-500 focus:border-red-500"
                  placeholder="Escreva o que essa pessoa faz no CEEP...">{{ old('biografia') }}</textarea>
        <p class="text-xs text-slate-500 mt-1">
          Vai aparecer na página individual (perfil).
        </p>
      </div>

      <div class="pt-6 border-t flex gap-3">
        <button class="px-6 py-3 bg-red-700 text-white font-black rounded-xl hover:bg-red-800 transition">
          Salvar
        </button>
        <a href="{{ route('admin.institucional.index') }}"
           class="px-6 py-3 border rounded-xl font-black text-slate-700 hover:bg-slate-50 transition">
          Cancelar
        </a>
      </div>
    </form>

  </div>
</main>

@include('layouts.footer')

<script>
  // slug básico no front (o controller ainda garante unique)
  function slugify(str) {
    return (str || '')
      .toString()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/(^-|-$)+/g, '');
  }

  const nome = document.getElementById('nome');
  const slug = document.getElementById('slug');

  const previewNome = document.getElementById('previewNome');
  const previewCargo = document.getElementById('previewCargo');
  const previewSlug = document.getElementById('previewSlug');

  const cargoInput = document.querySelector('input[name="cargo"]');

  nome?.addEventListener('input', () => {
    previewNome.textContent = nome.value || 'Seu nome aqui';
    if (!slug.value) previewSlug.textContent = slugify(nome.value) || 'slug';
  });

  cargoInput?.addEventListener('input', () => {
    previewCargo.textContent = cargoInput.value || 'Seu cargo aqui';
  });

  slug?.addEventListener('input', () => {
    previewSlug.textContent = slug.value || 'slug';
  });

  // preview de imagem
  const foto = document.getElementById('foto');
  const previewBox = document.getElementById('previewBox');

  foto?.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) return;

    const url = URL.createObjectURL(file);
    previewBox.innerHTML = `<img src="${url}" class="w-full h-full object-cover" alt="preview">`;
  });
</script>
