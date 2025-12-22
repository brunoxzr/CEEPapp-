<nav class="text-sm text-slate-500">
    <ol class="flex flex-wrap items-center gap-2">

        <li>
            <a href="{{ url('/') }}" class="hover:text-red-700">
                Início
            </a>
        </li>

        @foreach($items as $item)
            <li>/</li>
            <li>
                @if(isset($item['url']))
                    <a href="{{ $item['url'] }}" class="hover:text-red-700">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-slate-700 font-semibold">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach

    </ol>
</nav>
