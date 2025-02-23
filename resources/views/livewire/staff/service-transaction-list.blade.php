<div>
    <div class="bg-white p-5 rounded-xl">
        <div class="mb-2">
            <h1 class="text-2xl font-bold uppercase text-gray-600">{{ $service_name }}</h1>
            <h1 class="text-sm text-gray-500 leading-3">Pending Orders</h1>
        </div>
        <div>
            {{ $this->table }}
        </div>
    </div>
</div>
