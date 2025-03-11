<!-- Alpine.js (Include this if it's not already in your project) -->

<div x-data="{ open: false }" class="w-full h-full flex justify-center items-center">
    <!-- Button to trigger modal -->
    <button @click="open = true"
        class="w-12 h-12 border-2 rounded-xl grid place-content-center transition-all duration-200 hover:border-gray-700 hover:scale-90 hover:text-green-600 dark:hover:border-gray-500 dark:hover:text-green-400"
        aria-label="QR Code">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-qr-code">
            <rect width="5" height="5" x="3" y="3" rx="1" />
            <rect width="5" height="5" x="16" y="3" rx="1" />
            <rect width="5" height="5" x="3" y="16" rx="1" />
            <path d="M21 16h-3a2 2 0 0 0-2 2v3" />
            <path d="M21 21v.01" />
            <path d="M12 7v3a2 2 0 0 1-2 2H7" />
            <path d="M3 12h.01" />
            <path d="M12 3h.01" />
            <path d="M12 16v.01" />
            <path d="M16 12h1" />
            <path d="M21 12v.01" />
            <path d="M12 21v-1" />
        </svg>
    </button>

    <!-- Modal -->
    <div>
        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-5 rounded-xl shadow-lg max-w-md relative">
                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                    ×
                </button>

                @php
                    $image = \App\Models\PaymentMethod::where('user_id', 1)->first();
                @endphp
                @if ($image)
                    <img src="{{ Storage::url($image->payment_photo) }}" alt="QR Code" class="rounded-lg w-full">
                @else
                    <p class="text-gray-700 text-sm md:text-base italic">
                        Please contact the administration to update their payment method.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
