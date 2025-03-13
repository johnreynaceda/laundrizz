@section('title', 'Support')
<x-superadmin-layout>
    <div class=" flex flex-col space-y-4 items-center justify-center bg-white p-5 rounded-xl">

        <div>
            <h1>Reach out to us for concerns and issues.</h1>
        </div>
        @php
            $support = \App\Models\Support::first();
        @endphp
        <div class="flex space-x-4 items-center">
            <div class="h-10 w-10 bg-main grid place-content-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-phone text-white">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
            </div>
            <h1 class="text-xl">{{ $support?->contact ?? 'Not available' }}</h1>
        </div>

        <div class="flex space-x-4 items-center">
            <div class="h-10 w-10 bg-main grid place-content-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-globe text-white">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                    <path d="M2 12h20" />
                </svg>
            </div>
            <h1 class="text-xl">{{ $support?->website ?? 'Not available' }}</h1>
        </div>
        <div class="flex space-x-4 items-center">
            <div class="h-10 w-10 bg-main grid place-content-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-mail text-white">
                    <rect width="20" height="16" x="2" y="4" rx="2" />
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                </svg>
            </div>
            <h1 class="text-xl">{{ $support?->email ?? 'Not available' }}</h1>
        </div>
    </div>
</x-superadmin-layout>
