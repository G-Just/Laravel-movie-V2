<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden font-sans antialiased">
    <div
        class="h-screen w-screen text-white relative bg-[url('../../public/images/main_background.jpg')] bg-cover bg-no-repeat bg-fixed overflow-x-hidden">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="shadow dark:bg-neutral-900">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <x-footer />
    </div>
    @if (session()->has('message'))
        <x-popup :message="session()->get('message')" :success="true" />
    @endif
    @if (session()->has('error'))
        <x-popup :message="session()->get('error')" :success="false" />
    @endif
</body>

</html>
