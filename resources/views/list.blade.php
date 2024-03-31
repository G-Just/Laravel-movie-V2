<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Rated Content List') }}
        </h2>
    </x-slot>

    <div class="py-6 lg:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-filtering-menu :sorts="$sorts" />
            <div class="overflow-hidden shadow-sm bg-neutral-950 sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">{{ $movies->links() }}</div>
                    @if (request('layout') !== 'grid')
                        <div class="mb-6">
                            @forelse ($movies as $movie)
                                <x-rated-movie-card-list :count="count($movie->ratings)" :imdbid="$movie['imdbID']" :title="$movie['title']"
                                    :year="$movie['year']" :genre="$movie['genre']" :plot="$movie['plot']" :poster="$movie['poster']"
                                    :runtime="$movie['runtime']" :rating="$movie['ratings_avg_rating']" :rated="$movie
                                        ->ratings()
                                        ->where('user_id', '=', Auth::user()->getAuthIdentifier())
                                        ->first()
                                        ? true
                                        : false" />
                            @empty
                                <h1 class="text-2xl text-center">Nothing here</h1>
                            @endforelse
                        @else
                            <div class="grid grid-cols-3 mb-6 gap-x-6 gap-y-4">
                                @forelse ($movies as $movie)
                                    <x-rated-movie-card-grid :count="count($movie->ratings)" :imdbid="$movie['imdbID']" :title="$movie['title']"
                                        :year="$movie['year']" :genre="$movie['genre']" :plot="$movie['plot']" :poster="$movie['poster']"
                                        :runtime="$movie['runtime']" :rating="$movie['ratings_avg_rating']" :rated="$movie
                                            ->ratings()
                                            ->where('user_id', '=', Auth::user()->getAuthIdentifier())
                                            ->first()
                                            ? true
                                            : false" />
                                @empty
                                    <h1 class="text-2xl text-center">Nothing here</h1>
                                @endforelse
                            </div>
                    @endif
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
