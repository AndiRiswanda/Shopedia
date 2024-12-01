<x-main.app>
    <style>
        .store-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        }

        .product-card-hover {
            transition: all 0.3s ease;
        }

        .product-card-hover:hover {
            transform: translateY(-5px);
        }
        .store-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            border-radius: inherit;
        }
    
        .store-gradient {
            position: relative;
        }
    
        .store-gradient > * {
            position: relative;
            z-index: 1;
        }
    </style>
    <!-- Store Banner -->
    
    <!-- Store Banner -->
    <div class="store-gradient pt-20 rounded-2xl" 
        style="background-image: url('{{ $store->banner_url ? Storage::url($store->banner_url) : asset('images/DEFAULT DONT DELETE THIS PLEASE.jpg') }}'); 
        background-size: cover; 
        background-position: center;"><div class="container mx-auto px-4 py-12">
            <div class="flex items-center space-x-8">
                <a href="{{ route('product.show.store', $store) }}"
                    class="w-20 h-20 rounded-full overflow-hidden hover:opacity-90 transition-opacity border-4 border-white">
                    <img src="{{ asset('storage/' . $store->profile_url) }}" alt="{{ $store->store_name }}"
                        class="w-full h-full object-cover">
                </a>

                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-2">{{ $store->store_name }}</h1>
                    <p class="text-purple-100 text-lg">{{ $store->catch }}</p>
                    <div class="flex items-center space-x-4 mt-4">
                        @php
                            $storeProducts = $store->products;
                            $allReviews = collect();
                            foreach ($storeProducts as $product) {
                                $allReviews = $allReviews->concat($product->reviews);
                            }
                            $averageRating = $allReviews->avg('rating');
                            $totalReviews = $allReviews->count();

                            $formattedRating = number_format($averageRating, 1);
                        @endphp

                        <span class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            {{ $formattedRating }} ({{ $totalReviews }} {{ Str::plural('review', $totalReviews) }})
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-box text-purple-200 mr-1"></i>
                            {{ $store->products->count() }} Products
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($store->products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden product-card-hover">
                    <div class="relative h-48">
                        <a href="{{ route('product.show', $product->product_id) }}">
                            <img src="{{ $product->productImages->isEmpty()
                                ? 'https://karanzi.websites.co.in/obaju-turquoise/img/product-placeholder.png'
                                : asset($product->productImages->first()->image_url) }}"
                                class="w-full h-full object-cover" alt="{{ $product->name }}">
                        </a>
                        <div class="absolute top-4 right-4">
                            <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            @if (Auth::user() && Auth::user()->wishlists && Auth::user()->wishlists->count() > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ Auth::user()->wishlists->count() }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 60) }}</p>
                        <button
                            class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-purple-50 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-purple-800 mb-6">Contact {{ $store->store_name }}</h2>
                <div class="flex justify-center space-x-6">
                    <a href="mailto:{{ $store->user->email }}"
                        class="flex items-center text-purple-600 hover:text-purple-800">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>Email Us</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main.app>
