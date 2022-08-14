@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 text-sm font-semibold leading-5 text-green-300 focus:outline-none focus:border-indigo-700 transition'
: 'inline-flex items-center px-1 pt-1 text-sm font-semibold leading-5 text-gray-600 hover:text-green-500 focus:outline-none focus:text-green-500 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>