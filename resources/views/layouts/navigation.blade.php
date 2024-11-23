<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-50 to-purple-100 shadow-lg border-b-2 border-purple-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">

                <!-- Logo with Hover Effect -->
                <div class="shrink-0 transform hover:scale-110 transition duration-300">
                    <a href="{{route('Home')}}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo" class="m-3 h-12">
                    </a>
                </div>

                <!-- Navigation Links with Hover Effects -->
                <div class="hidden space-x-6 sm:flex ml-10">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 text-purple-700 font-semibold hover:bg-purple-200 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>
            

            <!-- Settings Dropdown with Elegant Design -->
            <div class="hidden sm:flex sm:items-center">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button 
                        @click="dropdownOpen = !dropdownOpen"
                        class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded-full shadow-md hover:bg-purple-600 transition duration-300 ease-in-out"
                    >
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div 
                        x-show="dropdownOpen" 
                        @click.away="dropdownOpen = false"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl z-20 overflow-hidden"
                    >
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-purple-700 hover:bg-purple-50 transition duration-200">
                            {{ __('Edit Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition duration-200">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button 
                    @click="open = !open" 
                    class="inline-flex items-center justify-center p-2 rounded-full bg-purple-100 text-purple-600 hover:bg-purple-200 focus:outline-none transition duration-300"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-purple-700 hover:bg-purple-50">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive User Info -->
        <div class="pt-4 pb-1 border-t border-purple-200">
            <div class="px-4">
                <div class="font-medium text-lg text-purple-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-purple-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-purple-700 hover:bg-purple-50">
                    {{ __('Profile') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>