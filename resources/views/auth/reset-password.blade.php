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
            <h2 class="text-2xl font-semibold mb-6 text-center">Reset Your Password</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-purple-300 focus:ring-purple-500 focus:border-purple-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-purple-300 focus:ring-purple-500 focus:border-purple-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-purple-300 focus:ring-purple-500 focus:border-purple-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-purple-200">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
