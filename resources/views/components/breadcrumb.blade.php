<div class="page-header breadcrumb-wrap d-print-none">
    <div class="container">
        <div class="breadcrumb">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" style="color: #ff9010 ; margin-bottom: 5px; margin-right: 5px;"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
            @foreach ($items as $item)
                @if (!$loop->last)
                    <a href="{{ $item['url'] }}" rel="nofollow">
                        {{ $item['label'] }}
                    </a>
                    <span></span>
                @else
                    {{ $item['label'] }}
                @endif
            @endforeach
        </div>
    </div>
</div>
