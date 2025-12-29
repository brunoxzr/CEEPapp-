@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-black mb-10">Permissões dos Gestores</h1>

@foreach($gestores as $gestor)
<form method="POST"
      action="{{ route('admin.permissoes.update', $gestor) }}"
      class="bg-white rounded-xl p-6 mb-8 shadow">

    @csrf

    <h2 class="font-bold text-lg mb-4">
        {{ $gestor->nome }}
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($permissoes as $perm)
        <label class="flex items-center gap-2">
            <input type="checkbox"
                   name="permissoes[]"
                   value="{{ $perm->id }}"
                   @checked($gestor->permissoes->contains($perm))>
            {{ $perm->descricao }}
        </label>
        @endforeach
    </div>

    <button class="mt-6 px-6 py-2 bg-red-600 text-white rounded">
        Salvar
    </button>
</form>
@endforeach
@endsection
