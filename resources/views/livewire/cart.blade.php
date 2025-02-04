<div>
    <div class="grid mt-5 grid-cols-9 gap-10">
        <div class="col-span-6 ">
            <h1 class="text-xl mb-2 font-medium text-gray-600">Select Subscription</h1>
            <div class="grid grid-cols-3 gap-5">
                @forelse ($subscriptions as $item)
                    <div
                        class="border px-5 py-3 hover:scale-95 hover:cursor-pointer hover:border-gray-500 hover:border-[2.5px] bg-white rounded-2xl">
                        <div class="div border-b">
                            <h1 class="text-lg font-semibold text-main">{{ $item->name }}</h1>
                        </div>
                        <div class="mt-3 h-20">
                            <p class="text-sm">{{ $item->description }}</p>
                        </div>
                        <div class="mt-3 flex text-sm justify-between items-center">
                            <span class="font-medium text-gray-800">&#8369;{{ number_format($item->amount, 2) }}</span>
                            <span class="font-medium text-gray-500">/{{ $item->month }} month(s)</span>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="mt-3 bg-white p-2 px-3 rounded-xl">
                {{ $this->form }}
            </div>
        </div>
        <div class="col-span-3">
            <div class="bg-white p-5 rounded-xl shadow-xl">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-main text-lg">Subtotal</span>
                    <span class="font-medium text-gray-600">&#8369;10,000.00</span>
                </div>
                <p class="text-sm text-gray-500">Subtotal does not include applicable taxes.</p>
                <div class="mt-10">
                    <button class="bg-main w-full py-3 text-white rounded-xl font-semibold">
                        <span>Continue</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
