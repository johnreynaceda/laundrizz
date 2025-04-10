<div>
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
                        <a href="{{ route('customer.location') }}">
                            <x-badge sm label="Set" warning right-icon="pencil-square" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-10" x-data="{ modalOpen: @entangle('option_modal') }" @keydown.escape.window="modalOpen = false">
                <div>
                    <div class="flex px-4  rounded-md border-2 border-green-800 overflow-hidden max-w-md mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                            class="fill-gray-600  rotate-90">
                            <path
                                d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                            </path>
                        </svg>
                        <input type="email" placeholder="Search Laundry..." wire:model.live="search"
                            class="w-full border-none focus:ring-0 bg-transparent text-gray-600 text-sm outline-none" />
                    </div>
                </div>
                <h1 class="text-lg text-gray-600 mt-4">Select Laundry Shop</h1>
                <div class="mt-3">
                    <div class="grid grid-cols-2 2xl:grid-cols-7 gap-5">
                        @forelse ($laundries as $item)
                            <div>
                                <div wire:click="selectLaundry({{ $item->id }})"
                                    class="w-40 h-40 border rounded-3xl overflow-hidden bg-gradient-to-tr from-main via-main to-white relative">
                                    <img src="{{ Storage::url($item->image_path) }}"
                                        class="w-full h-full opacity-40 object-cover" alt="">
                                    <div class="absolute bottom-5 left-2 text-white">
                                        <p class="font-bold">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2">
                                <p>No Laundry Shops Available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="mt-10">

                </div>

                <x-filament::modal id="select-service-type" slide-over>
                    <x-slot name="heading">
                        <div class="uppercase"> {{ $laundry_name }}</div>
                    </x-slot>
                    <div>
                        <div class="h-64 border">
                            <swiper-container class="mySwiper" pagination="true" pagination-clickable="true"
                                navigation="true" space-between="30" centered-slides="true" autoplay-delay="2500"
                                autoplay-disable-on-interaction="false">
                                @foreach ($pubmats as $item)
                                    <swiper-slide>
                                        <div class="w-full h-full">
                                            <img src="{{ Storage::url($item->file_path) }}"
                                                class="w-full h-64  object-cover" alt="">
                                        </div>
                                    </swiper-slide>
                                @endforeach

                            </swiper-container>
                        </div>
                        <div class="flex w-full items-center rounded-full">
                            <div class="flex-1 border-b border-gray-300"></div>
                            <span class="text-black text-lg font-semibold leading-8 px-8 py-3">SERVICE TYPE</span>
                            <div class="flex-1 border-b border-gray-300"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-5 place-content-center mt-5">
                            @forelse (\App\Models\ServiceType::all() as $item)
                                <div wire:click="selectOption({{ $item->id }})"
                                    class=" w-40 h-40 rounded-3xl grid place-content-center border text-center cursor-pointer hover:bg-gray-200">
                                    @if ($item->id == 1)
                                        <x-shared.svg.pickup class="h-24 w-24" />
                                    @else
                                        <x-shared.svg.dropoff class="h-24 w-24" />
                                    @endif
                                    <span class="font-semibold text-gray-600 mt-2">
                                        {{ $item->id == 1 ? 'Pick Up' : 'Drop Off' }}
                                    </span>
                                </div>
                            @empty
                                <p>No Service Types Available</p>
                            @endforelse
                        </div>
                </x-filament::modal>
                {{-- <div class="relative z-50 w-auto h-auto">
                    <template x-teleport="body">
                        <div x-show="modalOpen" wire:ignore
                            class="fixed inset-0 z-[99] flex items-end justify-center w-screen h-screen" x-cloak>
                            <!-- Background overlay -->
                            <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
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
                                class="relative w-full max-w-lg bg-white rounded-t-3xl px-7 sm:rounded-lg max-h-[90vh] overflow-y-auto">

                                <!-- Modal Header -->
                                <div class="flex items-center justify-between py-4 border-b">
                                    <h3 class="text-lg font-semibold">Select Service Type</h3>
                                    <button @click="modalOpen = false"
                                        class="flex items-center justify-center w-8 h-8 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal Content -->
                                <div class="p-4">
                                    <div class="grid grid-cols-2 gap-5 place-content-center">
                                        @forelse (\App\Models\ServiceType::all() as $item)
                                            <div wire:click="selectOption({{ $item->id }})"
                                                class=" w-40 h-40 rounded-3xl grid place-content-center text-center cursor-pointer hover:bg-gray-200">
                                                @if ($item->id == 1)
                                                    <x-shared.svg.pickup class="h-24 w-24" />
                                                @else
                                                    <x-shared.svg.dropoff class="h-24 w-24" />
                                                @endif
                                                <span class="font-semibold text-gray-600 mt-2">
                                                    {{ $item->id == 1 ? 'Pick Up' : 'Drop Off' }}
                                                </span>
                                            </div>
                                        @empty
                                            <p>No Service Types Available</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>


                </div> --}}
            </div>


        </div>
    </div>


</div>
