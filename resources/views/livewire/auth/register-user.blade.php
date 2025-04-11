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
    <div class="mt-5 text-center">
        <p>
            <button @click="$dispatch('open-modal', { id: 'data-privacy' })"
                class="text-sm hover:underline hover:text-green-600 text-gray-600">
                Data Privacy Agreement
            </button>
        </p>
        <p>
            <button @click="$dispatch('open-modal', { id: 'agreement' })"
                class="text-sm hover:underline hover:text-green-600 text-gray-600">
                Terms and Agreements
            </button>
        </p>

        <x-filament::modal id="data-privacy">
            <x-slot name="header">
                <h2 class="text-lg font-semibold text-gray-800">Data Privacy</h2>
            </x-slot>

            <div class="space-y-4 text-sm text-gray-700">
                <p>
                    Laundrizz values your privacy and is committed to safeguarding the confidentiality and security of
                    your personal information. In full compliance with the Data Privacy Act of 2012 (RA 10173), its
                    Implementing Rules and Regulations, and all relevant issuances by the National Privacy Commission,
                    Laundrizz ensures that your data is protected at all times.
                </p>
                <p>
                    We implement appropriate organizational, physical, and technical measures to protect your personal
                    information against loss, unauthorized access, misuse, or alteration. While we strive to use
                    commercially acceptable means to protect your data, please note that no method of transmission over
                    the internet or electronic storage is completely secure.
                </p>
                <p>
                    By accessing and using the Laundrizz platform, you acknowledge and consent to the collection,
                    processing, and use of your personal data in accordance with this privacy policy.
                </p>
            </div>


        </x-filament::modal>


        <x-filament::modal id="agreement" x-data
            x-on:open-modal.window="$event.detail.id === 'agreement' && $nextTick(() => $el.scrollTo({ top: 0, behavior: 'auto' }))">

            <x-slot name="header">
                <h2 class="text-lg font-semibold text-gray-800">Terms and Agreements</h2>
            </x-slot>

            <div class="space-y-4 text-sm text-gray-700 text-justify max-h-[70vh] overflow-y-auto px-1">
                <h1 class="font-bold">For Merchants:</h1>
                <p>
                    By registering as a Merchant on the Laundrizz platform, you agree to the following terms:
                </p>
                <p>
                    Account Responsibility – You are responsible for maintaining the accuracy of your business
                    information, securing your login credentials, and managing your staff accounts properly. Any actions
                    taken under your account are considered your responsibility.
                </p>
                <p>
                    Service Commitment – You agree to fulfill laundry services accurately and within the timeframes
                    indicated to customers. Misuse of the platform, such as intentionally delaying or misrepresenting
                    services, may result in penalties or account suspension.
                </p>
                <p>
                    Data Usage and Privacy – You consent to the collection and use of your business and transactional
                    data for system operations, analytics, and improvements, in accordance with our Data Privacy Policy.
                </p>
                <p>
                    Subscription and Fees – By using the platform, you agree to pay the applicable subscription fees and
                    transaction charges. Laundrizz reserves the right to modify pricing structures with prior notice.
                </p>
                <p>
                    Platform Conduct – Merchants are expected to operate with professionalism and integrity. Misconduct,
                    abusive behavior, or fraudulent activity will not be tolerated and may lead to account termination.
                </p>
                <p>
                    Modification of Terms – Laundrizz reserves the right to update or change the terms at any time.
                    Continued use of the platform constitutes your acceptance of any revised terms.
                </p>
                <p>
                    ---------------------------------------------------------------------------------------------
                </p>
                <h1 class="font-bold">For For Customers:</h1>
                <p>
                    By creating an account and using the Laundrizz app as a Customer, you agree to the following terms:
                </p>
                <p>
                    Account Use – You are responsible for providing accurate personal information and for maintaining
                    the confidentiality of your login credentials. You agree to use the platform for lawful and intended
                    purposes only.
                </p>
                <p>
                    Service Orders – When placing a laundry order, you agree to the pricing, turnaround time, and terms
                    provided by the selected merchant. Misuse of the system, such as repeated cancellations or false
                    claims, may lead to account restrictions.
                </p>
                <p>
                    Payments and Refunds – Payments must be made through the provided secure methods. Refunds, if
                    applicable, are subject to the individual merchant’s refund policies and conditions.
                </p>
                <p>
                    Privacy and Data Protection – Your personal data will be collected and processed in accordance with
                    our Data Privacy Policy, ensuring the confidentiality and security of your information.
                </p>
                <p>
                    Platform Integrity – You agree not to attempt any unauthorized access, reverse engineering, or
                    disruption of the Laundrizz system. Any violation may result in legal action or account suspension.
                </p>
                <p>
                    Amendments – Laundrizz may revise these terms at any time. Continued use of the service following
                    any changes implies your acceptance of the updated agreement.

                </p>
            </div>
        </x-filament::modal>
    </div>

    <div class="mt-5 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Already have an account?') }}
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </p>
    </div>
</div>
