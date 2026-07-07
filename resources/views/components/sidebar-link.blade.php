@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block py-2 px-4 rounded bg-indigo-600 text-white'
    : 'block py-2 px-4 rounded hover:bg-slate-800 text-slate-300 hover:text-white transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>