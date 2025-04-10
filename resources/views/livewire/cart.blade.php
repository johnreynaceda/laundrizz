<div>
    <div class="grid mt-5 grid-cols-9 gap-10">
        <div class="col-span-6 ">
            <div class="flex justify-between items-center pr-2">
                <h1 class="text-xl mb-2 font-medium text-gray-600">Select Subscription</h1>
                <div wire:loading>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-loader-circle text-green-600 animate-spin">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                    </svg>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5">
                @forelse ($subscriptions as $item)
                    <div wire:click="$set('get_subscription', {{ $item->id }})"
                        class="border px-5 py-3 hover:scale-95 hover:cursor-pointer hover:border-gray-500 hover:border-[2.5px]  rounded-2xl {{ $get_subscription == $item->id ? 'bg-main/70 text-white' : 'bg-white text-main' }}">
                        <div class="div border-b">
                            <h1 class="text-lg font-semibold ">{{ $item->name }}</h1>
                        </div>
                        <div class="mt-3 h-20">
                            <p class="text-sm">{{ $item->description }}</p>
                        </div>
                        <div class="mt-3 flex text-sm justify-between items-center">
                            <span class="font-medium ">&#8369;{{ number_format($item->amount, 2) }}</span>
                            <span class="font-medium ">/{{ $item->month }} month(s)</span>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            @if ($get_subscription)
                <div class="mt-3 bg-white p-3 rounded-xl">
                    {{ $this->form }}
                </div>
            @endif
        </div>
        <div class="col-span-3">
            <div class="bg-white p-5 sticky top-64 rounded-xl shadow-xl">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-main text-lg">Subtotal</span>
                    <span
                        class="font-medium text-gray-600">&#8369;{{ number_format($selected_subscription->amount ?? 0, 2) }}</span>
                </div>
                <p class="text-sm text-gray-500">Subtotal does not include applicable taxes.</p>
                <div class="mt-10">
                    <div class="mt-10">
                        <x-button :disabled="!$get_subscription" label="Continue" class="w-full font-semibold" teal lg
                            right-icon="arrow-right" wire:click="applySubscription" spinner="applySubscription"
                            squared />
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
