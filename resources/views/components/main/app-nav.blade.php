<!-- Main Navigation -->
<nav class="bg-white shadow-sm">
    <!-- Main Navigation Container -->
    <div class="max-w-[1920px] mx-auto px-8 lg:px-16">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('Home') }}">
                    <div class="logo">
                        <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo"
                            class="h-12 transition-transform duration-300 hover:scale-115">
                    </div>
                </a>


                <!-- Search Bar -->
                <div class="flex-1 mx-12">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="query" placeholder="Search for products, brands and more..."
                                value="{{ request('query') }}"
                                class="w-full px-6 py-3 border border-purple-200 rounded-full 
                          focus:outline-none focus:border-purple-400 focus:ring-2 
                          focus:ring-purple-100 transition-all duration-200">
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 
                           h-8 px-6 bg-purple-600 text-white rounded-full 
                           hover:bg-purple-700 transition-colors duration-200">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Navigation Items -->
                <div class="flex items-center space-x-8">
                    <button id="cart-button"
                        class="flex items-center text-gray-600 hover:text-purple-600 transition-colors duration-200">
                        @if (Auth::user())
                            @if (Auth::user()->carts->cartDetails->count('product_id') > 0)
                                <i class="fas fa-shopping-cart text-2xl"></i>
                                <span class="ml-2">Cart
                                    ({{ Auth::user()->carts->cartDetails->count('product_id') }})</span>
                            @else
                                <i class="fas fa-shopping-cart text-2xl"></i>
                                <span class="ml-2">Cart</span>
                            @endif
                        @else
                        @endif

                    </button>


                    <a href="{{ route('wishlist.index') }}"
                        class="relative inline-flex items-center p-2 rounded-full transition-transform duration-300 hover:scale-110">
                        <div class="hover:bg-purple-100 p-2 rounded-full transition-colors duration-300">
                            <i class="fas fa-heart text-purple-600 text-xl"></i>
                        </div>
                        @if (Auth::user() && Auth::user()->wishlists && Auth::user()->wishlists->where('user_id', Auth::id())->count() > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ Auth::user()->wishlists->where('user_id', Auth::id())->count() }}
                            </span>
                        @endif
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <!-- Show Dashboard Button if Authenticated -->
                            <a href="{{ route('dashboard') }}" class="flex items-center">

                                <div id="tooltip-jese" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    {{ Auth::user()->name }}
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <img data-tooltip-target="tooltip-jese"
                                    class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                    src="{{ asset(Auth::user()->profile_url) ?? 'https://via.placeholder.com/40' }}"
                                    alt="Bordered avatar">


                            </a>
                        @else
                            <!-- Show Login and Register Buttons if NOT Authenticated -->
                            <a href="{{ route('login') }}"
                                class="px-6 py-2.5 bg-white text-purple-600 border border-purple-300 rounded-full hover:border-purple-700 transition-all duration-200">
                                Login
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-6 py-2.5 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-all duration-200">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Bar -->
    <div class="bg-white border-b border-purple-50">
        <div class="max-w-[1920px] mx-auto px-8 lg:px-16">
            <div class="container mx-auto px-4 py-3">
                <div class="flex space-x-12 justify-center">
                    @foreach ($categories as $category)
                        <a href="{{ route('category.show', $category) }}"
                            class="text-purple-600 hover:text-purple-600 transition-colors duration-200 font-medium flex items-center space-x-2">
                            <i
                                class="fas fa-{{ str_contains(strtolower($category->category_name), 'electronics')
                                    ? 'laptop'
                                    : (str_contains(strtolower($category->category_name), 'fashion')
                                        ? 'tshirt'
                                        : (str_contains(strtolower($category->category_name), 'beauty')
                                            ? 'spa'
                                            : (str_contains(strtolower($category->category_name), 'sports')
                                                ? 'running'
                                                : (str_contains(strtolower($category->category_name), 'figure')
                                                    ? 'gamepad'
                                                    : (str_contains(strtolower($category->category_name), 'health')
                                                        ? 'heartbeat'
                                                        : (str_contains(strtolower($category->category_name), 'automotive')
                                                            ? 'car'
                                                            : (str_contains(strtolower($category->category_name), 'pets')
                                                                ? 'paw'
                                                                : (str_contains(strtolower($category->category_name), 'home')
                                                                    ? 'home'
                                                                    : (str_contains(strtolower($category->category_name), 'books')
                                                                        ? 'book'
                                                                        : 'tags'))))))))) }} fa-fw"></i>
                            <span>{{ $category->category_name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>
