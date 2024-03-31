@props(['sorts'])

<div class="flex flex-col justify-center px-8 py-6 mb-8 rounded-lg lg:flex-row bg-neutral-950">
    <form action={{ route('list') }} method="get" class="flex flex-col items-center justify-between w-full lg:flex-row">
        <div class="flex flex-col gap-4 lg:gap-8 lg:flex-row">
            <x-text-input placeholder="Search..." id="search" class="block mt-1 max-w-96 min-w-60" type="text"
                name="search" :value="request('search')" />
            <x-select-input name="rated" id="rated">
                <option value="all" @if (request('rated') === 'all') selected @endif>All</option>
                <option value="rated" @if (request('rated') === 'rated') selected @endif>Rated by me</option>
                <option value="not_rated" @if (request('rated') === 'not_rated') selected @endif>Not rated by me</option>
            </x-select-input>
            <x-select-input name="sorting" id="sorting">
                @foreach ($sorts as $key => $sort)
                    <option value={{ $key }} @if (request('sorting') === $key) selected @endif>
                        {{ $sort }}</option>
                @endforeach
            </x-select-input>
        </div>
        <div>
            <div class="gap-4">
                <a class='inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-neutral-400 hover:bg-neutral-200 focus:bg-white active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:ring-offset-lime-800'
                    href={{ route('reset') }}>Reset</a>
                <x-primary-button class="mt-4 lg:mt-0 ms-3" name='layout' value="{{ request('layout') }}">
                    {{ __('Apply') }}
                </x-primary-button>
            </div>
            <div class="items-center hidden pt-4 justify-evenly lg:flex">
                <p>Layout :</p>
                <button name='layout' value="list"
                    class="w-8 h-8 p-1 outline-2 outline-dashed outline-lime-300 hover:bg-neutral-700 hover:outline-double @if (request('layout') !== 'grid') outline-double bg-neutral-800 @endif">
                    <svg viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M15 4h-9v-1h9v1zM6 5v1h11v-1h-11zM0 2h5v5h-5v-5zM1 6h3v-3h-3v3zM15 10h-9v1h9v-1zM6 13h11v-1h-11v1zM0 9h5v5h-5v-5zM1 13h3v-3h-3v3z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </button>
                <button name='layout' value="grid"
                    class="w-8 h-8 p-1 outline-2 outline-dashed outline-lime-300 hover:bg-neutral-700 hover:outline-double @if (request('layout') === 'grid') outline-double bg-neutral-800 @endif">
                    <svg viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M0 5h5v-5h-5v5zM1 1h3v3h-3v-3zM6 5h5v-5h-5v5zM7 1h3v3h-3v-3zM12 0v5h5v-5h-5zM16 4h-3v-3h3v3zM0 11h5v-5h-5v5zM1 7h3v3h-3v-3zM6 11h5v-5h-5v5zM7 7h3v3h-3v-3zM12 11h5v-5h-5v5zM13 7h3v3h-3v-3zM0 17h5v-5h-5v5zM1 13h3v3h-3v-3zM6 17h5v-5h-5v5zM7 13h3v3h-3v-3zM12 17h5v-5h-5v5zM13 13h3v3h-3v-3z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
