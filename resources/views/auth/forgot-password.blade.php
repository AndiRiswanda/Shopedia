<x-guest-layout>
    <div class="relative min-h-screen flex flex-col justify-center items-center text-white ">
        <!-- Background Image -->
        <img 
            src="{!! asset('images/BackroundForBanner.jpg') !!}" 
            alt="Shopedia Background" 
            class="absolute inset-0 w-full h-full object-cover z-0 rounded-lg"
        >

        <!-- Logo Section -->
        <div class="relative z-10 mb-8 text-center">
            <div class="logo">
                <img 
                    src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" 
                    alt="Shopedia Logo" 
                    class="h-24 transition-transform duration-300 hover:scale-125"
                >
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white text-purple-900 shadow-lg rounded-lg p-8 w-full max-w-md z-10">
            <h2 class="text-2xl font-semibold mb-6 text-center">Forgot Password</h2>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-purple-300 focus:ring-purple-500 focus:border-purple-500" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
