@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-md border-b-2 border-yellow-400 text-yellow-400 transition-all'
            : 'inline-flex items-center px-3 py-2 rounded-md border-b-2 border-transparent text-white hover:text-yellow-400 transition-all';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
