{{-- COMPONENT PROPS - Accept label value as prop --}}
@props(['value'])

{{-- LABEL ELEMENT - Form label with merged attributes and styling --}}
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-light-700']) }}>
    {{-- LABEL TEXT - Display value prop or slot content --}}
    {{ $value ?? $slot }}
</label>
