@section('title', 'Dashboard')

<x-superadmin-layout>
    <div>
        <h1 class="text-2xl">Good Day, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">Here's what's new today</p>
    </div>
    <div class="mt-10 grid grid-cols-4 gap-5">
        @forelse (\App\Models\Shop::get() as $item)
            <div class=" rounded-xl bg-white p-5 shadow">
                <p class="font-semibold text-main text-lg">{{$item->name}}</p>
                <div class="mt-2">
                    <h1 class="text-5xl font-bold text-gray-600">
                        {{\App\Models\ServiceTransaction::where('shop_id', $item->id)->count()}}
                    </h1>
                    <h1 class="text-gray-500 text-sm">No. of Transactions</h1>
                </div>
            </div>
        @empty

        @endforelse

    </div>

</x-superadmin-layout>