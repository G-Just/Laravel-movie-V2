<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Add your rating') }}
        </h2>
    </x-slot>
    <div class="relative overflow-hidden text-white border-white bg-neutral-950 border-y-2">
        <img class="absolute hidden w-full opacity-50 brightness-50 blur-sm lg:block" src={{ $backdrop }}
            alt="Backdrop" />
        <div class="relative z-10 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 lg:gap-8 lg:flex-row">
                <img class="w-[300px] h-[450px] mx-auto"
                    src={{ $movie['Poster'] === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $movie['Poster'] }}
                    alt="Poster" />
                <div class="grid w-full grid-cols-2 gap-2 px-2 lg:gap-0 lg:px-0">
                    <div class="flex flex-col col-span-2">
                        <h1 class="mb-1 text-2xl font-bold">{{ $movie['Title'] }}
                            <span class="ml-2 font-thin">
                                ({{ $movie['Year'] }})
                            </span>
                        </h1>
                        <p class="text-gray-400">
                            {{ str_replace(',', ' | ', $movie['Genre']) }}
                            {{ ' ~ Runtime : ' }}
                            {{ $movie['Runtime'] }}
                        </p>
                    </div>
                    <div class="grid grid-cols-3 col-span-2 gap-2 my-4 text-sm">
                        @foreach ($movie['Ratings'] as $rating)
                            <div class="flex flex-col max-w-56">
                                <p class="text-center line-clamp-1">
                                    {{ $rating['Source'] }}
                                </p>
                                <hr class="my-1" />
                                <p class="text-center">
                                    {{ $rating['Value'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col col-span-2">
                        <h1 class="text-2xl">Overview</h1>
                        <hr class="my-1" />
                        <p class="line-clamp-4">{{ $movie['Plot'] }}</p>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <h1 class="text-2xl">Actors</h1>
                        <hr class="my-1" />
                        <div class="flex gap-4 overflow-x-auto lg:gap-0">
                            @foreach ($actors as $actor)
                                <x-actor-card :image="$actor['profile_path']" :name="$actor['name']" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center w-full gap-4 py-10">
        <h1 class="text-5xl text-center text-white">Media</h1>
        <div class="flex w-full gap-8 px-1 py-4 overflow-x-auto lg:px-10 bg-neutral-800">
            @forelse ($videos as $name => $video)
                <div>
                    <iframe class="w-[300px] h-[190px] lg:w-[560px] lg:h-[315px]"
                        src={{ 'https://www.youtube.com/embed/' . $video }} title={{ $name }} frameborder="0"
                        allowfullscreen></iframe>
                </div>
            @empty
                <div class="w-full">
                    <h1 class="text-2xl text-center">No media found.</h1>
                </div>
            @endforelse
        </div>
    </div>
    <hr class="mt-4 mb-8">
    <x-add-rating :movie="$movie" :ratings="$ratings" />
    <hr class="w-full mt-4 mb-8">
    <div class="flex flex-col items-center w-full pb-10">
        <h1 class="mb-8 text-5xl text-center text-white">Ratings</h1>
        <table class="w-full text-sm text-left text-gray-400 lg:w-1/2">
            <thead class="text-xs text-gray-400 uppercase bg-neutral-700">
                <tr class="flex w-full">
                    <th class="w-1/3 px-6 py-3">ID</th>
                    <th class="w-1/3 px-6 py-3">User</th>
                    <th class="w-1/3 px-6 py-3">Rating</th>
                </tr>
            </thead>
            <tbody class="flex flex-col items-center justify-between w-full overflow-y-scroll bg-grey-light"
                style="max-height: 50vh;">
                @forelse ($ratings->all() as $rating)
                    <tr class="flex w-full bg-neutral-800 border-neutral-700">
                        <td class="w-1/3 px-6 py-4">{{ $rating->id }}</td>
                        <td class="w-1/3 px-6 py-4">{{ $rating->user()->first()->name }}</td>
                        <td class="w-1/3 px-6 py-4">{{ $rating->rating }}</td>
                    </tr>
                @empty
                    <tr class="flex w-full bg-neutral-800 border-neutral-700">
                        <td class="w-1/3 px-6 py-4">-</td>
                        <td class="w-1/3 px-6 py-4">-</td>
                        <td class="w-1/3 px-6 py-4">-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <hr class="w-full mt-4 mb-8">
    <div class="flex flex-col items-center w-full pb-10">
        <h1 class="mb-8 text-5xl text-center text-white">Comments</h1>
        <div class="grid w-full grid-cols-1 px-10 pb-40 lg:grid-cols-3 gap-x-20 max-w-7xl">
            @forelse ($ratings->all() as $rating)
                <x-testimonial :comment="$rating->comment" :author="$rating->user()->first()->name" :rating="$rating->rating" />
            @empty
                <h1 class="col-span-3 text-xl text-center text-white">No comments.</h1>
            @endforelse
        </div>
    </div>
    <hr class="w-full mt-4 mb-8">
    <div class="flex flex-col items-center w-full pb-10">
        <h1 class="mb-8 text-5xl text-center text-white">Recomended</h1>
        <p>If you liked this you might like:</p>
        <p>In development</p>
    </div>
</x-app-layout>
