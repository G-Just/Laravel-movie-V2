<div class="flex flex-col justify-center px-8 py-4 mb-8 rounded-lg lg:flex-row bg-neutral-950">
    <form action={{ route('home') }} method="get" class="flex flex-col items-center justify-between w-full lg:flex-row">
        <div class="flex flex-col gap-4 lg:gap-8 lg:flex-row">
            <x-text-input placeholder="Search..." id="search" class="block mt-1 w-96" type="text" name="search"
                :value="request('search')" />
            <x-select-input name="rated" id="rated">
                <option value="all" @if (request('rated') === 'all') selected @endif>All</option>
                <option value="rated" @if (request('rated') === 'rated') selected @endif>Rated by me</option>
                <option value="not_rated" @if (request('rated') === 'not_rated') selected @endif>Not rated by me</option>
            </x-select-input>
            <x-select-input name="sorting" id="sorting">
                <option value="date" @if (request('sorting') === 'date') selected @endif>Date added &darr;</option>
                <option value="rating " @if (request('sorting') === 'rating') selected @endif>Rating &darr;</option>
                <option value="alphabetical" @if (request('sorting') === 'alphabetical') selected @endif>Alphabetical &darr;
                </option>
            </x-select-input>
        </div>
        <div class="gap-4">
            <a class='inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-neutral-400 hover:bg-neutral-200 focus:bg-white active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:ring-offset-lime-800'
                href={{ route('reset') }}>Reset</a>
            <x-primary-button class="mt-4 lg:mt-0 ms-3">
                {{ __('Apply') }}
            </x-primary-button>
        </div>
    </form>
</div>
