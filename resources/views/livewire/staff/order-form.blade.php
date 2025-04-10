<div>
    <div class="bg-white p-5 rounded-xl flex flex-col items-center">
        <div class="flex space-x-1 items-center">
            <h1 class="font-bold text-gray-600">ORDER #{{ $order->id }} |
            </h1>
            <h1 class="font-medium text-sm text-gray-500"> {{ $order->created_at->format('F d, Y h:i A') }}</h1>
        </div>
        <div class="mb-1">
            <h1 class="font-medium text-gray-600">{{ $order->user->name }}</h1>
        </div>
        <x-button label="Previously Ordered" xs outlined slate />
    </div>
    <div class="mt-3 grid  grid-cols-7 gap-10">
        <div class="2xl:col-span-5 col-span-7">
            <div class="bg-white p-5 rounded-xl">
                {{ $this->form }}
            </div>
        </div>
        <div class="2xl:col-span-2 col-span-7">
            <div class="bg-white p-5 rounded-xl">
                <h1 class="font-medium">Order Details</h1>
                <div class="mt-4 text-sm">
                    @php
                        $total = 0; // Initialize total amount
                    @endphp
                    @forelse ($newItems as $item)
                        @php
                            $catalog = \App\Models\Catalog::where('id', $item['catalog'] ?? 0)->first();
                            $service = \App\Models\CatalogService::where('id', $item['service'] ?? 0)->first();
                            $subtotal = ($service->price ?? 0) * ($item['weight'] ?? 0); // Subtotal for each item
                            $total += $subtotal; // Add to total
                        @endphp
                        <div class="border-b">
                            <h1>{{ $catalog->name ?? '' }}</h1>
                        </div>
                        <div class="mt-1 flex justify-between items-center">
                            <div class="flex space-x-3">
                                <h1>{{ $service->name ?? '' }}</h1>
                                <h1>{{ $item['quantity'] ?? '' }}</h1>
                            </div>
                            <span>{{ ($item['weight'] ?? 0) . 'KG' }}</span>
                        </div>
                        <div class="mt-1 border-t flex justify-end">
                            <h1 class="text-gray-600">
                                &#8369;{{ number_format($subtotal, 2) }}
                            </h1>
                        </div>
                    @empty
                        <div>No Items Found</div>
                    @endforelse
                </div>
            </div>


            <!-- Total Display -->
            <div class="mt-2 bg-white  p-5 rounded-xl">
                <div class=" flex justify-between">
                    <span class="font-semibold text-gray-600">TOTAL</span>
                    <span class="font-semibold text-green-700">&#8369;{{ number_format($total, 2) }}</span>
                </div>

                <div class="mt-2">
                    <label for="" class="text-xs text-gray-600">Estimated time to be done</label>
                    <x-input type="time" wire:model="estimated_time" />
                </div>
            </div>


            <div class="mt-5">
                <x-button label="Save Order Form" wire:click="saveOrder({{ $subtotal }})"
                    spinner="saveOrder({{ $subtotal }})" class="w-full uppercase font-semibold"
                    right-icon="arrow-right" positive />
            </div>
        </div>

    </div>
</div>
