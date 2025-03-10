<div>

    <div class="fixed  bottom-0 left-0 right-0 px-4">
        <div class="bg-white mb-2  border shadow-xl  rounded-full p-2 px-6 justify-between flex items-center ">
            <a href="{{ route('customer.index') }}"
                class="h-14 w-14 bg-white  grid place-content-center rounded-full  {{ request()->routeIs('customer.index') ? ' text-green-600' : 'text-main' }}">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M20.83 8.01l-6.55-5.24C13 1.75 11 1.74 9.73 2.76L3.18 8.01c-.94.75-1.51 2.25-1.31 3.43l1.26 7.54C3.42 20.67 4.99 22 6.7 22h10.6c1.69 0 3.29-1.36 3.58-3.03l1.26-7.54c.18-1.17-.39-2.67-1.31-3.42zM12.75 18c0 .41-.34.75-.75.75s-.75-.34-.75-.75v-3c0-.41.34-.75.75-.75s.75.34.75.75v3z">
                    </path>
                </svg>
            </a>
            <a href="{{ route('customer.status') }}">
                <div
                    class="h-14 w-14  bg-white  grid place-content-center rounded-full {{ request()->routeIs('customer.status') ? '  text-green-600' : 'text-main' }}">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        aria-hidden="true">
                        <path
                            d="M11 1.988c-4.97 0-9.01 4.04-9.01 9.01s4.04 9.01 9.01 9.01 9.01-4.04 9.01-9.01-4.04-9.01-9.01-9.01zm0 11.26H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h3c.41 0 .75.34.75.75s-.34.75-.75.75zm3-3H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h6c.41 0 .75.34.75.75s-.34.75-.75.75zM21.99 18.95c-.33-.61-1.03-.95-1.97-.95-.71 0-1.32.29-1.68.79-.36.5-.44 1.17-.22 1.84.43 1.3 1.18 1.59 1.59 1.64.06.01.12.01.19.01.44 0 1.12-.19 1.78-1.18.53-.77.63-1.54.31-2.15z">
                        </path>
                    </svg>
                </div>
            </a>
            <a href="{{ route('customer.transaction') }}"
                class="h-14 w-14 bg-white grid place-content-center rounded-full {{ request()->routeIs('customer.transaction') ? '  text-green-600' : 'text-main' }}">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M12.676 19.959c.275.064.3.424.032.513l-1.58.52c-3.97 1.28-6.06.21-7.35-3.76l-1.28-3.95c-1.28-3.97-.22-6.07 3.75-7.35l.524-.174c.403-.133.795.271.68.68-.056.202-.11.414-.164.634l-.98 4.19c-1.1 4.71.51 7.31 5.22 8.43l1.148.267z">
                    </path>
                    <path
                        d="M17.17 3.209l-1.67-.39c-3.34-.79-5.33-.14-6.5 2.28-.3.61-.54 1.35-.74 2.2l-.98 4.19c-.98 4.18.31 6.24 4.48 7.23l1.68.4c.58.14 1.12.23 1.62.27 3.12.3 4.78-1.16 5.62-4.77l.98-4.18c.98-4.18-.3-6.25-4.49-7.23zm-1.88 10.12c-.09.34-.39.56-.73.56-.06 0-.12-.01-.19-.02l-2.91-.74a.75.75 0 01.37-1.45l2.91.74c.41.1.65.51.55.91zm2.93-3.38c-.09.34-.39.56-.73.56-.06 0-.12-.01-.19-.02l-4.85-1.23a.75.75 0 01.37-1.45l4.85 1.23c.41.09.65.5.55.91z">
                    </path>
                </svg>
            </a>

            <a href="{{route('profile.edit')}}"
                class="h-14 w-14 bg-white text-main border-2 p-0.5 overflow-hidden relative rounded-full">
                @if (auth()->user()->profile_photo == null)
                    <img src="{{asset('images/no-profile.jpg')}}" class="rounded-full h-full w-full object-cover" alt="">
                @else
                    <img src="{{Storage::url(auth()->user()->profile_photo)}}"
                        class="rounded-full h-full w-full object-cover" alt="">
                @endif
            </a>
        </div>
    </div>
</div>