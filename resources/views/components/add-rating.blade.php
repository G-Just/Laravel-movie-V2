@props(['movie', 'imdbID', 'ratings', 'allMovies', 'relatedMovies'])
<div class="flex flex-col items-center w-full gap-4 py-10">
    <div class="w-full p-4 py-10 border lg:w-1/2 rounded-xl border-neutral-600 bg-neutral-900">
        <h1 class="text-5xl text-center text-white">Add your rating</h1>
        <form class="flex flex-col items-center w-full mt-4" action={{ route('movies.store') }} method="POST">
            @csrf
            <input type="hidden" name="title" value="{{ $movie['Title'] }}" />
            <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}" />
            <input type="hidden" name="year" value="{{ $movie['Year'] }}" />
            <input type="hidden" name="genre" value="{{ $movie['Genre'] }}" />
            <input type="hidden" name="plot" value="{{ $movie['Plot'] }}" />
            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}" />
            <input type="hidden" name="runtime" value="{{ $movie['Runtime'] }}" />
            <x-input-label class="mt-4" for="rating" :value="__('Enter your rating (0.1 - 10)')" />
            <x-text-input value="{{ $ratings->firstWhere('user_id', Auth::user()->id)?->rating }}" id="rating"
                class="block w-full mt-1 max-w-96" type="text" name="rating" required />
            <x-input-error :messages="$errors->get('rating')" class="my-2" />
            <x-input-label class="mt-4" for="comment" :value="__('Leave a comment (optional)')" />
            <textarea
                class="w-full mt-1 text-gray-300 rounded-md shadow-sm max-w-96 border-neutral-700 bg-neutral-900 focus:border-lime-600 focus:ring-lime-600"
                name="comment" id="comment">
                {{ $ratings->firstWhere('user_id', Auth::user()->id)?->comment }}
            </textarea>
            @if (count($allMovies) > 0)
                <x-input-label for="related" :value="__('Similar content (optional)')" class="mt-4" />
                <input id="movieOptionSearch" type="text" placeholder="Search"
                    class="max-w-[350px] w-full px-2 text-gray-300 rounded-md shadow-sm border-neutral-700 bg-neutral-900 focus:border-lime-600 focus:ring-lime-600">
                <script defer>
                    const input = document.getElementById("movieOptionSearch");
                    const selections = document.getElementsByClassName("movieOption");
                    input.addEventListener("input", () => {
                        [...selections].forEach((selection) => {
                            if (selection.id.toLowerCase().includes(input.value.toLowerCase())) {
                                selection.classList.remove("hidden");
                            } else {
                                selection.classList.add("hidden");
                            }
                        });
                    });
                </script>
                <div class="w-full overflow-x-hidden overflow-y-auto mt-2 px-2 max-w-[450px] max-h-96">
                    <div class="flex flex-col items-center px-8 mx-auto">
                    </div>
                    @foreach ($allMovies as $movie)
                        <x-movie-option :movie="$movie" :relatedMovies="$relatedMovies" />
                    @endforeach
                </div>
                <p class="text-xs">*Select content that you think other people would like, if they liked this.</p>
            @endif
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

                <input type="hidden" name="imdbID" value={{ $imdbID }}>
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
</div>
@else
<x-primary-button class="mt-4">
    {{ __('Submit') }}
</x-primary-button>
</div>
</form>
@endif
</div>
