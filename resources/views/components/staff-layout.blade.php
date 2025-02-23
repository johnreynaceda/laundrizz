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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <div class="max-w-7xl mx-auto pt-5 pb-10 px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <nav class="flex justify-between px-3.5 py-1 border bg-white border-neutral-200/60 rounded-md">
                        <ol
                            class="inline-flex items-center mb-3 space-x-1 text-sm text-neutral-500 [&_.active-breadcrumb]:text-neutral-600 [&_.active-breadcrumb]:font-medium sm:mb-0">
                            <li class="flex items-center h-full"><a href="#_" class="py-1 hover:text-neutral-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                                        <path
                                            d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    </svg>
                                </a></li>
                            <svg class="w-5 h-5 text-gray-400/70" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <g fill="none" stroke="none">
                                    <path d="M10 8.013l4 4-4 4" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <li><a href="#_"
                                    class="inline-flex items-center py-1 font-semibold text-main hover:text-neutral-900 focus:outline-none">@yield('title')</a>
                            </li>

                        </ol>
                    </nav>
                </div>
                <div>
                    {{ $slot }}
                </div>
            </div>

        </main>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
