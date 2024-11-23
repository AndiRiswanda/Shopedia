<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopedia - Your Ultimate Shopping Destination</title>
    <link rel="icon" href="{!! asset('images/Shopedia Logo/1x/Layer 1.png') !!}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafafa;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #a78bfa, #c4b5fd);
        }

        .category-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .flash-deal-timer {
            background: rgba(79, 70, 229, 0.1);
        }

        .elegant-shadow {
            box-shadow: 0 4px 20px rgba(167, 139, 250, 0.1);
        }

        .custom-purple {
            background-color: #8b5cf6;
        }

        .custom-purple-light {
            background-color: #ddd6fe;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Main Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="logo">
                    <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo"
                        class="h-12 transition-transform duration-300 hover:scale-115">
                </div>

                <!-- Search Bar -->
                <div class="flex-1 mx-12">
                    <div class="relative">
                        <input type="text" placeholder="Search for products, brands and more..."
                            class="w-full px-6 py-3 border border-purple-200 rounded-full focus:outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all duration-200">
                        <button
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 h-8 px-6 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
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
                    @if (Route::has('login'))
                        @auth
                            <!-- Show Dashboard Button if Authenticated -->
                            <a href="{{ route('dashboard') }}" class="flex items-center">
                                <img src="{{ asset(Auth::user()->profile_url) ?? 'https://via.placeholder.com/40' }}"
                                    alt="Profile Picture"
                                    class="h-10 w-10 rounded-full border border-purple-300 hover:border-purple-600 transition-all duration-200">
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
    </nav>

    <x-shopedia.alert />

    <!-- Categories Bar -->
    <div class="bg-white border-b border-purple-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex space-x-12 justify-center">
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Electronics</a>
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Fashion</a>
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Home &
                    Living</a>
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Beauty</a>
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Sports</a>
                <a href="#"
                    class="text-gray-600 hover:text-purple-600 transition-colors duration-200 font-medium">Automotive</a>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <div class="py-8 bg-gradient-to-b from-purple-50 to-white">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl elegant-shadow overflow-hidden">
                <div class="relative h-96">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600/30 to-transparent"></div>
                    <div class="relative z-10 h-full flex flex-col justify-center p-12">
                        <h1 class="text-5xl font-light text-gray-800 mb-4">Discover Elegance</h1>
                        <p class="text-xl text-gray-600 mb-6 font-light">Exclusive collections for the discerning
                            shopper</p>
                        <button
                            class="bg-purple-600 text-white px-8 py-3 rounded-full hover:bg-purple-700 transition-all duration-200 w-fit">
                            Explore Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Deals Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-10">
                <h2 class="text-2xl font-light text-gray-800">Flash <span class="font-semibold">Deals</span></h2>
                <div class="flex items-center space-x-2 text-purple-600">
                    <span class="flash-deal-timer px-6 py-2 rounded-full text-purple-700 font-medium">
                        @if ($products->isEmpty())
                            Opps
                        @else
                            Ends in: 05:23:45
                        @endif
                    </span>
                </div>
            </div>

            @if ($products->isEmpty())
                <div class="text-center text-xl text-gray-600 font-medium">
                    <p>Oops! Looks like there are no products available in this deal. Check back later!</p>
                    <p class="mt-4 text-lg text-gray-500">Stay tuned for more exciting offers!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-xl elegant-shadow overflow-hidden hover:shadow-lg transition-all duration-300">
                            <div class="relative">
                                <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                    <img src="{{ $product->productImages->isEmpty() ? 'https://karanzi.websites.co.in/obaju-turquoise/img/product-placeholder.png' : asset($product->productImages->first()->image_url) }}"
                                        alt="{{ $product->product_name }}" class="w-full">
                                </a>
                                <div
                                    class="absolute top-3 left-3 bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                                    40% OFF
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-medium text-lg mb-2 text-gray-800">{{ $product->product_name }}</h3>
                                <div class="flex items-center mb-3">
                                    <span class="text-purple-600 font-semibold text-xl">RM
                                        {{ number_format($product->price, 2) }}</span>
                                    <span class="ml-2 text-gray-400 line-through text-sm">RM
                                        {{ number_format($product->price * 1.4, 2) }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-star text-purple-400"></i>
                                    <span class="ml-1">{{ number_format($product->reviews->avg('rating'), 1) }}</span>
                                    <span class="mx-1">•</span>
                                    <span>put</span>
                                </div>

                                @if (Auth::user())
                                    <form action="{{ route('cart.update', ['cart' => Auth::user()->carts]) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <button type="submit"
                                            class="w-50 bg-white text-white my-6 px-3 py-2 rounded-lg inline-block text-center">
                                            <i
                                                class="fas fa-shopping-cart text-2xl text-purple-600 hover:text-purple-900 transition-all duration-200"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Showcase -->
    <section class="py-16 bg-purple-50/50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-light text-gray-800 mb-10">Shop by <span class="font-semibold">Category</span>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach (['Electronics', 'Fashion', 'Home', 'Beauty', 'Sports', 'Books'] as $category)
                    <div
                        class="category-card bg-white rounded-xl p-6 text-center elegant-shadow cursor-pointer transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-purple-50 rounded-full flex items-center justify-center transition-colors duration-300 hover:bg-purple-100">
                            <i class="fas fa-shopping-bag text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-700">{{ $category }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-white text-gray-600 pt-16 pb-12 border-t border-purple-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">About Shopedia</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="hover:text-purple-600 transition-colors duration-200">About
                                Us</a>
                        </li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors duration-200">Creator</a>
                        </li>
                        <li><a href="#" class="hover:text-purple-600 transition-colors duration-200">Github</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="text-purple-400 hover:text-purple-600 transition-colors duration-200">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#"
                            class="text-purple-400 hover:text-purple-600 transition-colors duration-200">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#"
                            class="text-purple-400 hover:text-purple-600 transition-colors duration-200">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-purple-100 pt-8">
                <p class="text-center text-gray-500">&copy; {{ date('Y') }} Shopedia. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        document.getElementById('cart-button').addEventListener('click', function() {
            window.location.href = '{{ route('cart.index') }}';
        });
    </script>
</body>

</html>
