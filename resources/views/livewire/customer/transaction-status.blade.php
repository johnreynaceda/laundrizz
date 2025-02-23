<div>
    <div>
        <div class="flex justify-between items-end">
            <h1 class="font-bold text-main uppercase">{{ $order->serviceType->name }} STATUS</h1>
        </div>
        <div class="mt-10">
            <ol class="relative border-s border-yellow-500 ">
                <li class="mb-5 ms-4">
                    <div
                        class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                    </div>

                    <h3 class=" font-semibold text-gray-600 ">Order Pending....</h3>
                    <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Please wait as your order
                        is
                        pending</p>
                    {{-- <a href="#"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Learn
                        more <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg></a> --}}
                </li>
                @if ($order->is_accepted)
                    <li class="mb-5 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Order has been accepted!</h3>
                    </li>
                    <li class="mb-5 ms-4">
                        <div
                            class="absolute w-3 h-3 bg-yellow-500 rounded-full mt-1.5 -start-1.5 border border-yellow-500  ">
                        </div>

                        <h3 class=" font-semibold text-gray-600 ">Your Laundry Collector is getting ready</h3>
                        <p class="mb-4 text-xs font-normal text-gray-500 dark:text-gray-400">Your Driver is getting
                            ready to go to your location</p>
                        <div>
                            <x-button label="CANCEL" negative rounded xs class="px-4" />
                        </div>
                    </li>
                @endif

            </ol>


        </div>
    </div>
</div>
