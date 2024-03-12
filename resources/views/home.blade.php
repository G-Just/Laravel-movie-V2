<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($movies as $movie)
                        <x-rated-movie-card :imdbid="$movie['imdbID']" :title="$movie['title']" :year="$movie['year']" :genre="$movie['genre']"
                            :plot="$movie['plot']" :poster="$movie['poster']" :runtime="$movie['runtime']" :rating="$movie['ratings_avg_rating']" />
                    @empty
                        <h1>No ratings yet.</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
