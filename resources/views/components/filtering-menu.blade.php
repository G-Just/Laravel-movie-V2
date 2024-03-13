<div class="flex justify-center px-8 py-4 mb-8 rounded bg-slate-800">
    <form action="" method="get" class="flex flex-col items-center justify-between w-full lg:flex-row">
        <div class="flex flex-col gap-4 lg:gap-8 lg:flex-row">
            <x-text-input placeholder="Search..." id="search" class="block mt-1 w-96" type="text" name="search"
                :value="old('search')" />
            <select name="rated" id="rated"
                class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                <option value="all" selected>All</option>
                <option value="rated">Rated by me</option>
                <option value="not_rated">Not rated by me</option>
            </select>
            <select name="sorting" id="sorting"
                class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                <option value="date" selected>Date added</option>
                <option value="rating">Rating</option>
                <option value="alphabetical">Alphabetical</option>
            </select>
        </div>
        <x-primary-button class="mt-4 lg:mt-0 ms-3">
            {{ __('Apply') }}
        </x-primary-button>
        </select>
    </form>
</div>
