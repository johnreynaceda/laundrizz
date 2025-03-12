<div>
    <div class="grid grid-cols-9 gap-10">
        <div class="col-span-6">
            <div class="bg-white p-5 rounded-xl">
                {{ $this->table }}
            </div>
        </div>
        <div class="col-span-3">
            <div class="bg-white p-5 rounded-xl">
                <h1 class="font-bold text-gray-600">Upload Payment Method</h1>
                @if (auth()->user()->paymentMethod == null)
                    <div class="mt-5">
                        {{ $this->form }}
                    </div>
                    <div class="mt-5">
                        <x-button wire:click="uploadPhoto" label="Upload" class="w-full font-medium" right-icon="photo"
                            slate />
                    </div>
                @else
                    <div>
                        @if ($upload_new == true)
                            <div class="mt-5">
                                {{ $this->form }}
                            </div>
                            <div class="mt-5">
                                <x-button wire:click="uploadNew" label="Upload" class="w-full font-medium"
                                    right-icon="photo" slate />
                            </div>
                        @else
                            <div class="border-2 p-1 rounded-lg">
                                <img src="{{ Storage::url(auth()->user()->paymentMethod->payment_photo) }}"
                                    class="object-cover w-full h-96" alt="">
                            </div>
                            <div class="mt-3">
                                <x-button label="Change Payment" wire:click="$set('upload_new', true)"
                                    class="w-full font-medium" right-icon="photo" positive />
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
