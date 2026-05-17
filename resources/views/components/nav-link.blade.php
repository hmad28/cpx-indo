@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full bg-white px-4 py-2 text-sm font-bold leading-5 text-gray-950 shadow-sm focus:outline-hidden transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-full px-4 py-2 text-sm font-bold leading-5 text-white/70 hover:bg-white/10 hover:text-white focus:outline-hidden transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
