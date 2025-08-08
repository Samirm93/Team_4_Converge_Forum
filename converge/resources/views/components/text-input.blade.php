{{-- COMPONENT PROPS - Accept disabled prop with default false --}}
@props(['disabled' => false])

{{-- TEXT INPUT ELEMENT - Styled input field with conditional disabled state --}}
<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-900']) }}>
