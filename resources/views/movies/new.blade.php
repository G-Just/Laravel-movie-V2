<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Add your Rating') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-search-bar />
        <div class="pt-4 mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="relative py-6 mx-auto rounded bg-neutral-950 sm:rounded-lg max-w-7xl sm:px-3 lg:px-4">
                <div class="grid grid-cols-1 py-4 text-white lg:grid-cols-3 gap-x-8">
                    @forelse ($movies as $movie)
                        <x-movie-card :id="$movie['imdbID']" :poster="$movie['Poster']" :title="$movie['Title']" :year="$movie['Year']"
                            :type="$movie['Type']" :db="'omdb'" />
                    @empty
                        <h1 class="col-span-3 text-xl text-center">Not found.</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
