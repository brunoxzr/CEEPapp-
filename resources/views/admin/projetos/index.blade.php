@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-black mb-10">Projetos Técnicos</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($projetos as $projeto)
    <div class="bg-white border rounded-xl p-6 shadow">
        <h2 class="text-lg font-bold text-red-800">{{ $projeto['nome'] }}</h2>
        <p class="text-sm text-gray-600 mt-2">{{ $projeto['descricao'] }}</p>
    </div>
    @endforeach
</div>
@endsection
