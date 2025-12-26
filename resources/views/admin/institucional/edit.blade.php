@include('layouts.header', ['title' => 'Editar Pessoa — Institucional'])

<main class="bg-slate-50 py-12">
  <div class="max-w-5xl mx-auto px-6">

    <h1 class="text-3xl font-black text-red-900 mb-8">Editar pessoa</h1>

    @if ($errors->any())
      <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 font-semibold">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST"
          action="{{ route('admin.institucional.update', $pessoa->id) }}"
          enctype="multipart/form-data"
          class="bg-white border rounded-2xl shadow-sm p-8 space-y-8">
      @csrf
      @method('PUT')

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="block font-black mb-2">Nome</label>
          <input type="text" name="nome"
                 value="{{ old('nome', $pessoa->nome) }}"
                 class="w-full border rounded-xl px-4 py-3" required>
        </div>

        <div>
          <label class="block font-black mb-2">Cargo</label>
          <input type="text" name="cargo"
                 value="{{ old('cargo', $pessoa->cargo) }}"
                 class="w-full border rounded-xl px-4 py-3" required>
        </div>
      </div>

      <div class="grid md:grid-cols-3 gap-6">
        <div>
          <label class="block font-black mb-2">Nível</label>
          <input type="number" name="nivel" min="1" max="10"
                 value="{{ old('nivel', $pessoa->nivel) }}"
                 class="w-full border rounded-xl px-4 py-3" required>
        </div>

        <div>
          <label class="block font-black mb-2">Ordem</label>
          <input type="number" name="ordem" min="0" max="9999"
                 value="{{ old('ordem', $pessoa->ordem) }}"
                 class="w-full border rounded-xl px-4 py-3">
        </div>

        <div>
          <label class="block font-black mb-2">Ativo</label>
          <label class="flex items-center gap-3 bg-slate-50 border rounded-xl px-4 py-3 cursor-pointer">
            <input type="checkbox" name="ativo" value="1" {{ old('ativo', $pessoa->ativo) ? 'checked' : '' }}>
            <span class="font-semibold text-slate-700">Mostrar no portal</span>
          </label>
        </div>
      </div>

      <div>
        <label class="block font-black mb-2">Slug</label>
        <input type="text" name="slug"
               value="{{ old('slug', $pessoa->slug) }}"
               class="w-full border rounded-xl px-4 py-3 font-mono text-sm">
        <p class="text-xs text-slate-500 mt-1">URL do perfil: /institucional/{{ $pessoa->slug }}</p>
      </div>

      <div class="grid md:grid-cols-2 gap-6 items-start">
        <div>
          <label class="block font-black mb-2">Nova foto (opcional)</label>
          <input type="file" name="foto" accept="image/*" class="block w-full text-sm">
          <p class="text-xs text-slate-500 mt-1">Se enviar, substitui a foto atual.</p>
        </div>

        <div class="bg-slate-50 border rounded-2xl p-5">
          <div class="font-black text-slate-800 mb-3">Foto atual</div>
          <div class="w-28 h-28 rounded-2xl overflow-hidden bg-slate-200">
            @if($pessoa->foto)
              <img src="{{ asset('storage/'.$pessoa->foto) }}" class="w-full h-full object-cover" alt="{{ $pessoa->nome }}">
            @endif
          </div>
        </div>
      </div>

      <div>
        <label class="block font-black mb-2">Biografia</label>
        <textarea name="biografia" rows="8"
                  class="w-full border rounded-2xl px-4 py-3">{{ old('biografia', $pessoa->biografia) }}</textarea>
      </div>

      <div class="pt-6 border-t flex gap-3">
        <button class="px-6 py-3 bg-red-700 text-white font-black rounded-xl hover:bg-red-800 transition">
          Salvar alterações
        </button>
        <a href="{{ route('admin.institucional.index') }}"
           class="px-6 py-3 border rounded-xl font-black text-slate-700 hover:bg-slate-50 transition">
          Voltar
        </a>
      </div>
    </form>

  </div>
</main>

@include('layouts.footer')
