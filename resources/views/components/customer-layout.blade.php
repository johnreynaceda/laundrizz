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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="mx-auto max-w-7xl">

            <nav class="relative z-50 h-24 select-none" x-data="{ showMenu: false }">
                <div
                    class="container relative flex flex-wrap items-center justify-between h-24 mx-auto overflow-hidden font-medium  border-gray-200 md:overflow-visible lg:justify-center sm:px-4 md:px-2 lg:px-0">
                    <div class="flex items-center justify-start w-1/4 h-full pr-4">
                        <div class="flex space-x-3 item-center">
                            <div class="h-16 w-16 border-2  overflow-hidden rounded-xl ">
                                <img src="https://framerusercontent.com/images/dWg1XJhwq6UCrq3YqbgEws2s6k.jpg"
                                    class="rounded-lg object-cover" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="top-0 left-0 items-start hidden w-full h-full p-4 text-sm bg-gray-900 bg-opacity-50 md:items-center md:w-3/4 md:absolute lg:text-base md:bg-transparent md:p-0 md:relative md:flex"
                        :class="{ 'flex fixed': showMenu, 'hidden': !showMenu }">
                        <div
                            class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg md:bg-transparent md:overflow-visible md:rounded-none md:relative md:flex md:flex-row">
                            <a href="#_"
                                class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none text-gray-900 md:hidden">
                                <svg class="w-auto h-5" viewBox="0 0 355 99" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <path
                                            d="M119.1 87V66.4h19.8c34.3 0 34.2-49.5 0-49.5-11 0-22 .1-33 .1v70h13.2zm19.8-32.7h-19.8V29.5h19.8c16.8 0 16.9 24.8 0 24.8zm32.6-30.5c0 9.5 14.4 9.5 14.4 0s-14.4-9.5-14.4 0zM184.8 87V37.5h-12.2V87h12.2zm22.8 0V61.8c0-7.5 5.1-13.8 12.6-13.8 7.8 0 11.9 5.7 11.9 13.2V87h12.2V61.1c0-15.5-9.3-24.2-20.9-24.2-6.2 0-11.2 2.5-16.2 7.4l-.8-6.7h-10.9V87h12.1zm72.1 1.3c7.5 0 16-2.6 21.2-8l-7.8-7.7c-2.8 2.9-8.7 4.6-13.2 4.6-8.6 0-13.9-4.4-14.7-10.5h38.5c1.9-20.3-8.4-30.5-24.9-30.5-16 0-26.2 10.8-26.2 25.8 0 15.8 10.1 26.3 27.1 26.3zM292 56.6h-26.6c1.8-6.4 7.2-9.6 13.8-9.6 7 0 12 3.2 12.8 9.6zm41.2 32.1c14.1 0 21.2-7.5 21.2-16.2 0-13.1-11.8-15.2-21.1-15.8-6.3-.4-9.2-2.2-9.2-5.4 0-3.1 3.2-4.9 9-4.9 4.7 0 8.7 1.1 12.2 4.4l6.8-8c-5.7-5-11.5-6.5-19.2-6.5-9 0-20.8 4-20.8 15.4 0 11.2 11.1 14.6 20.4 15.3 7 .4 9.8 1.8 9.8 5.2 0 3.6-4.3 6-8.9 5.9-5.5-.1-13.5-3-17-6.9l-6 8.7c7.2 7.5 15 8.8 22.8 8.8z"
                                            id="a"></path>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="currentColor">
                                            <path d="M19.742 49h28.516L68 83H0l19.742-34z"></path>
                                            <path d="M26 69h14v30H26V69zM4 50L33.127 0 63 50H4z"></path>
                                        </g>
                                        <g fill-rule="nonzero">
                                            <use fill="currentColor" xlink:href="#a"></use>
                                            <use fill="currentColor" xlink:href="#a"></use>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <div
                                class="flex flex-col items-start justify-center w-full space-x-6 text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 ml-6 font-medium text-left text-black md:ml-0 md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Home</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Features</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Blog</a>
                                <a href="#_"
                                    class="inline-block w-full py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Contact</a>
                                <a href="#_"
                                    class="absolute top-0 left-0 hidden py-2 mt-6 ml-10 mr-2 text-gray-600 lg:inline-block md:mt-0 md:ml-2 lg:mx-3 md:relative">
                                    <svg class="inline w-5 h-5" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </a>
                            </div>
                            <div
                                class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/3 md:flex-row md:py-0">
                                <form method="POST" action="{{ route('logout') }}">
                                    <a href="#"
                                        class="w-full px-6 py-2 mr-0 text-gray-700 md:px-3 md:mr-2 lg:mr-3 md:w-auto">Sign
                                        In</a>
                                    <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                        class="inline-flex items-center w-full px-5 px-6 py-3 text-sm font-medium leading-4 text-white bg-gray-900 md:w-auto md:rounded-full hover:bg-gray-800 focus:outline-none md:focus:ring-2 focus:ring-0 focus:ring-offset-2 focus:ring-gray-800">
                                        <span>Logout</span>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div @click="showMenu = !showMenu"
                        class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 bg-white rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                        <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </nav>

            <!-- Main Hero Content -->
            {{-- <div
                class="container max-w-sm py-32 mx-auto mt-px text-left sm:max-w-md md:max-w-lg sm:px-4 md:max-w-none md:text-center">
                <h1
                    class="text-3xl font-bold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:text-4xl md:text-7xl lg:text-8xl">
                    Start Crafting Your <br class="hidden sm:block"> Next Great Idea</h1>
                <div class="mx-auto mt-5 text-gray-400 md:mt-8 md:max-w-lg md:text-center md:text-xl">Simplifying the
                    creation of landing pages, blog pages, application pages and so much more!</div>
                <div
                    class="flex flex-col items-center justify-center mt-8 space-y-4 text-center sm:flex-row sm:space-y-0 sm:space-x-4">
                    <span class="relative inline-flex w-full md:w-auto">
                        <a href="#_"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-medium leading-6 text-white bg-gray-900 border border-transparent rounded-full xl:px-10 md:w-auto hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                            Purchase Now
                        </a>
                    </span>
                    <span class="relative inline-flex w-full md:w-auto">
                        <a href="#_"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-medium leading-6 text-gray-900 bg-gray-100 border border-transparent rounded-full xl:px-10 md:w-auto hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">Learn
                            More</a>
                    </span>
                </div>
            </div> --}}
            <div>
                <div>
                    <h1 class=" text-sm font-semibold text-gray-500">Good day, {{ Str::ucfirst(auth()->user()->name) }}
                    </h1>
                    <div class="mt-5">
                        <p class="text-lg font-semibold">Find your closest
                        <p class="text-2xl font-bold text-main leading-6">Laundry Shops</p>
                        </p>
                    </div>
                    <div class="mt-5 bg-main flex items-center space-x-3 rounded-xl px-5 py-3">
                        <div class="h-12 w-12 rounded-full bg-white grid place-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M18.364 17.364L12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364ZM12 15C14.2091 15 16 13.2091 16 11C16 8.79086 14.2091 7 12 7C9.79086 7 8 8.79086 8 11C8 13.2091 9.79086 15 12 15ZM12 13C10.8954 13 10 12.1046 10 11C10 9.89543 10.8954 9 12 9C13.1046 9 14 9.89543 14 11C14 12.1046 13.1046 13 12 13Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-sm text-gray-400">Your Location</h1>
                            <div class="flex space-x-4 items-center text-white">
                                <h1 class="text-sm ">Please set your location</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false">
                        <h1 class="text-lg text-gray-600">Select Laundry Shop</h1>
                        <div class="mt-3">

                            <swiper-container class="mySwiper" pagination="true" pagination-clickable="true"
                                slides-per-view="2" space-between="20" free-mode="true">
                                <swiper-slide>
                                    <div @click="modalOpen=true"
                                        class="w-48 h-48 border rounded-3xl overflow-hidden bg-gradient-to-tr from-main via-main to-white relative">
                                        <img src="{{ asset('images/laundry1.jpg') }}"
                                            class="w-full h-full opacity-40 object-cover" alt="">
                                        <div class="absolute bottom-5 left-2 text-white">
                                            <p class="font-bold">GEMS Laundry Shop</p>
                                        </div>
                                    </div>
                                </swiper-slide>
                                <swiper-slide>
                                    <div
                                        class="w-48 h-48 border rounded-3xl overflow-hidden bg-gradient-to-tr from-main via-main to-white relative">
                                        <img src="{{ asset('images/laundry2.jpg') }}"
                                            class="w-full h-full opacity-40 object-cover" alt="">
                                        <div class="absolute bottom-5 left-2 text-white">
                                            <p class="font-bold">MR Laundry Shop</p>
                                        </div>
                                    </div>
                                </swiper-slide>
                                <swiper-slide>
                                    <div
                                        class="w-48 h-48 border rounded-3xl overflow-hidden bg-gradient-to-tr from-main via-main to-white relative">
                                        <img src="{{ asset('images/laundry2.jpg') }}"
                                            class="w-full h-full opacity-40 object-cover" alt="">
                                        <div class="absolute bottom-5 left-2 text-white">
                                            <p class="font-bold">MR Laundry Shop</p>
                                        </div>
                                    </div>
                                </swiper-slide>
                            </swiper-container>
                        </div>
                        <div class="mt-10">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque vitae dolor repellendus
                            tempora sit quae reprehenderit deleniti aut temporibus. Quis molestias iure quia sequi ex
                            libero repellendus assumenda adipisci pariatur, impedit illum omnis facilis odio enim
                            dolorem molestiae in. Odio quidem aperiam explicabo, voluptas possimus inventore facere
                            praesentium, rerum optio officia nihil dolore reiciendis veniam ducimus nam consequatur amet
                            nulla tempore impedit, incidunt excepturi vel vitae! Commodi quae optio quaerat in iusto
                            esse, obcaecati fugiat quidem. Totam quibusdam autem enim, blanditiis magni nihil
                            exercitationem, molestias deserunt iste ad non provident, sint labore eveniet modi soluta
                            doloribus officiis. Ea, perferendis voluptate?
                        </div>
                        <div class="relative z-50 w-auto h-auto">
                            <template x-teleport="body">
                                <div x-show="modalOpen"
                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                    x-cloak>
                                    <!-- Background overlay -->
                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-300"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @click="modalOpen = false"
                                        class="absolute inset-0 w-full h-full bg-black bg-opacity-40">
                                    </div>

                                    <!-- Modal content -->
                                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-full"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="ease-in duration-300"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-full"
                                        class="relative w-full h-full py-6 mt-96 bg-white  rounded-t-3xl px-7 sm:max-w-lg sm:rounded-lg">

                                        <!-- Modal Header -->
                                        <div class="flex items-center justify-between pb-2">
                                            <h3 class="text-lg font-semibold">Select Service Type</h3>
                                            <button @click="modalOpen = false"
                                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Modal Content -->
                                        <div class="relative w-auto">
                                            <div class="mt-10 grid place-content-center grid-cols-2 gap-5">
                                                <div
                                                    class="bg-gray-100 w-40 h-40 rounded-3xl text-center grid place-content-center">
                                                    <x-shared.svg.pickup class="h-24 w-24" />
                                                    <span class="font-semibold text-gray-600 mt-2">Pick Up</span>
                                                </div>
                                                <div
                                                    class="bg-gray-100 w-40 h-40 rounded-3xl grid place-content-center text-center">
                                                    <x-shared.svg.dropoff class="h-24 w-24" />
                                                    <span class="font-semibold text-gray-600 mt-2">Drop-off</span>
                                                </div>
                                                <div
                                                    class="bg-gray-100 w-40 h-40 rounded-3xl grid text-center place-content-center col-span-2 mx-auto">
                                                    <x-shared.svg.analytics class="h-24 w-24" />
                                                    <span class="font-semibold text-gray-600 mt-2">Analytics</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>


                </div>
            </div>
            <!-- End Main Hero Content -->
            <div class="fixed bottom-0 left-0 right-0">
                <div class="bg-white text-main rounded-t-3xl p-2 px-10 justify-between flex items-center">
                    <div class="h-14 w-14 bg-white grid place-content-center rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M20.83 8.01l-6.55-5.24C13 1.75 11 1.74 9.73 2.76L3.18 8.01c-.94.75-1.51 2.25-1.31 3.43l1.26 7.54C3.42 20.67 4.99 22 6.7 22h10.6c1.69 0 3.29-1.36 3.58-3.03l1.26-7.54c.18-1.17-.39-2.67-1.31-3.42zM12.75 18c0 .41-.34.75-.75.75s-.75-.34-.75-.75v-3c0-.41.34-.75.75-.75s.75.34.75.75v3z">
                            </path>
                        </svg>
                    </div>
                    <div class="h-14 w-14 bg-white grid place-content-center rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M11 1.988c-4.97 0-9.01 4.04-9.01 9.01s4.04 9.01 9.01 9.01 9.01-4.04 9.01-9.01-4.04-9.01-9.01-9.01zm0 11.26H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3c.41 0 .75.34.75.75s-.34.75-.75.75zm3-3H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h6c.41 0 .75.34.75.75s-.34.75-.75.75zM21.99 18.95c-.33-.61-1.03-.95-1.97-.95-.71 0-1.32.29-1.68.79-.36.5-.44 1.17-.22 1.84.43 1.3 1.18 1.59 1.59 1.64.06.01.12.01.19.01.44 0 1.12-.19 1.78-1.18.53-.77.63-1.54.31-2.15z">
                            </path>
                        </svg>
                    </div>
                    <div class="h-14 w-14 bg-white grid place-content-center rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M12.676 19.959c.275.064.3.424.032.513l-1.58.52c-3.97 1.28-6.06.21-7.35-3.76l-1.28-3.95c-1.28-3.97-.22-6.07 3.75-7.35l.524-.174c.403-.133.795.271.68.68-.056.202-.11.414-.164.634l-.98 4.19c-1.1 4.71.51 7.31 5.22 8.43l1.148.267z">
                            </path>
                            <path
                                d="M17.17 3.209l-1.67-.39c-3.34-.79-5.33-.14-6.5 2.28-.3.61-.54 1.35-.74 2.2l-.98 4.19c-.98 4.18.31 6.24 4.48 7.23l1.68.4c.58.14 1.12.23 1.62.27 3.12.3 4.78-1.16 5.62-4.77l.98-4.18c.98-4.18-.3-6.25-4.49-7.23zm-1.88 10.12c-.09.34-.39.56-.73.56-.06 0-.12-.01-.19-.02l-2.91-.74a.75.75 0 01.37-1.45l2.91.74c.41.1.65.51.55.91zm2.93-3.38c-.09.34-.39.56-.73.56-.06 0-.12-.01-.19-.02l-4.85-1.23a.75.75 0 01.37-1.45l4.85 1.23c.41.09.65.5.55.91z">
                            </path>
                        </svg>
                    </div>

                    <div class="h-14 w-14 bg-white grid place-content-center rounded-full">
                        <div class="border h-12 w-12 p-0.5 rounded-full">
                            <img src="https://framerusercontent.com/images/dWg1XJhwq6UCrq3YqbgEws2s6k.jpg"
                                class="rounded-full" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
