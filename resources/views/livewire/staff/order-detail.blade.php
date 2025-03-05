<div>
    <div class="grid grid-cols-8 gap-10">
        <div class="col-span-6">
            <div class="bg-white border-b px-5 py-3 rounded-xl">
                <div class="flex flex-col items-center">
                    <h1 class="text-lg font-bold uppercase text-gray-600">Reference Number:
                        {{$detail->reference_number}}
                    </h1>
                    <div class="leading-3 text-center">
                        <h1 class=" uppercase  text-main">{{$detail->serviceTransaction->user->name}} |
                            {{$detail->serviceTransaction->user->locations->where('is_default', true)->first()->contact}}
                        </h1>
                        <p class=" text-sm text-gray-600">
                            {{$detail->serviceTransaction->user->locations->where('is_default', true)->first()->address}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 bg-white p-5 rounded-xl">
                <div class="px-8">
                    <div class="mb-3 flex gap-2 flex-wrap">
                        @if ($detail->is_paid)
                            <x-badge label="Paid" positive flat />
                        @endif
                        @if ($detail->is_processing)
                            <x-badge label="Processing" positive flat />
                        @endif
                        @if ($detail->is_ready)
                            <x-badge label="Ready" positive flat />
                        @endif
                        @if ($detail->is_complete)
                            <x-badge label="Completed" positive flat />
                        @endif
                    </div>
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
                    <div class="mt-5 grid grid-cols-2 gap-10">
                        <div>
                            <div class="">
                                <h1 class="text-lg font-semibold text-gray-600">Order Type:</h1>
                                <div class="space-y-2 mt-3">
                                    <div class="flex space-x-2  items-end">
                                        <div class="h-5 w-5 rounded border border-gray-400">
                                            @if ($detail->order_type == 'Pick Up')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-check text-green-600">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <x-shared.pick-up class="h-10" />
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 items-end">
                                        <div class="h-5 w-5 rounded border border-gray-400">
                                            @if ($detail->order_type == 'Deliver')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-check text-green-600">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <x-shared.deliver class="h-10" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10">
                                <h1 class="text-lg font-semibold text-gray-600">Payment:</h1>
                                <div class="mt-1  rounded-xl border overflow-hidden">
                                    @if ($detail->proof_of_payment)
                                        <a href="{{Storage::url($detail->proof_of_payment)}}" target="_blank">
                                            <img src="{{Storage::url($detail->proof_of_payment)}}"
                                                class="w-full h-40 hover:scale-95 transition ease-out duration-300 object-cover"
                                                alt="">
                                        </a>
                                    @else
                                        <img src="https://img.freepik.com/premium-vector/no-payment-red-rubber-stamp-vector-illustration_545399-3701.jpg"
                                            class="w-full h-40 object-cover" alt="">
                                    @endif
                                </div>
                                <p class="text-xs text-gray-400"> If payment has been uploaded, it will appear here.</p>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg font-semibold text-gray-600">Comment:</h1>
                            <div class="mt-2 border rounded-xl p-2 ">
                                <p class="text-sm  text-gray-600 indent-10 text-justify">
                                    {{$detail->comment ?? ''}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="bg-white p-5 rounded-xl">
                <h1 class="font-medium border-b text-gray-600">Order Actions</h1>
                <div class="flex gap-2 mt-3 flex-wrap">
                    <x-button label="Verify Payment" :disabled="$detail->is_paid == true || $detail->proof_of_payment == null" wire:click="verifyPayment" spinner="verifyPayment" sm positive
                        outline class="font-medium" />
                    <x-button label="Mark as Processing" :disabled="$detail->is_processing == true" sm warning outline
                        class="font-medium" wire:click="orderProcessing" spinner="orderProcessing" />
                    <x-button label="Mark as Ready" :disabled="$detail->is_ready == true" sm blue outline
                        class="font-medium" wire:click="markReady" spinner="markReady" />
                    <x-button label="Mark as Complete" :disabled="$detail->is_complete == true" sm positive
                        class="font-medium" wire:click="completed" spinner="completed" />
                </div>
            </div>
        </div>
    </div>
</div>