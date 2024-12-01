<x-shopedia.app>
    <x-app.banner :store="Auth::user()->store" />
    <div class="min-h-screen flex flex-col items-center">
        <x-shopedia.alert />
        <main class="py-6">
            
            <div class="max-w-11xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-purple-100">
                    <div class="p-6 text-gray-900">
                        {{-- product detail --}}
                        <main class="container mx-auto px-6 py-10">

                            <div class="bg-white rounded-lg shadow-xl p-8 space-y-6">
                                {{-- product image --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                                    {{-- image --}}
                                    <div class="col-span-1">
                                        <img src="{{ asset($product->productImages->first()->image_url) }}"
                                            alt="Product Image"
                                            class="w-full rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                                    </div>

                                    {{-- product info --}}
                                    <div class="col-span-2 space-y-4">
                                        <h2 class="text-4xl font-bold text-gray-800">{{ $product->product_name }}</h2>
                                        <p class="text-gray-600 text-lg">{{ $product->description }}</p>
                                        <p class="text-2xl font-semibold text-purple-800">
                                            ${{ number_format($product->price, 2) }}</p>

                                        <div class="flex items-center space-x-6">
                                            <div>
                                                <span class="block text-sm text-gray-600">Category</span>
                                                <span
                                                    class="text-gray-800 font-medium">{{ $product->category->category_name }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-sm text-gray-600">Stock</span>
                                                <span
                                                    class="text-gray-800 font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $product->stock > 0 ? $product->stock . ' Available' : 'Out of Stock' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- product images (all) --}}
                                <div class="mt-8 border-t pt-8">
                                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Product Gallery</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach($product->productImages->skip(1) as $image)
                                            <div class="relative group">
                                                <img 
                                                    src="{{ asset($image->image_url) }}"
                                                    alt="Product Image {{ $loop->iteration }}"
                                                    class="w-full h-48 object-cover rounded-lg shadow-md 
                                                    transform transition-all duration-300 
                                                    hover:scale-105 cursor-pointer"
                                                    onclick="window.open('{{ asset($image->image_url) }}', '_blank')"
                                                >
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 
                                                    transition-all duration-300 rounded-lg"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- button --}}
                                
                                <div class="flex justify-end space-x-4">
                                    <a href="{{ route('product.edit', $product->product_id) }}"
                                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200 shadow-lg">
                                        Edit Product
                                    </a>
                                    <form action="{{ route('product.destroy', $product->product_id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 shadow-lg"
                                            onclick="return confirm('Are you sure you want to delete this product?');">
                                            Delete Product
                                        </button>
                                    </form>
                                    <a href="{{ route('store.index') }}"
                                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200 shadow-lg">
                                        Back To Dashboard
                                    </a>
                                </div>
                            </div>

                            <!-- Statistics Section -->
                            <div class="bg-white rounded-lg shadow-xl mt-10 p-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6">Product Performance</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Stat Cards -->
                                    <div class="p-6 bg-purple-50 rounded-lg shadow-md">
                                        <h4 class="text-lg font-medium text-purple-800">Total Sales</h4>
                                        <p class="text-3xl font-bold text-purple-900">{{$product->inventoryLogs()
                                            ->where('change_type', 'sold')
                                            ->sum('quantity_chance')}}</p>
                                    </div>
                                    <div class="p-6 bg-purple-50 rounded-lg shadow-md">
                                        <h4 class="text-lg font-medium text-purple-800">Revenue</h4>
                                        <p class="text-3xl font-bold text-purple-900">Rp {{ number_format($product->inventoryLogs()
                                            ->where('change_type', 'sold')
                                            ->sum('quantity_chance') * $product->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-8 py-6">
                                <!-- Reviews Section - Left Column -->
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
                                    <div class="mt-6">
                                        {{ $reviews->links() }}
                                    </div>
                                    <div class="h-[600px] overflow-y-auto pr-4">
                                        <!-- Review Cards -->
                                        <div class="space-y-6">
                                            @forelse ($reviews as $review)
                                                <div class="bg-purple-50 rounded-xl p-6">
                                                    <div class="flex items-start justify-between mb-4">
                                                        <div class="flex items-center space-x-4">
                                                            <div
                                                                class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center">
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
                                                                <h4 class="font-medium text-gray-900">
                                                                    {{ $review->users->name }}</h4>
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
                                                        <span
                                                            class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="space-y-4">
                                                        <p class="text-gray-600">{{ $review->comment }}</p>
                                                        @if ($review->review_pic)
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
                                    </div>
                                </div>


                                <!-- Product Logs Section - Right Column -->
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Product History</h2>
                                    <div class="h-[600px] overflow-y-auto pr-4">
                                        <div class="space-y-4">
                                            @forelse ($product->inventoryLogs()->latest()->get() as $log)
                                                <div class="bg-white rounded-lg shadow p-4 border border-gray-100">
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <span class="text-sm font-medium text-gray-600">
                                                                {{ $log->change_type }}
                                                            </span>
                                                            <p class="text-gray-800 font-semibold">
                                                                Quantity: {{ $log->quantity_chance }}
                                                            </p>
                                                        </div>
                                                        <span class="text-sm text-gray-500">
                                                            {{ $log->updated_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-gray-500 text-center py-8">No history available</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </main>


        <style>
            /* Custom Scrollbar Styles */
            .overflow-y-auto::-webkit-scrollbar {
                width: 6px;
            }

            .overflow-y-auto::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 3px;
            }

            .overflow-y-auto::-webkit-scrollbar-thumb {
                background: #cbd5e0;
                border-radius: 3px;
            }

            .overflow-y-auto::-webkit-scrollbar-thumb:hover {
                background: #a0aec0;
            }
            .group:hover img {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                    0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
        </style>
        </main>

    </div>

</x-shopedia.app>
