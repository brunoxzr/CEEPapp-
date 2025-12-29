@include('layouts.admin_nav', ['title' => 'Professor — Dashboard'])
@include('layouts.sidebar')
@section('content')
<h1 class="text-2xl font-black mb-10">Professores</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($professores as $professor)
    <div class="bg-white border rounded-xl p-6 shadow">
        <h2 class="text-lg font-bold text-red-800">{{ $professor['nome'] }}</h2>
        <p class="text-sm text-gray-600 mt-2">Disciplina: {{ $professor['disciplina'] }}</p>
    </div>
    @endforeach
</div>
@endsection
