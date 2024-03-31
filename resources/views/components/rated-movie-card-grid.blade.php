@props(['count', 'imdbid', 'title', 'year', 'genre', 'plot', 'poster', 'runtime', 'rating', 'rated'])

<a href={{ route('movies.show', $imdbid) }} class="h-[700px]">
    <div class="h-full gap-4 p-2 mb-8 border-2 border-neutral-700">
        <img class="h-[300px] mx-auto w-[200px]"
            src={{ $poster === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $poster }}
            alt="Poster" />
        <div class="flex flex-col p-4 pr-4 border-b-2 border-neutral-700 h-[280px]">
            <div class="flex">
                <div class="flex">
                    <h1 class="text-2xl font-bold max-w-[400px] h-[64px] overflow-hidden">{{ $title }}</h1>
                    <h1 class="mx-2 text-2xl font-thin">({{ $year }})</h1>
                </div>
                @if ($rated)
                    <x-tag :label={{ __('Your rated this') }} />
                @endif
            </div>
            <p class="mt-1 text-gray-500 h-[54px]">
                {{ str_replace(',', ' | ', $genre) }}
                {{ ' ~ Runtime : ' }}
                {{ $runtime }}
            </p>
            <p class="mt-2 line-clamp-3">{{ $plot }}</p>
            <div class="flex items-end flex-1">
                <div class="flex pt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-2 text-base text-lime-300">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                    <span class="mr-1">{{ $count }}</span> Ratings
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center py-6 text-5xl font-bold ">
            {{ $rating == 0 ? '-' : number_format($rating, 1) }}</div>
    </div>
</a>
