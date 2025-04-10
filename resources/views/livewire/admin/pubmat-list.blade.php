<div>
    <div class="bg-white rounded-xl p-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pubmat List</h1>
            <p class="text-gray-600">Manage your pubmat here.</p>

            <div class="my-5 w-1/2">
                {{ $this->form }}
                @if ($file_path)
                    <x-button class="mt-3 font-semibold" positive sm wire:click="savePubmat" spinner="savePubmat"
                        label="Upload" />
                @endif
            </div>
        </div>
        <div>
            {{ $this->table }}
        </div>
    </div>
</div>
