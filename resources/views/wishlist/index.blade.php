<x-main.app>
    <div class="min-h-screen bg-gradient-to-br  from-purple-50 to-purple-100">

        <div class="relative overflow-hidden">
            <div class="bg-gradient-to-r from-purple-400 to-purple-900 rounded-2xl h-40 md:h-48 flex items-center justify-center text-white overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center opacity-30 rounded-2xl"
                    style="background-position: center 82%; background-image: url('{{ asset('images/BackroundForBanner2.jpg') }}');" >
                </div>
                <div>
                    <h1 class="relative text-3xl md:text-4xl font-bold">Wishlist</h1>
                    <h3 class="text-center">Dream big, add to your wishlist.</h3>
                </div>
            </div>
        </div>

        <!-- Wishlist Content -->
        <div class="container mx-auto px-6 py-8">
            @if($wishlists->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-xl p-8 text-center shadow-lg">
                    <div class="w-20 h-20 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-heart text-3xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Your wishlist is empty</h3>
                    <p class="text-gray-600 mb-6">Start adding products you love to your wishlist!</p>
                    <a href="{{ route('Home') }}" 
                       class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Explore Products
                    </a>
                </div>
            @else
                <!-- Wishlist Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($wishlists as $wishlist)
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                            <!-- Product Image -->
                            <div class="relative aspect-w-4 aspect-h-3">
                                <a href="{{ route('product.show', ['product' => $wishlist->product->product_id]) }}">
                                    <img src="{{ $wishlist->product->productImages->isEmpty() 
                                        ? 'https://via.placeholder.com/400x300'
                                        : asset($wishlist->product->productImages->first()->image_url) }}"
                                         alt="{{ $wishlist->product->product_name }}"
                                         class="w-full h-64 object-cover">
                                </a>
                                
                                <!-- Remove from Wishlist Button -->
                                <form action="{{ route('wishlist.destroy', $wishlist->wishlist_id) }}" 
                                      method="POST" 
                                      class="absolute top-4 right-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 bg-white rounded-full shadow-md hover:bg-red-50 transition-colors">
                                        <i class="fas fa-heart text-red-500"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Product Details -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                        {{ $wishlist->product->product_name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ Str::limit($wishlist->product->description, 100) }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-purple-600">
                                        RM {{ number_format($wishlist->product->price, 2) }}
                                    </span>
                                    
                                    <!-- Add to Cart Form -->
                                    @if(Auth::user())
                                        <form action="{{ route('cart.update', ['cart' => Auth::user()->carts]) }}" 
                                              method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="product_id" value="{{ $wishlist->product->product_id }}">
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-main.app>