<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-white flex items-center justify-center p-4">
        <div class="max-w-6xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side - Progress -->
            <div class="w-full md:w-1/3 bg-gradient-to-b from-purple-600 to-purple-500 p-8 text-white">
                <div class="h-full flex flex-col">
                    <div class="flex items-center mb-8">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h2 class="text-2xl font-bold">Become a Seller</h2>
                    </div>

                    <div class="space-y-8 relative">
                        <!-- Progress Line -->
                        <div class="absolute left-4 top-8 bottom-0 w-0.5 bg-purple-400">
                            <!-- Active Progress -->
                            <div id="progress-bar" class="w-full bg-white transition-all duration-500"
                                style="height: 30%"></div>
                        </div>

                        <!-- Step 1 -->
                        <div id="step1" class="relative flex items-center">
                            <div id="step1-circle"
                                class="w-8 h-8 rounded-full flex items-center justify-center z-10 bg-white text-purple-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold">Account Details</h3>
                                <p class="text-purple-200 text-sm">Create your seller account</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div id="step2" class="relative flex items-center">
                            <div id="step2-circle"
                                class="w-8 h-8 rounded-full flex items-center justify-center z-10 bg-purple-400 text-white">
                                <svg id="step2-svg" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold">Store Setup</h3>
                                <p class="text-purple-200 text-sm">Set up your store profile</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <p class="text-purple-200 text-sm">
                            Join our community of successful sellers and start your journey today
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full md:w-2/3 p-8">
                <form method="POST" action="{{ route('seller-register-store') }}" class="h-full flex flex-col">
                    @csrf

                    <!-- Step 1 - Account Details -->
                    <div id="form-step1" class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-1">Create Your Account</h3>
                            <p class="text-gray-600">Fill in your information to get started</p>
                        </div>

                        <div class="space-y-4">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required autofocus />
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }} "
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required />
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="password" name="password"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required />
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 - Store Details -->
                    <div id="form-step2" class="space-y-6 hidden">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-1">Set Up Your Store</h3>
                            <p class="text-gray-600">Tell us about your business</p>
                        </div>

                        <div class="space-y-4">
                            <!-- Store Name Input -->
                            <div>
                                <label for="store_name" class="block text-sm font-medium text-gray-700 mb-1">Store
                                    Name</label>
                                <input type="text" id="store_name" name="store_name" value="{{ old('store_name') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required />
                                @error('store_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Store Description Input -->
                            <div>
                                <label for="store_desc"
                                    class="block text-sm font-medium text-gray-700 mb-1">Store
                                    Description</label>
                                <textarea id="store_desc" name="store_desc" rows="4"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300"
                                    required>{{ old('store_desc') }}</textarea>
                                @error('store_desc')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-auto pt-8 flex justify-between">
                        <button type="button" id="back-btn"
                            class="flex items-center gap-2 px-6 py-3 text-purple-600 hover:text-purple-500 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                            </svg>
                            Back
                        </button>
                        <button type="button" id="next-btn"
                            class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-500 focus:ring focus:ring-purple-200">
                            Next
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('next-btn').addEventListener('click', function() {
            if (document.getElementById('next-btn').type === 'submit') {
                // Manually submit the form
                document.querySelector('form').submit();
            } else {
                // Switch to step 2
                document.getElementById('form-step1').classList.add('hidden');
                document.getElementById('form-step2').classList.remove('hidden');

                document.getElementById('progress-bar').style.height = '70%';
                document.getElementById('step2-circle').classList.remove('bg-purple-400');
                document.getElementById('step2-circle').classList.add('bg-white');
                document.getElementById('step2-svg').classList.add('stroke-purple-400');

                document.getElementById('next-btn').type = 'submit';
                document.getElementById('next-btn').textContent = 'Submit';
            }
        });

        document.getElementById('back-btn').addEventListener('click', function() {
            // Switch to step 1
            document.getElementById('form-step1').classList.remove('hidden');
            document.getElementById('form-step2').classList.add('hidden');

            document.getElementById('progress-bar').style.height = '30%';
            document.getElementById('step1-circle').classList.remove('bg-purple-400');
            document.getElementById('step2-circle').classList.remove('bg-white');
            document.getElementById('step2-circle').classList.add('bg-purple-400');
            document.getElementById('step2-svg').classList.remove('stroke-purple-400');

            document.getElementById('next-btn').type = 'button';
            document.getElementById('next-btn').textContent = 'Next';
        });
    </script>
</x-guest-layout>
