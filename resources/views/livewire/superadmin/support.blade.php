<div>
    <div class="bg-white p-5 rounded-xl">
        <div class="w-1/2">
            {{ $this->form }}
        </div>
        <div class="mt-5">
            <x-button label="Save Record" slate right-icon="arrow-right" squared wire:click="save" spinner="save" />
        </div>
    </div>
</div>
