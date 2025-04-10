<div>
    <div class=" flex space-x-5">
        @forelse (\App\Models\ServiceType::all() as $item)
            <a href="{{ route('staff.transaction', ['id' => $item->id]) }}"
                class="bg-white hover:scale-95 hover:border-2 w-40 h-40 rounded-3xl text-center grid place-content-center">
                @if ($item->id == 1)
                    <x-shared.svg.pickup class="h-24 w-24" />
                @else
                    <x-shared.svg.dropoff class="h-24 w-24" />
                @endif
                <span class="font-semibold text-gray-600 mt-2">{{ $item->name }}</span>
            </a>

        @empty
            <span>No Services</span>
        @endforelse
    </div>
    <div class="mt-5 grid 2xl:grid-cols-2 gap-10">
        <div class="">
            <h1 class="text-xl font-bold text-gray-700">PICK UP </h1>
            <ul class="mt-3 max-h-96 overflow-y-auto space-y-2">
                @forelse ($pickups as $item)
                    <li class="bg-white rounded-xl flex justify-between shadow items-center p-2 px-5">
                        <div class="flex space-x-3">
                            <div class="h-10 w-10 bg-gray-100 shadow rounded-xl">
                                <x-shared.svg.dropoff class="h-10 w-10 text-white" />
                            </div>
                            <div>
                                <h1>Order #{{ $item->serviceTransaction->id }}</h1>
                                <h1 class="text-sm leading-3 text-gray-500">{{ $item->serviceTransaction->user->name }}
                                </h1>
                            </div>
                        </div>
                        <div>
                            @php
                                $time = \Carbon\Carbon::parse($item->estimated_time)->format('h:i A'); // Example: "09:00 PM"
                                $createdAt = $item->created_at; // Example: "2025-03-01 10:00 AM"

                                // Convert the estimated time into Carbon with today's date format
$estimatedDateTime = \Carbon\Carbon::parse($createdAt->format('Y-m-d') . ' ' . $time);

// If the estimated time already passed, don't add another day
                                if (
                                    $estimatedDateTime->isPast() &&
                                    $createdAt->format('Y-m-d') == now()->format('Y-m-d')
                                ) {
                                    $estimatedDateTime = $estimatedDateTime; // No need to add day
                                }
                            @endphp
                            <h1 class="text-sm text-gray-500">Remaining Time: <span class="text-red-600"><x-countdown
                                        :expires="$estimatedDateTime" class="text-gray-600 font-semibold" /></span>

                            </h1>
                        </div>
                    </li>
                @empty
                    <li>
                        No Pick Up..
                    </li>
                @endforelse

            </ul>
        </div>
        <div>
            <div class="">
                <h1 class="text-xl font-bold text-gray-700">DROP OFF </h1>
                <ul class="mt-3 max-h-96 overflow-y-auto space-y-2">
                    @forelse ($dropoffs as $item)
                        <li class="bg-white rounded-xl flex justify-between shadow items-center p-2 px-5">
                            <div class="flex space-x-3">
                                <div class="h-10 w-10 bg-gray-100 shadow rounded-xl">
                                    <x-shared.svg.dropoff class="h-10 w-10 text-white" />
                                </div>
                                <div>
                                    <h1>Order #{{ $item->serviceTransaction->id }}</h1>
                                    <h1 class="text-sm leading-3 text-gray-500">
                                        {{ $item->serviceTransaction->user->name }}
                                    </h1>
                                </div>
                            </div>
                            <div>
                                @php
                                    $time = \Carbon\Carbon::parse($item->estimated_time)->format('h:i A'); // Example: "09:00 PM"
                                    $createdAt = $item->created_at; // Example: "2025-03-01 10:00 AM"

                                    // Convert the estimated time into Carbon with today's date format
$estimatedDateTime = \Carbon\Carbon::parse(
    $createdAt->format('Y-m-d') . ' ' . $time,
);

// If the estimated time already passed, don't add another day
                                    if (
                                        $estimatedDateTime->isPast() &&
                                        $createdAt->format('Y-m-d') == now()->format('Y-m-d')
                                    ) {
                                        $estimatedDateTime = $estimatedDateTime; // No need to add day
                                    }
                                @endphp
                                <h1 class="text-sm text-gray-500">Remaining Time: <span
                                        class="text-red-600"><x-countdown :expires="$estimatedDateTime"
                                            class="text-gray-600 font-semibold" /></span>

                                </h1>
                            </div>
                        </li>
                    @empty
                        <li>
                            No Drop off..
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
