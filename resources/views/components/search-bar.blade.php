<form action={{ route('movies.new') }} method="GET">
    <div class="flex justify-center mb-4">
        <div class="flex justify-center px-2 w-full max-w-[600px]">
            <x-text-input name="search" class="w-full pl-8 rounded-l-full" placeholder="{{ __('Search...') }}" />
            <div class="px-2 rounded-r-full bg-neutral-700 outline-1 outline-gray-600 hover:bg-lime-800">
                <button type="submit" class="relative p-2">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" strokeWidth="0" />
                        <g id="SVGRepo_tracerCarrier" strokeLinecap="round" strokeLinejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="#999" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />{" "}
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</form>
