@props(['imdbid', 'title', 'year', 'genre', 'plot', 'poster', 'runtime', 'rating'])

<a href={{ 'movies/' . $imdbid }}>
    <div class="flex flex-col gap-4 p-2 mb-8 border-2 border-slate-400 lg:flex-row">
        <img class="h-[300px] mx-auto w-[200px]"
            src={{ $poster === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $poster }}
            alt="Poster" />
        <div>
            <h1 class="text-4xl font-bold">{{ $title }}<span class="mx-2 font-thin">({{ $year }})</span>
            </h1>
            <p class="mt-1 text-gray-500">
                {{ str_replace(',', ' | ', $genre) }}
                {{ ' ~ Runtime : ' }}
                {{ $runtime }}
            </p>
            <p class="mt-2 lg:mt-8 line-clamp-3 lg:line-clamp-4">{{ $plot }}</p>
        </div>
        <div class="flex items-center justify-center flex-1 px-20 py-4 text-5xl lg:py-0 lg:justify-end">
            {{ number_format($rating, 1) }}</div>
    </div>
</a>
