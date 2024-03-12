@props(['id', 'poster', 'title', 'year', 'type'])

<a href={{ $id }}>
    <div class="flex justify-center mb-8">
        <div class="flex flex-col items-center w-[300px]">
            <img class="w-[300px] h-[450px]"
                src={{ $poster === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $poster }}
                alt="Poster" />
            <div class="flex justify-between w-full mt-2">
                <h1 class="font-bold">{{ $title }}</h1>
                <h1>{{ $year }}</h1>
            </div>
            <p class="w-full text-left text-gray-600 capitalize">
                {{ $type }}
            </p>
        </div>
    </div>
</a>
