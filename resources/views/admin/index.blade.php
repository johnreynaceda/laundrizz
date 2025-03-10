@section('title', 'Dashboard')
<x-superadmin-layout>
    <div>
        <h1 class="text-2xl">Good Day, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">Here's what's new today</p>
    </div>
    <livewire:admin.admin-dashboard />
</x-superadmin-layout>