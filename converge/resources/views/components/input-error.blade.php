{{-- COMPONENT PROPS - Accept error messages as prop --}}
@props(['messages'])

{{-- MESSAGES CHECK - Only display if error messages exist --}}
@if ($messages)
    {{-- ERROR LIST - Styled ul with merged attributes --}}
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        {{-- MESSAGES LOOP - Iterate through each error message --}}
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        {{-- END MESSAGES LOOP --}}
        @endforeach
    </ul>
{{-- END MESSAGES CHECK --}}
@endif
