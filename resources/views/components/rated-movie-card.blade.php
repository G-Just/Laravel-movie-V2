@props(['imdbid', 'title', 'year', 'genre', 'plot', 'poster', 'runtime', 'rating'])

<a href={{ 'movies/' . $imdbid }}>
    <div class="flex gap-4 p-2 mb-8 border-2 border-slate-400">
        <img class="w-[200px] h-[300px]"
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
            <p class="mt-8 line-clamp-4">{{ $plot }}</p>
        </div>
        <div class="flex items-center justify-end flex-1 px-20 text-5xl">{{ number_format($rating, 1) }}</div>
    </div>
</a>
