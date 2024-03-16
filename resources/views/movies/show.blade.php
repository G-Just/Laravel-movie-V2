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
                        <p class="text-gray-500">
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
                        <div class="flex gap-3 overflow-x-auto">
                            @foreach ($actorsArray as $actor)
                                <x-actor-card :image="$actor['profile_path']" :name="$actor['name']" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center w-full gap-4 py-10">
        <h1 class="text-4xl text-center text-white">Add your rating</h1>
        <form class="flex flex-col items-center w-full" action={{ route('movies.store') }} method="POST">
            @csrf
            <input type="hidden" name="title" value="{{ $movie['Title'] }}" />
            <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}" />
            <input type="hidden" name="year" value="{{ $movie['Year'] }}" />
            <input type="hidden" name="genre" value="{{ $movie['Genre'] }}" />
            <input type="hidden" name="plot" value="{{ $movie['Plot'] }}" />
            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}" />
            <input type="hidden" name="runtime" value="{{ $movie['Runtime'] }}" />

            <x-input-label for="rating" :value="__('Enter your rating (0.1 - 10)')" />
            <x-text-input value="{{ $ratings->firstWhere('user_id', Auth::user()->id)?->rating }}" id="rating"
                class="block w-full mt-1 max-w-96" type="text" name="rating" required />
            <x-input-error :messages="$errors->get('rating')" class="my-2" />
            <x-input-label class="mt-2" for="comment" :value="__('Leave a comment (optional)')" />
            <textarea
                class="w-full mt-1 text-gray-300 rounded-md shadow-sm max-w-96 border-neutral-700 bg-neutral-900 focus:border-lime-600 focus:ring-lime-600"
                name="comment" id="comment">{{ $ratings->firstWhere('user_id', Auth::user()->id)?->comment }}</textarea>
            <div class="flex justify-center gap-8">
                @if ($ratings->firstWhere('user_id', Auth::user()->id))
                    <x-primary-button class="mt-4">
                        {{ __('Update') }}
                    </x-primary-button>
        </form>
        <x-danger-button class="mt-4" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-rating-deletion')">{{ __('Delete') }}</x-danger-button>

        <x-modal name="confirm-rating-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="POST" action="{{ route('movies.destroy') }}" class="p-6">
                @csrf
                <input type="hidden" name="imdbID" value={{ $movie['imdbID'] }}>
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your rating?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('The rating will be permenately deleted') }}
                </p>

                <div class="flex justify-end mt-6">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete rating') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
@else
    <x-primary-button class="mt-4">
        {{ __('Submit') }}
    </x-primary-button>
    </div>
    </form>
    @endif
    </div>
    <hr class="mt-4 mb-8">
    <div class="flex flex-col items-center pb-10">
        <h1 class="mb-8 text-4xl text-center text-white">Ratings</h1>
        <table class="w-1/2 text-sm text-left text-gray-400">
            <thead class="text-xs text-gray-400 uppercase bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Rating</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ratings->all() as $rating)
                    <tr class="border-b bg-neutral-800 border-neutral-700 ">
                        <td class="px-6 py-4">{{ $rating->id }}</td>
                        <td class="px-6 py-4">{{ $rating->user()->first()->name }}</td>
                        <td class="px-6 py-4">{{ $rating->rating }}</td>
                    </tr>
                @empty
                    <tr class="border-b bg-neutral-800 border-neutral-700 ">
                        <td class="px-6 py-4">No ratings yet.</td>
                        <td class="px-6 py-4">No ratings yet.</td>
                        <td class="px-6 py-4">No ratings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <hr class="mt-4 mb-8">
    <div class="flex flex-col items-center pb-10">
        <h1 class="mb-8 text-4xl text-center text-white">Comments</h1>
        <div class="grid w-full grid-cols-1 px-10 pb-40 lg:grid-cols-3 gap-x-20 max-w-7xl">
            @forelse ($ratings->all() as $rating)
                <x-testimonial :comment="$rating->comment" :author="$rating->user()->first()->name" :rating="$rating->rating" />
            @empty
                <h1 class="col-span-3 text-xl text-center text-white">No comments.</h1>
            @endforelse
        </div>
    </div>
</x-app-layout>
