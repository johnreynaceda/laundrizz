<div>
    @if (!$type)
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-center text-gray-600"> As </h1>
            <div class="grid grid-cols-2 gap-5 mt-5">
                <div wire:click="$set('type', 'Customer')"
                    class="bg-white shadow h-40 w-40 rounded-xl border grid place-content-center text-center">
                    <x-shared.customer class="h-20" />
                    <span class="mt-2 font-semibold text-main">Customer</span>
                </div>
                <div wire:click="$set('type', 'Merchant')"
                    class="bg-white shadow h-40 w-40 rounded-xl border grid place-content-center text-center">
                    <x-shared.svg.dropoff class="h-20" />
                    <span class="mt-2 font-semibold text-main">Merchant</span>
                </div>

            </div>
        </div>
    @else
        @switch($type)
            @case('Customer')
                <div>
                    <div class="flex space-x-2 items-end">
                        <div wire:click="$set('type', '')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                        </div>
                        <h1 class="font-medium text-lg text-gray-600">As Customer</h1>
                        <x-shared.customer class="h-10" />
                    </div>
                    <div class="my-3 border-t">
                        <div class="mt-3">
                            {{ $this->form }}
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button wire:click="register" class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            @break

            @case('Merchant')
                <div>
                    <div class="flex space-x-2 items-end">
                        <div wire:click="$set('type', '')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                        </div>
                        <h1 class="font-medium text-lg text-gray-600">As Merchant</h1>
                        <x-shared.svg.dropoff class="h-10" />
                    </div>
                    <div class="my-3 border-t">
                        <div class="mt-3">
                            {{ $this->form }}
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button wire:click="register" class="ms-4 flex space-x-1 items-center">
                                <span> {{ __('Register') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" wire:target="register" wire:loading="register"
                                    width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-loader animate-spin">
                                    <path d="M12 2v4" />
                                    <path d="m16.2 7.8 2.9-2.9" />
                                    <path d="M18 12h4" />
                                    <path d="m16.2 16.2 2.9 2.9" />
                                    <path d="M12 18v4" />
                                    <path d="m4.9 19.1 2.9-2.9" />
                                    <path d="M2 12h4" />
                                    <path d="m4.9 4.9 2.9 2.9" />
                                </svg>
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            @break

            @default
        @endswitch
    @endif
    <div class="mt-10 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Already have an account?') }}
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </p>
    </div>
</div>
