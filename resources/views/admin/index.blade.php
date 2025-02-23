@section('title', 'Dashboard')
<x-superadmin-layout>
    <div>
        <h1 class="text-2xl">Good Day, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">Here's what's new today</p>
    </div>
    <div class="mt-10">
        <h1 class="font-bold text-xl text-gray-700">SALES REPORT</h1>

        <div class="mt-5 w-40">
            <x-native-select>
                <option>Last 7 days</option>
                <option>Last 30 days</option>
            </x-native-select>
        </div>
        <div class="mt-5 grid grid-cols-4 gap-5">
            <div class=" rounded-xl bg-white px-10 py-5 col-span-2 shadow">
                <p class="font-semibold text-main text-lg">TOTAL SALES</p>
                <div class="mt-2">
                    <h1 class="text-5xl font-bold text-gray-600">&#8369;{{ number_format(335980, 2) }}</h1>
                </div>
            </div>
            <div class="col-span-2"></div>
            <div class=" rounded-xl bg-white px-10 py-5 col-span-2 shadow">
                <ul class="space-y-3">
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Total Orders:</p>
                            <p class="font-semibold text-main text-lg">5679 Orders</p>
                        </div>
                    </li>
                    <li>
                        <div class="flex justify-between items-center">
                            <p class="">Average Order value:</p>
                            <p class="font-semibold text-main text-lg">&#8369;{{ number_format(454, 2) }}</p>
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
        </div>
    </div>
</x-superadmin-layout>
