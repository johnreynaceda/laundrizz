@section('title', 'Cart')
<x-other-layout>
    <div>
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}" class="flex space-x-2 items-end">
                {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                <x-shared.logo class="block h-9 w-auto fill-current text-gray-800" />
                <span class="font-bold italic text-main">LAUNDRIZZ</span>
            </a>
        </div>

    </div>
</x-other-layout>
