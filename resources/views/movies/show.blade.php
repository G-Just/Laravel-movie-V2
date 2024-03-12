<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Add your rating') }}
        </h2>
    </x-slot>

    <div class="relative overflow-hidden text-white">
        <img class="absolute hidden w-full opacity-50 brightness-50 blur-sm lg:block" src={{ $backdrop }}
            alt="Backdrop" />
        <div class="relative z-10 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex gap-4 lg:gap-8">
                <img class="w-[300px] h-[450px]"
                    src={{ $movie['Poster'] === 'N/A' ? 'https://www.prokerala.com/movies/assets/img/no-poster-available.jpg' : $movie['Poster'] }}
                    alt="Poster" />
                <div class="grid w-full grid-cols-2 gap-2 px-2 lg:gap-0 lg:px-0">
                    <div class="flex flex-col col-span-2">
                        <h1 class="mb-1 text-2xl font-bold">{{ $movie['Title'] }}
                            <span class="ml-2 font-thin">
                                ({{ $movie['Year'] }})
                            </span>
                        </h1>
                        <p class="text-gray-500">
                            {{ str_replace(',', ' | ', $movie['Genre']) }}
                            {{ ' ~ Runtime : ' }}
                            {{ $movie['Runtime'] }}
                        </p>
                    </div>
                    <div class="flex col-span-2 gap-2 my-3 text-sm justify-evenly lg:my-0 lg:text-base lg:gap-8">
                        @foreach ($movie['Ratings'] as $rating)
                            <div class="flex flex-col">
                                <p class="text-center">
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
                        <p class="line-clamp-5">{{ $movie['Plot'] }}</p>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <h1 class="text-2xl">Actors</h1>
                        <hr class="my-1" />
                        <p>{{ $movie['Actors'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center w-full gap-4 py-10">
        <h1 class="text-4xl text-center text-white">Add your rating</h1>
        <form class="w-1/4" action={{ route('movies.store') }} method="POST">
            @csrf
            <input type="hidden" name="title" value="{{ $movie['Title'] }}" />
            <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}" />
            <input type="hidden" name="year" value="{{ $movie['Year'] }}" />
            <input type="hidden" name="genre" value="{{ $movie['Genre'] }}" />
            <input type="hidden" name="plot" value="{{ $movie['Plot'] }}" />
            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}" />
            <input type="hidden" name="runtime" value="{{ $movie['Runtime'] }}" />

            <x-input-label for="rating" :value="__('Enter your rating (0.1 - 10)')" />
            <x-text-input id="rating" class="block w-full mt-1" type="text" name="rating" required />
            <x-input-error :messages="$errors->get('rating')" class="my-2" />
            <x-input-label class="mt-2" for="comment" :value="__('Leave a comment (optional)')" />
            <textarea
                class="mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                name="comment" id="comment" cols="54" rows="5"></textarea>
            <div class="flex justify-center">
                <x-primary-button class="mt-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <hr class="mt-4 mb-8">
    <div class="flex flex-col items-center pb-10">
        <h1 class="mb-8 text-4xl text-center text-white">Ratings</h1>
        <table class="w-1/2 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Rating</th>
                    <th scope="col" class="px-6 py-3">Comment</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ratings as $rating)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $rating->id }}</td>
                        <td class="px-6 py-4">{{ $rating->user()->first()->name }}</td>
                        <td class="px-6 py-4">{{ $rating->rating }}</td>
                        <td class="px-6 py-4">{{ $rating->comment }}</td>
                    </tr>
                @empty
                    <h1>No ratings yet.</h1>
            </tbody>
        </table>
    </div>
</x-app-layout>
