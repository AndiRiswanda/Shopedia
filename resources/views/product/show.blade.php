<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Product Page</title>
</head>

<body class="bg-purple-50">
    <!-- Store Header -->
    <div class="bg-purple-600 text-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="shrink-0 transform hover:scale-110 transition duration-300">
                    <button onclick="window.history.back()"
                        class="w-40 bg-purple-500 text-white py-4 rounded-xl font-medium hover:bg-purple-700 transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>back</span>
                    </button>
                </div>

                <div class="flex items-center space-x-4">

                    <i class="fas fa-store text-2xl"></i>
                    <div>
                        <h2 class="text-xl font-bold">{{ $product->store->store_name }}</h2>
                        <p class="text-purple-200 text-sm">{{ $product->store->catch }}</p>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <x-shopedia.alert />

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
                        <span class="text-3xl font-bold text-purple-600">{{ $product->price }}</span>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ $product->description }}
                    </p>

                    <!-- Store Information -->
                    <div class="bg-purple-50 p-4 rounded-xl mb-6">
                        <h3 class="font-medium text-purple-600 mb-2">Store Information</h3>

                        <!-- Store Banner -->
                        <div class="mb-4">
                            <a href="{{ route('store.show', $product->store) }}">
                                <img src="{{ asset('storage/' . $product->store->banner_url) }}"
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

            <!-- Reviews Section -->
            <div class="border-t border-gray-200 px-8 py-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>

                <!-- Review Cards -->
                <div class="space-y-6">
                    @foreach ($reviews->take(5) as $review)
                        <!-- Limit to 5 reviews -->
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
                                                {{ strtoupper(substr(explode(' ', $review->users->name)[1] ?? '', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <!-- Display Reviewer's Name -->
                                        <h4 class="font-medium text-gray-900">{{ $review->users->name }}</h4>

                                        <!-- Star Rating -->
                                        <div class="flex text-yellow-400 text-sm">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($review->rating >= $i)
                                                    <i class="fas fa-star"></i> <!-- Full star -->
                                                @else
                                                    <i class="far fa-star"></i> <!-- Empty star -->
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <!-- Time since review -->
                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600">
                                {{ \Illuminate\Support\Str::limit($review->comment, 150) }} <!-- Limit review text -->
                            </p>
                        </div>
                    @endforeach
                </div>

                @if ($product->reviews->count() > 5)
                <a href="{{ $reviews->nextPageUrl() }}" 
                   class="mt-6 w-full py-3 border border-purple-600 text-purple-600 rounded-xl font-medium hover:bg-purple-50 transition-colors text-center block">
                    Load More Reviews
                </a>
            @endif


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
</body>

</html>
