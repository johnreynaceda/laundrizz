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
</div>
