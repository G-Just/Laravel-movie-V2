<x-guest-layout>
    <div class="flex w-screen h-screen overflow-hidden text-white">
        <div class="flex flex-col items-center w-2/5 gap-8 py-20 text-center bg-neutral-950 max-2xl:w-3/5 max-lg:w-full">
            <div class="mb-10">
                <x-application-logo />
                <p class="mt-2 font-bold tracking-wide">Movie Rating</p>
            </div>
            <form method="POST" action="{{ route('register') }}"
                class="flex flex-col w-2/3 gap-6 max-sm:w-full max-sm:px-4 max-md:w-3/4">
                @csrf

                <!-- Name -->
                <div class="relative">
                    <p class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium bg-neutral-950">
                        Username</p>
                    <x-text-input placeholder="John" type="text" name='name'
                        class="block w-full py-4 pl-4 pr-4 mt-2 mb-0 ml-0 mr-0 text-base border rounded-md placeholder-neutral-700 focus:border-lime-300 bg-neutral-950 border-neutral-600" />
                    @error('name')
                        <p
                            class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium text-red-500 right-6 bg-neutral-950">
                            {{ $message }}</p>
                    @enderror
                </div>


                <!-- Email Address -->
                <div class="relative">
                    <p class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium bg-neutral-950">
                        Email</p>
                    <x-text-input placeholder="John@gmail.com" type="text" name='email'
                        class="block w-full py-4 pl-4 pr-4 mt-2 mb-0 ml-0 mr-0 text-base border rounded-md placeholder-neutral-700 focus:border-lime-300 bg-neutral-950 border-neutral-600" />
                    @error('email')
                        <p
                            class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium text-red-500 right-6 bg-neutral-950">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative">
                    <p class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium bg-neutral-950">
                        Password</p>
                    <x-text-input placeholder="*******" type="password" name='password'
                        class="block w-full py-4 pl-4 pr-4 mt-2 mb-0 ml-0 mr-0 text-base border rounded-md placeholder-neutral-700 focus:border-lime-300 bg-neutral-950 border-neutral-600" />
                    @error('password')
                        <p
                            class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium text-red-500 right-6 bg-neutral-950">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <p class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium bg-neutral-950">
                        Password</p>
                    <x-text-input placeholder="*******" type="password" name='password_confirmation'
                        class="block w-full py-4 pl-4 pr-4 mt-2 mb-0 ml-0 mr-0 text-base border rounded-md placeholder-neutral-700 focus:border-lime-300 bg-neutral-950 border-neutral-600" />
                    @error('password_confirmation')
                        <p
                            class="absolute pt-0 pb-0 pl-2 pr-2 mb-0 ml-2 mr-0 -mt-2 font-medium text-red-500 right-6 bg-neutral-950">
                            {{ $message }}</p>
                    @enderror
                </div>
                <button
                    class="px-8 py-4 mt-4 font-bold text-black hover:bg-lime-500 bg-gradient-to-tr bg-lime-400 rounded-xl"
                    type="submit">Register</button>
                <p class="text-sm font-thin">Already registered ? <a
                        class="underline hover:text-lime-300 underline-offset-4" href={{ route('login') }}>Login</a>
                </p>
                <p class="text-sm font-thin">By signing in at Movie Rating you confirm that you've read and
                    accepted the
                    <span><a href="" class="underline hover:text-lime-300 underline-offset-4">Terms of
                            Service</a></span>
                    and
                    <span><a href="" class="underline hover:text-lime-300 underline-offset-4">Privacy
                            Policy</a></span>.
                </p>
            </form>
            <p class="text-sm">© {{ now()->year }} Movie Rating</p>
        </div>
        <div
            class="flex-grow bg-[url('../../public/images/login_background.jpg')] 
    max-2xl:bg-[center_left_-300px] bg-no-repeat">
        </div>
    </div>
</x-guest-layout>
