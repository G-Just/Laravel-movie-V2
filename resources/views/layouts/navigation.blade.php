<nav x-data="{ open: false }" class="border-b border-neutral-700 bg-neutral-900">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="text-lg" :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link class="text-lg" :href="route('list')" :active="request()->routeIs('list')">
                        {{ __('Ratings') }}
                    </x-nav-link>
                    <x-nav-link class="text-lg" :href="route('movies.new')" :active="request()->routeIs('movies.new')">
                        {{ __('Add Rating') }}
                    </x-nav-link>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-300 hover:border-neutral-600 focus:outline-none focus:text-gray-300 focus:border-neutral-600">
                                <div class="py-5">Popular</div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('movies.playing')">
                                {{ __('Now Playing') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('movies.popular')">
                                {{ __('Popular') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('movies.top')">
                                {{ __('Top Rated') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('movies.upcoming')">
                                {{ __('Upcoming') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-400 transition duration-150 ease-in-out border border-transparent rounded-md bg-neutral-800 hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-500 transition duration-150 ease-in-out rounded-md hover:text-gray-400 hover:bg-neutral-800 focus:outline-none focus:bg-neutral-800 focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('list')" :active="request()->routeIs('list')">
                {{ __('Ratings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.new')" :active="request()->routeIs('movies.new')">
                {{ __('Add Rating') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.playing')" :active="request()->routeIs('movies.playing')">
                {{ __('Now Playing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.popular')" :active="request()->routeIs('movies.popular')">
                {{ __('Popular') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.top')" :active="request()->routeIs('movies.top')">
                {{ __('Top Rated') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.upcoming')" :active="request()->routeIs('movies.upcoming')">
                {{ __('Upcoming') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
