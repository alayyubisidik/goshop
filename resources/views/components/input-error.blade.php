@props(['messages'])

@if ($messages)
    @foreach ((array)$messages as $message)
        <span class="text-danger d-block {{ $attributes->get('class') }}">
            {{ $message }}
        </span>
    @endforeach
@endif
