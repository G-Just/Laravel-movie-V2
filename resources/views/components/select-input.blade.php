<select
    {{ $attributes->merge(['class' => 'text-gray-300 rounded-md shadow-sm accent-lime-300 border-neutral-700 bg-neutral-900 focus:border-lime-600 focus:ring-lime-600']) }}>
    {{ $slot }}
</select>
