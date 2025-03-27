@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-0.5 text-sm font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-blue-500 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>