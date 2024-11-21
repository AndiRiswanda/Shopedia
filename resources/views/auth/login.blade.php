<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-white flex items-center justify-center p-4">
        <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex">
            <!-- Left Side Banner -->
            <div class="relative w-2/5 hidden lg:block">
                <!-- Background Image -->
                <img 
                    src="{!! asset('images/BackroundForBanner.jpg') !!}" 
                    alt="Shopedia Background" 
                    class="absolute inset-0 w-full h-full object-cover">
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-b from-purple-600/80 to-purple-500/80"></div>
                <!-- Content -->
                <div class="relative h-full flex flex-col items-center justify-center p-12 text-white">
                    <!-- Logo -->
                    <div class="bg-white/90 p-4 rounded-xl shadow-lg mb-8 backdrop-blur-sm">
                        <img 
                            src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" 
                            alt="Shopedia Logo" 
                            class="h-16">
                    </div>
                    <!-- Welcome Text -->
                    <div class="text-center">
                        <h2 class="text-3xl font-bold mb-4">Welcome Back to Shopedia</h2>
                        <p class="text-lg text-white/90">Log in to continue your shopping journey!</p>
                    </div>
                </div>
            </div>

            <!-- Right Side Form -->
            <div class="w-full lg:w-3/5 py-8">
                <div class="px-8 mb-8">
                    <h2 class="text-2xl font-bold text-purple-700">Log In</h2>
                    <p class="text-gray-600 mt-2">Access your account to manage orders and more</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="px-8 space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-purple-700 font-semibold" />
                        <x-text-input id="email" class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300"
                                      type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-purple-700 font-semibold" />
                        <x-text-input id="password" class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300"
                                      type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Forgot Password and Submit -->
                    <div class="flex items-center justify-between pt-6">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-purple-600 hover:text-purple-500 transition-colors duration-300 hover:underline"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-500 text-white rounded-xl hover:from-purple-500 hover:to-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                            {{ __('Log in') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                    <h1 class="text-sm">Don't have an account? </h1><a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-500 text-sm">
                        Register here.
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
