<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Popular') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex justify-center">
            <form action={{ route('movies.popular') }} method="GET" class="flex gap-10">
                <button name='type' value='movies'
                    class="@if (request('type') !== 'shows') bg-lime-300 text-black @else bg-neutral-800 @endif px-4 py-2 text-2xl duration-300 rounded hover:text-black hover:bg-neutral-500">
                    Movies
                </button>
                <button name='type' value='shows'
                    class="@if (request('type') === 'shows') bg-lime-300 text-black @else bg-neutral-800 @endif px-4 py-2 text-2xl duration-300 rounded hover:text-black hover:bg-neutral-500">
                    Shows
            </form>
        </div>
        <div class="pt-4 mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="relative py-6 mx-auto rounded bg-neutral-950 sm:rounded-lg max-w-7xl sm:px-3 lg:px-4">
                <div class="grid grid-cols-1 py-4 text-white lg:grid-cols-3 gap-x-8">
                    @forelse ($content as $movie)
                        <x-movie-card :id="$movie['imdbID']" :poster="'https://image.tmdb.org/t/p/w1280/' . $movie['poster_path']" :title="$movie['title']" :year="explode('-', $movie['release_date'])[0]"
                            :type="$movie['media_type']" />
                    @empty
                        <h1>Nothing here.</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
