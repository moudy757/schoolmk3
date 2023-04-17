@props(['active'])

@php
$classes = $active ?? false ? 'text-indigo-600' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>