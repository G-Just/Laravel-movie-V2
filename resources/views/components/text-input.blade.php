@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-neutral-700 bg-neutral-900 text-gray-300 focus:border-lime-600 focus:ring-lime-600 rounded-md shadow-sm',
]) !!}>
