@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-lime-600 text-start text-base font-medium text-lime-300 bg-lime-900/50 focus:outline-none focus:text-lime-200 focus:bg-lime-900 focus:border-lime-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-gray-200 hover:bg-neutral-50 dark:hover:bg-neutral-700 hover:border-lime-600 focus:outline-none focus:text-gray-200 focus:bg-neutral-700 focus:border-lime-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
