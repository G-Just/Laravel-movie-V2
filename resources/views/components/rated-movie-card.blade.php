@props(['imdbid', 'title', 'year', 'genre', 'plot', 'poster', 'runtime', 'rating', 'rated'])

<a href={{ 'movies/' . $imdbid }}>
    <div class="flex flex-col gap-4 p-2 mb-8 border-2 border-slate-400 lg:flex-row">
        <img class="h-[300px] mx-auto w-[200px]"
            src={{ $poster === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $poster }}
            alt="Poster" />
        <div class="p-4 border-b-2 border-r-0 lg:pr-4 lg:border-b-0 lg:border-r-2 border-slate-700">
            <div class="flex flex-col lg:flex-row">
                <div class="flex">
                    <h1 class="text-4xl font-bold max-w-[400px]">{{ $title }}</h1>
                    <h1 class="mx-2 text-4xl font-thin">({{ $year }})</h1>
                </div>
                @if ($rated)
                    <x-tag :label="'Your rated this'" />
                @endif
            </div>
            <p class="mt-1 text-gray-500">
                {{ str_replace(',', ' | ', $genre) }}
                {{ ' ~ Runtime : ' }}
                {{ $runtime }}
            </p>
            <p class="mt-2 lg:mt-8 line-clamp-3 lg:line-clamp-4">{{ $plot }}</p>
        </div>
        <div class="flex items-center justify-center px-20 py-4 text-5xl font-bold lg:w-56 lg:py-0 lg:justify-end">
            {{ number_format($rating, 1) }}</div>
    </div>
</a>
