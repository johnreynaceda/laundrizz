<div>
    <div class="space-y-3">
        @foreach ($this->catalogs as $item)
            <div class="border-b pb-2 flex items-center justify-between">
                <h1 class="font-semibold uppercase">{{ $item->name }}</h1>
                <x-button wire:click="addItem({{ $item->id }})" label="Add Item" xs slate icon="plus" />
            </div>

            <div class="mt-3 grid grid-cols-3 gap-5">
                @foreach ($this->newItems[$item->id] as $index => $newItem)
                    <div class="border bg-white shadow rounded-xl overflow-hidden relative p-3 pt-7">
                        <div class="absolute right-0 top-0"
                            wire:click="removeItem({{ $item->id }}, {{ $index }})">
                            <button class="grid h-full place-content-center hover:text-red-800 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class="space-y-1">
                            <!-- Service Selection -->
                            <x-filament::input.wrapper>
                                <x-filament::input.select
                                    wire:model="newItems.{{ $item->id }}.{{ $index }}.service_id">
                                    <option value="">Select Service</option>
                                    @foreach ($item->catalogServices as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} -
                                            ${{ $service->price_per_kg }} per kg</option>
                                    @endforeach
                                </x-filament::input.select>
                            </x-filament::input.wrapper>

                            <!-- Quantity Input -->
                            <x-filament::input.wrapper>
                                <x-filament::input type="number"
                                    wire:model="newItems.{{ $item->id }}.{{ $index }}.quantity"
                                    placeholder="Quantity" />
                            </x-filament::input.wrapper>

                            <!-- Weight Input -->
                            <x-filament::input.wrapper>
                                <x-filament::input type="number"
                                    wire:model="newItems.{{ $item->id }}.{{ $index }}.weight"
                                    placeholder="Weight (kg)" />
                            </x-filament::input.wrapper>

                            <!-- Price per KG (Read-only) -->
                            <x-filament::input.wrapper>
                                <x-filament::input type="text"
                                    wire:model="newItems.{{ $item->id }}.{{ $index }}.price_per_kg"
                                    readonly placeholder="Price per KG" />
                            </x-filament::input.wrapper>

                            <!-- Total Price (Read-only) -->
                            <x-filament::input.wrapper>
                                <x-filament::input type="text"
                                    wire:model="newItems.{{ $item->id }}.{{ $index }}.total_price" readonly
                                    placeholder="Total Price" />
                            </x-filament::input.wrapper>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <!-- Total Amount Display -->
        <div class="mt-5 p-4 bg-gray-100 border rounded-lg text-lg font-semibold">
            Total Amount: ${{ number_format($this->totalAmount, 2) }}
        </div>
    </div>

</div>
