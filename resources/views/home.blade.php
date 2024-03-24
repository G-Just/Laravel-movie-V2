<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <section class="min-h-screen text-white h-fit bg-neutral-900">
        <div class="min-h-screen pt-10 h-fit">
            <div class="container flex flex-col items-center mx-auto md:flex-row">
                <div class="flex flex-col items-start justify-center w-full p-8 lg:w-1/3">
                    <h1 class="p-2 pl-0 text-4xl text-lime-300 md:text-5xl tracking-loose">MovieRating</h1>
                    <h2 class="mb-2 text-3xl leading-relaxed md:text-5xl md:leading-snug">Cinema : the most beautiful
                        fraud in the world
                    </h2>
                    <p class="mb-4 text-lg md:text-base text-gray-50">Explore your favourite cinema content and express
                        your optinion.</p>
                    <div class="flex gap-8 mt-2">
                        <a href={{ route('list') }}
                            class="px-4 py-2 bg-transparent border rounded shadow text-lime-300 border-lime-300 hover:bg-lime-300 hover:text-black hover:shadow-lg hover:border-transparent">
                            Explore ratings</a>
                        <a href={{ route('movies.new') }}
                            class="px-4 py-2 bg-transparent border rounded shadow text-lime-300 border-lime-300 hover:bg-lime-300 hover:text-black hover:shadow-lg hover:border-transparent">
                            Add rating</a>
                    </div>
                </div>
                <style>
                    .clipped {
                        clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
                    }
                </style>
                <div class="justify-center p-8 mt-0 mb-6 ml-0 lg:mb-0 lg:mt-0 lg:ml-12 lg:w-2/3">
                    <div class="flex content-center">
                        <div>
                            <img class="hidden inline-block mt-28 xl:block clipped w-[400px] h-[400px] object-cover bg-center"
                                src="https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p15987_k_h8_ad.jpg">
                        </div>
                        <div>
                            <img class="inline-block mt-0 lg:mt-28 xl:block clipped w-[400px] h-[400px] object-cover bg-center"
                                src="https://c4.wallpaperflare.com/wallpaper/923/620/32/interstellar-movie-wallpaper-preview.jpg">
                        </div>
                        <div>
                            <img class="hidden inline-block mt-28 lg:block clipped w-[400px] h-[400px] object-cover object-left"
                                src="https://www.hollywoodreporter.com/wp-content/uploads/2018/05/the_dark_knight_-_h_-_2018.jpg?w=1296">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
