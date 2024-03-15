@props(['label'])

<div class="my-2 overflow-hidden lg:my-0">
    <div class="relative inline-block py-1 text-xs">
        <div class="absolute inset-0 flex text-neutral-600">
            <svg height="100%" viewBox="0 0 50 100">
                <path
                    d="M49.9,0a17.1,17.1,0,0,0-12,5L5,37.9A17,17,0,0,0,5,62L37.9,94.9a17.1,17.1,0,0,0,12,5ZM25.4,59.4a9.5,9.5,0,1,1,9.5-9.5A9.5,9.5,0,0,1,25.4,59.4Z"
                    fill="currentColor" />
            </svg>
            <div class="flex-grow h-full -ml-px rounded-md rounded-l-none bg-neutral-600"></div>
        </div>
        <span class="relative pr-px font-semibold text-white uppercase truncate">
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>{{ $label }}<span>&nbsp;</span>
        </span>
    </div>
</div>
