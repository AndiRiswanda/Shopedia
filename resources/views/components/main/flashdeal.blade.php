 @props(['products'])
 
 <!-- Flash Deals Section -->
 <section class="py-12 bg-gradient-to-b from-purple-50 to-white">
    <div class="container mx-auto px-4">
        <!-- Flash Sale Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-4">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">⚡ Flash Sale</h2>
                <div class="hidden md:flex items-center space-x-2 bg-red-100 px-4 py-2 rounded-full">
                    <i class="fas fa-clock text-red-500"></i>
                    <span class="text-red-600 font-semibold" id="countdown">Loading...</span>
                </div>
            </div>

        </div>

        @if ($products->isEmpty())
            <div class="bg-white rounded-2xl p-12 text-center">
                <img src="#" alt="No products" class="w-48 mx-auto mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Flash Sale Products Available</h3>
                <p class="text-gray-500">Check back soon for amazing deals and discounts!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products->random(6) as $product)
                    @php
                        $discounts = [10, 20, 30, 40, 50];
                        $randomDiscount = $discounts[array_rand($discounts)];
                        $discountedPrice = $product->price * (1 - $randomDiscount / 100);
                    @endphp
                    <div
                        class="bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="relative aspect-w-4 aspect-h-3 group">
                            <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                <img src="{{ $product->productImages->first()->image_url ?? 'https://karanzi.websites.co.in/obaju-turquoise/img/product-placeholder.png' }}"
                                    alt="{{ $product->product_name }}" class="w-full h-full object-cover">
                            </a>
                            <!-- Discount Badge -->
                            <div class="absolute top-4 left-4">
                                <div class="bg-red-500 text-white px-4 py-2 rounded-full font-bold text-sm">
                                    {{ $randomDiscount }}% OFF
                                </div>
                            </div>
                            <!-- Wishlist Button -->
                            @if (Auth::user())
                                <div
                                    class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <button type="submit" 
                                            class="bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-full shadow-lg hover:scale-105 transition-all duration-200">
                                            <i class="fas fa-heart text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div
                                    class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <a href="{{ route('login') }}"
                                        class="bg-gray-600 hover:bg-gray-700 text-white p-3 rounded-full shadow-lg hover:scale-105 transition-all duration-200 inline-block">
                                        <i class="fas fa-heart text-white"></i>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <!-- Product Details -->
                            <div class="mb-4">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2 line-clamp-2">
                                    {{ $product->product_name }}
                                </h3>
                                <div class="flex items-center space-x-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm text-gray-600">
                                            {{ number_format($product->reviews->avg('rating'), 1) }}
                                        </span>
                                    </div>
                                    <span class="text-gray-300">|</span>
                                    <span class="text-sm text-gray-500">
                                        {{ $product->reviews->count() }} reviews
                                    </span>
                                </div>
                            </div>

                            <!-- Price Section -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-purple-600">
                                        Rp {{ number_format($discountedPrice, 2) }}
                                    </span>
                                    <div class="text-sm text-gray-400 line-through">
                                        Rp {{ number_format($product->price, 2) }}
                                    </div>
                                </div>
                                <div class="bg-green-100 px-3 py-1 rounded-full">
                                    <span class="text-green-600 text-sm font-medium">
                                        {{ $product->orderDetails->where('status', 'Delivered')->sum('quantity') }} sold
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        // Set count down
        const countDownDate = new Date().getTime() + (24 * 60 * 60 * 1000);

        // Update every 1 second
        const x = setInterval(function() {
            // Get today
            const now = new Date().getTime();

            const distance = countDownDate - now;

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML =
                `Ends in ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</section>