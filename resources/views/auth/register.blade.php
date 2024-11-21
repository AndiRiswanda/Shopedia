<x-guest-layout>
    <div class="min-h-screen max-w-5xl bg-gradient-to-br from-purple-50 to-white flex items-center justify-center p-4">
        <div class="max-w-5xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex">
            <!-- Left Side Banner -->
            <div class="relative w-2/5 hidden lg:block ">
                <!-- Background image -->
                <img src="{!! asset('images/BackroundForBanner.jpg') !!}" alt="Shopedia Background"
                    class="absolute inset-0 w-full h-full object-cover">
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-b from-purple-600/80 to-purple-500/80"></div>

                <!-- Content -->
                <div class="relative h-full flex flex-col items-center justify-center p-12 text-white">
                    <!-- Logo container -->
                    <div class="bg-white/90 p-4 rounded-xl shadow-lg mb-8 backdrop-blur-sm">
                        <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo" class="h-16">
                    </div>

                    <!-- Welcome text -->
                    <div class="text-center">
                        <h2 class="text-3xl font-bold mb-4">Welcome to Shopedia</h2>
                        <p class="text-lg text-white/90">Your one-stop destination for all your shopping needs</p>
                    </div>

                    <!-- Decorative elements -->
                    <div
                        class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-purple-900/50 to-transparent">
                    </div>
                </div>
            </div>

            <!-- Right Side Form -->
            <div class="w-full lg:w-3/5 py-8">
                <div class="px-8 mb-8">
                    <h2 class="text-2xl font-bold text-purple-700">Create Account</h2>
                    <p class="text-gray-600 mt-2">Join our community and start shopping today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="px-8 space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <x-input-label for="name" :value="__('Name')" class="text-purple-700 font-semibold" />
                        <div class="relative group">
                            <x-text-input id="name"
                                class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300 group-hover:border-purple-300"
                                type="text" name="name" :value="old('name')" required autofocus
                                autocomplete="name" />
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-purple-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-500" />
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-purple-700 font-semibold" />
                        <div class="relative group">
                            <x-text-input id="email"
                                class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300 group-hover:border-purple-300"
                                type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-purple-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-purple-700 font-semibold" />
                        <div class="relative group">
                            <x-text-input id="password"
                                class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300 group-hover:border-purple-300"
                                type="password" name="password" required autocomplete="new-password" />
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-purple-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="text-purple-700 font-semibold" />
                        <div class="relative group">
                            <x-text-input id="password_confirmation"
                                class="block w-full px-4 py-3 rounded-xl border border-purple-100 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-all duration-300 group-hover:border-purple-300"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-purple-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-500" />
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <div class="flex-col">
                            <a class="text-sm text-purple-600 hover:text-purple-500 transition-colors duration-300 hover:underline flex items-center gap-1 pb-3"
                                href="{{ route('login') }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                                {{ __('Already registered?') }}
                            </a>

                            <!-- New Link to Sell Stuff -->
                            <a class="text-sm text-purple-600 hover:text-purple-500 transition-colors duration-300 hover: flex items-center gap-1"
                                href="{{route('seller-register')}}">
                                    <i class="fas fa-shopping-cart text-2xl"></i>
                                {{ __("Don't let your stuff collect dust—sell it here!") }}
                            </a>
                        </div>


                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-500 text-white rounded-xl hover:from-purple-500 hover:to-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                            {{ __('Register') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
