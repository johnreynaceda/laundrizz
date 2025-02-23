@section('title', 'Account Setup')
<x-superadmin-layout>
    <div>
        <h1 class="text-2xl">Good Day, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">Please set up your account first. </p>
    </div>
    <livewire:cart />
</x-superadmin-layout>
