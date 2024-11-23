<x-shopedia.app>
    <div class="min-h-screen flex flex-col items-center">
        <x-shopedia.product-head :product="$product->product_name" />
        <x-shopedia.alert />
        <!-- Product Details -->
        <main class="container mx-auto px-6 py-10">
            
            <div class="bg-white rounded-lg shadow-xl p-8 space-y-6">
                <!-- Product Image and Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <!-- Product Image -->
                    <div class="col-span-1">
                        <img src="{{ asset($product->productImages->first()->image_url) }}" alt="Product Image"
                            class="w-full rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                    </div>

                    <!-- Product Info -->
                    <div class="col-span-2 space-y-4">
                        <h2 class="text-4xl font-bold text-gray-800">{{ $product->product_name }}</h2>
                        <p class="text-gray-600 text-lg">{{ $product->description }}</p>
                        <p class="text-2xl font-semibold text-purple-800">${{ number_format($product->price, 2) }}</p>

                        <div class="flex items-center space-x-6">
                            <div>
                                <span class="block text-sm text-gray-600">Category</span>
                                <span class="text-gray-800 font-medium">{{ $product->category->category_name }}</span>
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

                <!-- Action Buttons -->
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
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="bg-white rounded-lg shadow-xl mt-10 p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Product Performance</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Stat Cards -->
                    <div class="p-6 bg-purple-50 rounded-lg shadow-md">
                        <h4 class="text-lg font-medium text-purple-800">Total Sales</h4>
                        <p class="text-3xl font-bold text-purple-900">120</p>
                    </div>
                    <div class="p-6 bg-purple-50 rounded-lg shadow-md">
                        <h4 class="text-lg font-medium text-purple-800">Revenue</h4>
                        <p class="text-3xl font-bold text-purple-900">$14,500</p>
                    </div>
                </div>
            </div>
        </main>

    </div>

</x-shopedia.app>
