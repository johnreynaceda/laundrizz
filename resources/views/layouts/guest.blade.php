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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 2xl:bg-gradient-to-b 2xl:from-main 2xl:via-white 2xl:to-transparent">


        <div
            class="w-full sm:max-w-lg mt-6 px-8 py-10 bg-gradient-to-t from-white via-transparent to-gray-100 2xl:shadow-md overflow-hidden ">
            <div class="flex flex-col justify-center items-center space-y-3">
                <div class="h-20 w-20 bg-white shadow-xl border rounded-3xl grid place-content-center">
                    <x-shared.logo class="h-10 w-10" />
                </div>
                @if (request()->routeIs('login'))
                    <div class="text-center">
                        <h1 class="font-semibold text-gray-600 text-xl">Sign in with email</h1>
                        <p class="text-sm text-gray-500">Enter your credentials to access your account.</p>
                    </div>
                @elseif(request()->routeIs('register'))
                    <div class="text-center">
                        <h1 class="font-semibold text-gray-600 text-xl">Registration @yield('user_type')</h1>
                        <p class="text-sm text-gray-500">Enter your details to register.</p>
                    </div>
                @else
                    <div class="text-center">
                        <h1 class="font-semibold text-gray-600 text-xl">Email Verification</h1>
                    </div>
                @endif
            </div>
            <div class="mt-10">
                {{ $slot }}
            </div>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
