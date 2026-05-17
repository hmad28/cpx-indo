@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-red-500 bg-white/10 py-3 pe-4 ps-4 text-start text-base font-bold text-white focus:outline-hidden transition duration-150 ease-in-out'
            : 'block w-full border-l-4 border-transparent py-3 pe-4 ps-4 text-start text-base font-bold text-white/70 hover:border-white/30 hover:bg-white/10 hover:text-white focus:outline-hidden transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
