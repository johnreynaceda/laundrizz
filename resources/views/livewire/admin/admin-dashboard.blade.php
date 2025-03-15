<div x-data="{ modalOpen: @entangle('showRenewModal'), subscriptionName: @entangle('subsription') }">
    <div class="mt-10 grid grid-cols-8 gap-10">
        <div class="col-span-6">
            <h1 class="font-bold text-xl text-gray-700">SALES REPORT</h1>

            <div class="mt-5 w-40">
                <x-native-select>
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                </x-native-select>
            </div>
            <div class="mt-5 grid grid-cols-4 gap-10">
                <div class=" rounded-xl bg-white px-10 py-5 col-span-2 shadow">
                    <p class="font-semibold text-main text-lg">TOTAL SALES</p>
                    <div class="mt-2">
                        <h1 class="text-5xl font-bold text-gray-600">
                            &#8369;{{ number_format($sales ? $sales->sum('total_amount') : 0, 2) }}</h1>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class=" rounded-xl bg-white px-10 py-5 shadow">
                        <p class="font-semibold text-main text-lg">SALES TODAY</p>
                        <div class="mt-2">
                            <h1 class="text-5xl font-bold text-gray-600">
                                &#8369;{{ number_format($today ? $today->sum('total_amount') : 0, 2) }}</h1>
                        </div>
                    </div>
                </div>
                <div class=" rounded-xl bg-white px-4 py-5 col-span-2 shadow">
                    <ul class="space-y-3">
                        <li>
                            <div class="flex justify-between items-center">
                                <p class="">Total Orders:</p>
                                <p class="font-semibold text-main text-md">{{ $sales->count() }} Orders</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <p class="">Average Order value:</p>
                                <p class="font-semibold text-main ">
                                    &#8369;{{ number_format($sales && $sales->count() > 0 ? $sales->sum('total_amount') / $sales->count() : 0, 2) }}
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <p class="">Top Laundry Service:</p>
                                <p class="font-semibold text-main ">Wash/Dry</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <p class="">Top Dry Cleaning Service:</p>
                                <p class="font-semibold text-main ">Suit</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <p class="">Top Other Service:</p>
                                <p class="font-semibold text-main ">Detergent</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-span-2">
                    <grid class="grid grid-cols-2 gap-5">
                        <div class="bg-white p-3 rounded-xl">
                            <p class="font-semibold text-main">PICK-UP ORDER</p>
                            <div class="mt-2">
                                <h1 class="text-5xl text-center font-bold text-gray-600">
                                    {{ $pickup }}
                                </h1>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-xl">
                            <p class="font-semibold text-main">DROP-OFF ORDER</p>
                            <div class="mt-2">
                                <h1 class="text-5xl text-center font-bold text-gray-600">
                                    {{ $dropoff }}
                                </h1>
                            </div>
                        </div>
                    </grid>

                </div>
            </div>
        </div>

        <div class="col-span-2">
            <h1 class="text-xl font-bold uppercase text-gray-600">Subscription</h1>
            <div class="mt-5">
                <ul class="space-y-3">
                    @php
                        use Carbon\Carbon;

                        $userShop = auth()->user()->shop;

                        // Get the latest expired subscription payment
                        $latestExpiredPayment = $userShop
                            ? $userShop->subscriptionPayments
                                ->where('is_paid', true)
                                ->where('is_expired', true)
                                ->sortByDesc('updated_at')
                                ->first()
                            : null;

                        // Get the latest active (non-expired) subscription payment as the start date
                        $latestActivePayment = $userShop
                            ? $userShop->subscriptionPayments
                                ->where('is_paid', true)
                                ->where('is_expired', false)
                                ->sortByDesc('updated_at')
                                ->first()
                            : null;

                        // Determine if the user has no active subscription at all
                        $noActiveSubscription = $latestActivePayment === null;
                    @endphp

                    @foreach ($subscriptions as $item)
                        @php
                            // Check if this subscription is active
                            $hasActiveSubscription = $userShop
                                ? $userShop->subscriptionPayments
                                    ->where('subscription_id', $item->id)
                                    ->where('is_paid', true)
                                    ->where('is_expired', false)
                                    ->isNotEmpty()
                                : false;

                            // Check if this plan is the latest expired one
                            $isLatestExpired =
                                $latestExpiredPayment && $latestExpiredPayment->subscription_id == $item->id;

                            // Use the latest active subscription payment's updated_at as the start date
                            $startDate =
                                $latestActivePayment && $latestActivePayment->subscription_id == $item->id
                                    ? Carbon::parse($latestActivePayment->updated_at)
                                    : null;

                            // Calculate remaining days (start date + subscription duration)
                            $expirationDate = $startDate ? $startDate->copy()->addMonths($item->month) : null;
                            $remainingDays = $expirationDate ? Carbon::now()->diffInDays($expirationDate, false) : null;
                        @endphp

                        <li class="bg-white p-3 rounded-xl">
                            <h1 class="font-semibold text-main">{{ $item->name }}</h1>
                            <div class="flex justify-between items-center">
                                <h1 class="text-gray-600">&#8369;{{ number_format($item->amount, 2) }}</h1>
                                <p class="text-gray-600 text-sm">/{{ $item->month }} month(s)</p>
                            </div>
                            <p class="text-sm">{{ $item->description }}</p>

                            <div class="mt-3">
                                @if ($remainingDays !== null && $remainingDays > 0)
                                    <p class="text-sm font-medium text-gray-600">
                                        Remaining days: <span
                                            class="font-semibold text-main">{{ intval($remainingDays) }}</span>
                                    </p>
                                    <div class="mt-1">
                                        <x-badge label="Your Plan" positive />
                                    </div>
                                @endif

                                @php
                                    // Get the most recent pending payment
                                    $latestPendingPayment = $userShop
                                        ? $userShop->subscriptionPayments
                                            ->where('is_paid', false) // Pending payment only
                                            ->sortByDesc('updated_at') // Get the most recent one
                                            ->first()
                                        : null;

                                    // Check if the current subscription is the one pending approval
                                    $isWaitingForApproval =
                                        $latestPendingPayment && $latestPendingPayment->subscription_id == $item->id;
                                @endphp

                                @if ($isWaitingForApproval)
                                    <span class="text-yellow-500 font-medium">Waiting for Approval</span>
                                @elseif (!$latestPendingPayment && ($noActiveSubscription || ($isLatestExpired && !$latestActivePayment)))
                                    <x-button wire:click="confirmRenew({{ $item->id }})" :class="$isLatestExpired ? 'bg-red-500 text-white' : 'bg-green-500 text-white'"
                                        label="{{ $isLatestExpired ? 'Renew Expired Plan' : 'Choose Plan' }}" rounded
                                        sm />
                                @endif

                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>


    <div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto" wire:ignore>
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[50] flex items-center justify-center w-screen h-screen"
                x-cloak>
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
                    class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-lg font-semibold">Subscription Plan</h3>
                        <button @click="modalOpen=false"
                            class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative w-auto">
                        <div class="border-2 rounded-xl p-5">
                            <div class="flex justify-between item-end">
                                <p class="text-xl font-bold text-main" x-text="subscriptionName"> </p>
                                <div x-data="{ open: false }" class="">
                                    <!-- Button to trigger modal -->
                                    <button @click="open = true"
                                        class="w-12 h-12 border-2 rounded-xl grid place-content-center transition-all duration-200 hover:border-gray-700 hover:scale-90 hover:text-green-600 dark:hover:border-gray-500 dark:hover:text-green-400"
                                        aria-label="QR Code">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-qr-code">
                                            <rect width="5" height="5" x="3" y="3" rx="1" />
                                            <rect width="5" height="5" x="16" y="3" rx="1" />
                                            <rect width="5" height="5" x="3" y="16" rx="1" />
                                            <path d="M21 16h-3a2 2 0 0 0-2 2v3" />
                                            <path d="M21 21v.01" />
                                            <path d="M12 7v3a2 2 0 0 1-2 2H7" />
                                            <path d="M3 12h.01" />
                                            <path d="M12 3h.01" />
                                            <path d="M12 16v.01" />
                                            <path d="M16 12h1" />
                                            <path d="M21 12v.01" />
                                            <path d="M12 21v-1" />
                                        </svg>
                                    </button>

                                    <!-- Modal -->
                                    <div>
                                        <div x-show="open"
                                            class="fixed inset-0 bg-black z-50 bg-opacity-50 flex justify-center items-center">
                                            <div class="bg-white p-5 rounded-xl shadow-lg max-w-md relative">
                                                <!-- Close Button -->
                                                <button @click="open = false"
                                                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                                                    ×
                                                </button>

                                                @php
                                                    $image = \App\Models\PaymentMethod::where('user_id', 1)->first();
                                                @endphp
                                                @if ($image)
                                                    <img src="{{ Storage::url($image->payment_photo) }}"
                                                        alt="QR Code" class="rounded-lg w-full">
                                                @else
                                                    <p class="text-gray-700 text-sm md:text-base italic">
                                                        Please contact the administration to update their payment
                                                        method.
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-3">
                                {{ $this->form }}
                            </div>
                        </div>
                        <div class="mt-5">
                            <x-button label="Choose Plan & Submit" wire:click="renewSubscription"
                                spinner="renewSubscription" rounded slate class="font-semibold"
                                right-icon="arrow-right" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
