<div>

    @if (session()->has('error'))
        <div class="alert alert-danger text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="login">


        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email/Username')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" name="email" :value="old('email')"
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button type="submit" class="ms-3 flex space-x-1 items-center">
                <span> {{ __('Log In') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" wire:target="login" wire:loading="login" width="20"
                    height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader animate-spin">
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
    </form>
    <div x-data="{ modalOpen: @entangle('otp_modal') }" wire:ignore class="relative z-50 w-auto h-auto">

        <template x-teleport="body">
            <div x-show="modalOpen" x-cloak
                class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
                    class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative w-full py-6 bg-white px-7 sm:max-w-2xl sm:rounded-lg">
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-lg font-semibold"></h3>
                        <button @click="modalOpen=false"
                            class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative w-auto">
                        <h1 class="text-xl mt-5  text-center font-bold">Verify</h1>
                        <p class="text-sm text-gray-500 text-center    ">A One-Time Password has been sent to email
                            {{ $email }}.</p>

                        <div class="mt-5">
                            <div class="bg-white p-4 text-center rounded-lg ">


                                <h1 class="font-bold">Your OTP code:</h1>
                                <div class="flex space-x-2 mt-5">
                                    <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs"
                                        x-data="{
                                            one: @entangle('one'),
                                            two: @entangle('two'),
                                            three: @entangle('three'),
                                            four: @entangle('four')
                                        }">
                                        <div class="w-16 h-16">
                                            <input x-ref="inputOne" x-model="one" maxlength="1"
                                                x-on:input="if ($event.target.value.match(/^[0-9a-zA-Z]$/)) { $refs.inputTwo.focus(); } else { $event.target.value = ''; }"
                                                class="w-full h-full flex items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700"
                                                type="text">
                                        </div>

                                        <div class="w-16 h-16">
                                            <input x-ref="inputTwo" x-model="two" maxlength="1"
                                                x-on:input="if (one && $event.target.value.match(/^[0-9a-zA-Z]$/)) { $refs.inputThree.focus(); } else { $event.target.value = ''; }"
                                                x-bind:disabled="!one"
                                                class="w-full h-full flex items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700 disabled:bg-gray-200"
                                                type="text">
                                        </div>

                                        <div class="w-16 h-16">
                                            <input x-ref="inputThree" x-model="three" maxlength="1"
                                                x-on:input="if (one && two && $event.target.value.match(/^[0-9a-zA-Z]$/)) { $refs.inputFour.focus(); } else { $event.target.value = ''; }"
                                                x-bind:disabled="!one || !two"
                                                class="w-full h-full flex items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700 disabled:bg-gray-200"
                                                type="text">
                                        </div>

                                        <div class="w-16 h-16">
                                            <input x-ref="inputFour" x-model="four" maxlength="1"
                                                x-on:input="if (!one || !two || !three) { $event.target.value = ''; }"
                                                x-bind:disabled="!one || !two || !three"
                                                class="w-full h-full flex items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700 disabled:bg-gray-200"
                                                type="text">
                                        </div>
                                    </div>


                                </div>

                                <div wire:loading.remove wire:target="verifyLogin" class="mt-10">
                                    <button wire:click="verifyLogin"
                                        class=" h-10 px-10 bg-blue-500 text-white font-bold rounded-md text-sm uppercase tracking-wider transition duration-300 ease-in-out focus:outline-none focus:shadow-outline">
                                        Verify Otp
                                    </button>
                                </div>
                                <div wire:loading.class.remove="hidden"
                                    class="mt-10 text-gray-500 hidden flex space-x-2 justify-center items-center">
                                    <span class="text-sm">Please Wait while validating the code.</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-loader-circle animate-spin">
                                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
