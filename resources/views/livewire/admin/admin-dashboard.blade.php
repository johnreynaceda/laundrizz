<div>
    <div class="mt-10">
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
            <div class=" rounded-xl bg-white px-10 py-5 col-span-2 shadow">
                <ul class="space-y-3">
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Total Orders:</p>
                            <p class="font-semibold text-main text-lg">{{ $sales->count() }} Orders</p>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Average Order value:</p>
                            <p class="font-semibold text-main text-lg">
                                &#8369;{{ number_format($sales && $sales->count() > 0 ? $sales->sum('total_amount') / $sales->count() : 0, 2) }}
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Top Laundry Service:</p>
                            <p class="font-semibold text-main text-lg">Wash/Dry</p>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Top Dry Cleaning Service:</p>
                            <p class="font-semibold text-main text-lg">Suit</p>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Top Other Service:</p>
                            <p class="font-semibold text-main text-lg">Detergent</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-span-2">
                <grid class="grid grid-cols-2 gap-5">
                    <div class="bg-white p-5 rounded-xl">
                        <p class="font-semibold text-main text-lg">PICK-UP ORDER</p>
                        <div class="mt-2">
                            <h1 class="text-5xl text-center font-bold text-gray-600">
                                {{ $pickup }}
                            </h1>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-xl">
                        <p class="font-semibold text-main text-lg">DROP-OFF ORDER</p>
                        <h1 class="text-5xl text-center font-bold text-gray-600">
                            {{ $dropoff }}
                        </h1>
                    </div>
                </grid>

            </div>
        </div>
    </div>
</div>
