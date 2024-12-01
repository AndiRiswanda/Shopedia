<x-main.app>


    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Product Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <!-- Image Gallery Section -->
                <div class="md:w-1/2 p-6">
                    <div class="relative h-96 rounded-xl overflow-hidden mb-4 group">
                        <!-- Main product image -->
                        <img src="{{ asset($product->productImages->first()->image_url ?? '/default-image.jpg') }}"
                            alt="Main product" class="w-full h-full object-cover">
                        @if (Auth::user())
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <form action="{{ route('wishlist.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <button type="submit" 
                                        class="bg-white p-2 rounded-full shadow-lg hover:bg-purple-100 transition-colors">
                                        <i class="fas fa-heart text-purple-600"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ route('login') }}"
                                    class="bg-white p-2 rounded-full shadow-lg hover:bg-purple-100 transition-colors">
                                    <i class="fas fa-heart text-purple-600"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    <!-- if multiple images -->
                    @if ($product->productImages->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($product->productImages as $image)
                                <img src="{{ asset($image->image_url) }}" alt="Product image"
                                    class="rounded-lg cursor-pointer hover:ring-2 ring-purple-500 transition-all">
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Details Section -->
                <div class="md:w-1/2 p-8 bg-gradient-to-br from-purple-50 to-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->product_name }}</h1>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($product->averageRating >= $i)
                                            <i class="fas fa-star"></i>
                                        @elseif ($product->averageRating > $i - 1)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">({{ $product->reviews->count() }})</span>
                            </div>

                        </div>
                        <span class="text-3xl font-bold text-purple-600">Rp {{ $product->price }}</span>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ $product->description }}
                    </p>

                    <!-- Store Information -->
                    <div class="bg-purple-50 p-4 rounded-xl mb-6">
                        <h3 class="font-medium text-purple-600 mb-2">Store Information</h3>
                        <!-- Store Banner -->
                        <div class="mb-4">
                            <a href="{{ route('product.show.store', $product->store) }}">
                                <img src="{{ $product->store->banner_url ? asset('storage/' . $product->store->banner_url): asset('images/DEFAULT DONT DELETE THIS PLEASE.jpg') }}"
                                    alt="{{ $product->store->store_name ?? 'Store Banner' }}"
                                    class="w-full h-32 object-cover rounded-lg hover:opacity-90 transition-opacity">
                            </a>
                        </div>

                        <!-- Store Name and Link -->
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('product.show.store', $product->store) }}" class="w-12 h-12 rounded-full overflow-hidden hover:opacity-90 transition-opacity">
                                        @if ($product->store->profile_url)
                                            <img src="{{ asset('storage/' . $product->store->profile_url) }}"
                                                alt="{{ $product->store->store_name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-purple-200 flex items-center justify-center">
                                                <span class="text-purple-600 font-medium">
                                                    {{ strtoupper(substr($product->store->store_name, 0, 2)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </a>
                                    <h4 class="font-semibold text-lg text-purple-600">
                                        {{ $product->store->store_name ?? 'Store Name' }}
                                    </h4>
                                </div>
                                <a href="{{ route('product.show.store', $product->store) }}"
                                    class="bg-white text-purple-600 px-6 py-2 rounded-lg font-medium hover:bg-purple-100 transition-colors flex items-center space-x-2">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Visit Store</span>
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- Add to Cart Button -->
                    @if (Auth::user())
                        <form action="{{ route('cart.update', ['cart' => Auth::user()->carts]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <button type="submit"
                                class="w-full bg-purple-600 text-white py-4 rounded-xl font-medium hover:bg-purple-700 transform hover:scale-[1.02] transition-all duration-300 mb-4 flex items-center justify-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full bg-purple-600 text-white py-4 rounded-xl font-medium hover:bg-purple-700 transform hover:scale-[1.02] transition-all duration-300 mb-4 flex items-center justify-center space-x-2">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                    @endif

                    <!-- Delivery Info -->
                    <div class="space-y-4 border-t pt-6">
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <i class="fas fa-truck text-purple-600"></i>
                            <span>Free shipping</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Product Reviews</h3>
                
                @auth
                    @php
                        $hasDeliveredOrder = Auth::user()->orders()
                            ->whereHas('orderDetail', function($query) use ($product) {
                                $query->where('product_id', $product->product_id)
                                    ->where('status', 'Delivered');
                            })->exists();
                    @endphp
        
                    @if($hasDeliveredOrder)
                        <form action="{{ route('reviews.store') }}" method="POST" class="mb-6" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <div class="flex space-x-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}" class="hidden peer">
                                        <label for="rating-{{ $i }}" class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">
                                            ★
                                        </label>
                                    @endfor
                                </div>
                            </div>
        
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                <textarea name="comment" rows="4" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    placeholder="Share your thoughts about this product..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                                <input type="file" name="image" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
        
                            <button type="submit" 
                                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Submit Review
                            </button>
                        </form>
                    @else
                    @endif
                @else
                @endauth
            </div>

            <!-- Reviews Section -->
            <div class="border-t border-gray-200 px-8 py-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>

                <!-- Review Cards -->
                <div class="space-y-6">
                    @forelse ($reviews as $review)
                        <div class="bg-purple-50 rounded-xl p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center">
                                        @if ($review->users->profile_url)
                                            <img src="{{ asset($review->users->profile_url) }}"
                                                alt="{{ $review->users->name }}"
                                                class="w-full h-full object-cover rounded-full">
                                        @else
                                            <span class="text-purple-600 font-medium">
                                                {{ strtoupper(substr($review->users->name, 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $review->users->name }}</h4>
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($review->rating >= $i)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <!-- Review Content -->
                            <div class="space-y-4">
                                <p class="text-gray-600">
                                    {{ \Illuminate\Support\Str::limit($review->comment, 150) }}
                                </p>
                                
                                @if($review->review_pic)
                                    <div class="mt-4">
                                        <img src="{{ asset($review->review_pic) }}" 
                                            alt="Review image" 
                                            class="rounded-lg max-h-48 object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No reviews yet</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Thumbnail click handler
                $('.grid img').click(function() {
                    const src = $(this).attr('src');
                    $('.relative img').attr('src', src);
                    $('.grid img').removeClass('ring-2');
                    $(this).addClass('ring-2');
                });
            });
        </script>
</x-main.app>