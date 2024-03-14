<div class="flex flex-col justify-center px-8 py-4 mb-8 rounded-lg lg:flex-row bg-slate-800">
    <form action={{ route('home') }} method="get" class="flex flex-col items-center justify-between w-full lg:flex-row">
        <div class="flex flex-col gap-4 lg:gap-8 lg:flex-row">
            <x-text-input placeholder="Search..." id="search" class="block mt-1 w-96" type="text" name="search"
                :value="request('search')" />
            <select name="rated" id="rated"
                class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                <option value="all" @if (request('rated') === 'all') selected @endif>All</option>
                <option value="rated" @if (request('rated') === 'rated') selected @endif>Rated by me</option>
                <option value="not_rated" @if (request('rated') === 'not_rated') selected @endif>Not rated by me</option>
            </select>
            <select name="sorting" id="sorting"
                class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                <option value="date" @if (request('sorting') === 'date') selected @endif>Date added</option>
                <option value="rating" @if (request('sorting') === 'rating') selected @endif>Rating</option>
                <option value="alphabetical" @if (request('sorting') === 'alphabetical') selected @endif>Alphabetical</option>
            </select>
        </div>
        <div class="gap-4">
            <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                href={{ route('reset') }}>Reset</a>
            <x-primary-button class="mt-4 lg:mt-0 ms-3">
                {{ __('Apply') }}
            </x-primary-button>
        </div>
    </form>
</div>
