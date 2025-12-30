@include('layouts.admin_nav', ['title' => 'Restrições de Professores'])
@include('layouts.sidebar')

<section class="max-w-5xl mx-auto px-4 mt-8 space-y-6">

  <h1 class="text-2xl font-black text-red-800">Restrições de Professores</h1>

  {{-- FORM --}}
  <form method="POST" action="{{ route('admin.restricoes.store') }}"
        class="bg-white border rounded-2xl p-4 grid md:grid-cols-5 gap-3">
    @csrf

    <select name="admin_id" required class="border rounded-xl p-2">
      <option value="">Professor</option>
      @foreach($professores as $p)
        <option value="{{ $p->id }}">{{ $p->nome }}</option>
      @endforeach
    </select>

    <select name="dia_semana" required class="border rounded-xl p-2">
      @foreach(['Segunda','Terça','Quarta','Quinta','Sexta'] as $d)
        <option value="{{ $d }}">{{ $d }}</option>
      @endforeach
    </select>

    <select name="aula" class="border rounded-xl p-2">
      <option value="">Dia inteiro</option>
      @for($i=1;$i<=6;$i++)
        <option value="{{ $i }}">{{ $i }}ª aula</option>
      @endfor
    </select>

    <input name="motivo" placeholder="Motivo (opcional)"
           class="border rounded-xl p-2">

    <button class="bg-red-700 text-white rounded-xl font-black">
      Adicionar
    </button>
  </form>

  {{-- LISTA --}}
  @foreach($professores as $prof)
    <div class="bg-white border rounded-2xl p-4">
      <h2 class="font-black text-lg">{{ $prof->nome }}</h2>

      @forelse($prof->restricoes as $r)
        <div class="flex justify-between items-center border-b py-1 text-sm">
          <span>
            {{ $r->dia_semana }} —
            {{ $r->aula ? $r->aula.'ª aula' : 'Dia inteiro' }}
            @if($r->motivo)
              <span class="text-xs text-slate-500">({{ $r->motivo }})</span>
            @endif
          </span>

          <form method="POST"
                action="{{ route('admin.restricoes.delete', $r->id) }}">
            @csrf @method('DELETE')
            <button class="text-red-600 font-black">✕</button>
          </form>
        </div>
      @empty
        <p class="text-sm text-slate-500">Sem restrições</p>
      @endforelse
    </div>
  @endforeach

</section>
