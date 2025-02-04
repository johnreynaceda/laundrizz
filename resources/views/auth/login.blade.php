<x-guest-layout>
    <!-- Session Status -->


    <livewire:auth.login-user />


    <div class="mt-5">
        <p class="text-center text-sm text-gray-600">
            {{ __('Don\'t have an account? ') }}
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </p>
    </div>
</x-guest-layout>
