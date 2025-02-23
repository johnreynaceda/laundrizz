<x-customer-layout>
    <div>
        <x-button label="Back" squared class="font-semibold" sm slate href="{{ route('customer.index') }}"
            icon="arrow-left" />
        <div class="mt-10">
            <livewire:customer.my-location />
        </div>
    </div>
</x-customer-layout>
