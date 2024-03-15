<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-lime-400 focus:bg-lime-400 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:ring-offset-lime-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
