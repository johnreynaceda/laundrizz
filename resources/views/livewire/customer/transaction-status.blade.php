<div x-data="{ modalOpen: @entangle('payment_modal') }">
    @if ($status->count() > 0)
        @if ($order->status == 'placed order')
        <div>
            <div class="flex justify-between items-end ">
                <h1 class="font-bold text-main uppercase">ORDER DETAIL</h1>
                <x-button label="Report" squared outline negative right-icon="flag" xs class="font-medium" />
            </div>
            <div class="mt-5 text-center">
                <h1 class="font-semibold text-xl text-gray-600">Reference Number</h1>
                <h1 class="font-bold text-lg">{{$order->orderDetail->reference_number}}</h1>
            </div>
            <div class="mt-5">
                <div class="flex flex-col">
                    <div class=" overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden border  border-gray-300">
                                <table class=" min-w-full  ">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th scope="col"
                                                class="p-1 text-center text-xs leading-6 font-medium text-gray-900 capitalize">
                                            </th>
                                            <th scope="col"
                                                class="p-1 w-16 text-center text-xs leading-6 font-medium text-gray-900 capitalize">
                                                Quantity</th>
                                            <th scope="col"
                                                class="p-1 w-16 text-center text-xs leading-6 font-medium text-gray-900 capitalize">
                                                Weight</th>
                                            <th scope="col"
                                                class="p-1 w-16 text-center text-xs leading-6 font-medium text-gray-900 capitalize">
                                                Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300">
                                        @php
                                        $grandTotal = 0;
                                        @endphp

                                        @foreach ($details as $item)
                                        <!-- Catalog Name -->
                                        <tr>
                                            <td colspan="4"
                                                class="text-left px-1 uppercase font-semibold text-xs text-gray-700">
                                                {{ $item['catalog'] }}
                                            </td>
                                        </tr>

                                        @foreach ($item['services'] as $service)
                                        @php
                                        $grandTotal += $service['total']; // Sum Grand Total directly from service
                                        @endphp
                                        <tr>
                                            <td class="p-1 text-xs text-left font-medium text-gray-500">
                                                {{ $service['service'] }} <!-- Service Name -->
                                            </td>
                                            <td class="p-1 text-xs text-center font-medium text-gray-700">
                                                {{ $service['quantity'] }}
                                            </td>
                                            <td class="p-1 text-xs text-center font-medium text-gray-700">
                                                {{ $service['weight'] }} KG
                                            </td>
                                            <td class="p-1 text-xs text-center font-medium text-gray-700">
                                                &#8369;{{ number_format($service['total'], 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endforeach

                                        <!-- Grand Total Row -->
                                        <tr>
                                            <td colspan="3" class="text-right text-xs font-medium text-gray-700">
                                                TOTAL:
                                            </td>
                                            <td class="text-center text-xs py-1 text-green-700">
                                                <strong>&#8369;{{ number_format($grandTotal, 2) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-center flex flex-col items-center justify-center">
                @php
                $time = $order->orderDetail->estimated_time; // Example: "09:00 PM"
                $createdAt = $order->orderDetail->created_at; // Example: "2025-03-01 10:00 AM"

                // Convert the estimated time into Carbon with today's date
                $estimatedDateTime = \Carbon\Carbon::parse($createdAt->format('Y-m-d') . ' ' . $time);

                // If the estimated time already passed, don't add another day
                if ($estimatedDateTime->isPast() && $createdAt->format('Y-m-d') == now()->format('Y-m-d')) {
                $estimatedDateTime = $estimatedDateTime; // No need to add day
                }
                @endphp

                <div x-data="{ expired: false, countdown: '{{ $estimatedDateTime }}' }" x-init="
                            let timer = setInterval(() => {
                                let now = new Date().getTime();
                                let distance = new Date(countdown).getTime() - now;

                                if (distance <= 0) {
                                    clearInterval(timer);
                                    expired = true;
                                }
                            }, 1000);
                        ">
                    <template x-if="!expired">
                        <x-countdown :expires="$estimatedDateTime" class="flex space-x-2">
                            <div class="p-2 px-3 border rounded-xl" :class="{ 'text-red-600 border-red-600': expired }">
                                <h1 class="text-xl font-bold" x-text="timer.days">{{ $component->days() }}</h1>
                                <h1 class="text-xs leading-3">days</h1>
                            </div>
                            <div class="p-2 px-3 border rounded-xl" :class="{ 'text-red-600 border-red-600': expired }">
                                <h1 class="text-xl font-bold" x-text="timer.hours">{{ $component->hours() }}</h1>
                                <h1 class="text-xs leading-3">hours</h1>
                            </div>
                            <div class="p-2 px-3 border rounded-xl" :class="{ 'text-red-600 border-red-600': expired }">
                                <h1 class="text-xl font-bold" x-text="timer.minutes">{{ $component->minutes() }}</h1>
                                <h1 class="text-xs leading-3">min</h1>
                            </div>
                            <div class="p-2 px-3 border rounded-xl" :class="{ 'text-red-600 border-red-600': expired }">
                                <h1 class="text-xl font-bold" x-text="timer.seconds">{{ $component->seconds() }}</h1>
                                <h1 class="text-xs leading-3">sec</h1>
                            </div>
                        </x-countdown>
                    </template>

                    <template x-if="expired">
                        <div class="flex space-x-2 text-green-600 font-bold">
                            <h1 class="text-2xl">Done Laundry</h1>
                        </div>
                    </template>

                    <h1 class="text-main text-sm font-medium" ">
                                <span x-show=" !expired">Estimated Time</span>
                        <span x-show="expired  text-gray-600">Your laundry is ready.</span>
                    </h1>
                </div>
            </div>


            <div class="mt-5">
                <ol class="relative border-s border-yellow-500 ">
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Order Placed</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">The seller or e-commerce
                            platform receives the order.</p>
                    </li>
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Payment Processing</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Kindly upload screenshot of
                            payment if you use e-wallet</p>
                        <div>
                            <x-button label="UPLOAD HERE" :disabled="$order->orderDetail->proof_of_payment != null"
                                :slate="$order->orderDetail->proof_of_payment != null" emerald rounded right-icon="photo" xs
                                class="px-4" @click="modalOpen=true" />
                        </div>
                    </li>
                    @if ($order->orderDetail->is_processing)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Order Processing</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">The seller begins processing
                            the order.</p>
                    </li>
                    @endif
                    @if ($order->orderDetail->is_ready)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Ready For Pickup / Delivery</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">The ordered items are securely
                            packaged.</p>
                        <div class="flex space-x-3">
                            <button wire:click="pickUp" :disabled="$order->orderDetail->order_type != null"
                                class="{{$order->orderDetail->order_type == 'Pick Up' ? 'bg-main text-white' : ''}} text-sm font-medium text-gray-600 px-3 py-1 border rounded">PICK
                                UP</button>
                            <button wire:click="deliver" :disabled="$order->orderDetail->order_type != null"
                                class="{{$order->orderDetail->order_type == 'Deliver' ? 'bg-main text-white' : ''}} text-sm font-medium text-gray-600 px-3 py-1 border rounded">DELIVER</button>

                        </div>
                    </li>
                    @endif
                    @if ($order->orderDetail->is_complete)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Order Complete</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">The packaged items are handed
                            to the courier.</p>
                        <x-textarea label="" placeholder="write your comment" wire:model="comment" class="text-xs" />
                        <x-button label="Send" wire:click="sendComment" spinner="sendComment" slate xs class="mt-2 " />
                    </li>
                    @endif
                </ol>
            </div>
            @if ($order->orderDetail->is_complete)
            <div class="mt-5 border-t flex justify-center pt-5">
                <x-button label="EMAIL E-RECEIPT" slate class="font-semibold" />
            </div>
            @endif
        </div>

        <div @keydown.escape.window="modalOpen = false" class="relative z-50 w-auto h-auto">
            <template x-teleport="body" wire:ignore>
                <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
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
                            <h3 class="text-lg font-semibold">Upload Payment</h3>
                            <button @click="modalOpen=false"
                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="relative w-auto">
                            <div class="mt-10">
                                {{$this->form}}
                            </div>
                            <div class="mt-5">
                                <x-button label="Submit Payment" slate squared outline sm class="font-semibold"
                                    wire:click="uploadPayment" spinner="uploadPayment" />
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        @else
        <div>
            <div class="flex justify-between items-end">
                <h1 class="font-bold text-main uppercase">{{ $order->serviceType->name }} STATUS</h1>
            </div>
            @if ($order->is_arrived)
            <div class="h-96 gird place-content-center">
                <p class="text-lg font-bold text-center text-gray-600">Please wait for the staff to finish your order form.
                </p>
            </div>
            @else
            <div class="mt-5">
                <ol class="relative border-s border-yellow-500 ">
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Order Pending....</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Please wait as your order
                            is
                            pending</p>

                    </li>
                    @if ($order->is_accepted)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Order has been accepted!</h3>
                    </li>
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Laundry Collector is getting ready.</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Your Driver is getting
                            ready to go to your location</p>
                        <div>
                            <x-button label="CANCEL" negative rounded xs class="px-4" />
                        </div>
                    </li>
                    @endif
                    @if ($order->is_on_the_way)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Laundry Collector is on the way.</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">The driver is en route to
                            your location</p>
                        <div class="flex flex-col space-y-3 w-full">
                            <div>
                                <h1 class="text-xl font-bold uppercase text-main">{{ $queue }}</h1>
                                <h1 class="text-xs font-semibold text-gray-600 leading-3">POSITION IN QUEUE</h1>
                            </div>
                        </div>
                    </li>
                    @endif
                    @if ($order->is_arrived)
                    <li class="mb-3 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Laundry Collector has arrived.</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Your driver is here! Please
                            fill up order form</p>

                    </li>
                    @endif

                </ol>


            </div>
            <div class="mt-10 flex justify-center">
                @if ($order->is_arrived)
                <x-button href="{{ route('customer.transaction') }}" label="PROCEED" positive right-icon="arrow-right"
                    rounded class="font-semibold px-6" />
                @endif
            </div>
            @endif
        </div>
        @endif
    @else
        <div class="mt-20 text-center grid place-content-center">
            <x-shared.status class="h-64"/>
            <h1 class="mt-4">No Order!</h1>
        </div>
    @endif
</div>