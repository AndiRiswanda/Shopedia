<x-shopedia.app>
    @section('title', Auth::user()->name.' dashboard')

    <div class="min-h-screen flex flex-col items-center">
        <!-- Header -->
        <x-shopedia.product-head :product="$product->product_name" />


        <!-- Edit Product Form -->
        <main class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-xl p-6 space-y-4">
                <!-- Title -->
                <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Edit Product Details</h2>
               <x-shopedia.alert />

                <form
                    action="{{ auth()->user()->role === 'Admin' ? route('product.update.admin', $product->product_id) : route('product.update', $product->product_id) }}"
                    method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label for="product_name" class="block text-sm font-semibold text-gray-600 mb-1">
                                Product Name
                            </label>
                            <input type="text" id="product_name" name="product_name"
                                value="{{ $product->product_name }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300"
                                placeholder="Enter product name" required>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-600 mb-1">
                                Price ($)
                            </label>
                            <input type="number" id="price" name="price" value="{{ $product->price }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300"
                                placeholder="Enter price" required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-600 mb-1">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300"
                            placeholder="Enter description" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-600 mb-1">
                                Category
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->category_id }}"
                                        {{ $product->category_id == $cat->category_id ? 'selected' : '' }}>
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-600 mb-1">
                                Stock
                            </label>
                            <input type="number" id="stock" name="stock" value="{{ $product->stock }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300"
                                placeholder="Enter stock" required>
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-600 mb-1">
                                Product Images
                            </label>
                            <input type="file" id="image" name="image[]"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-purple-300"
                                accept="image/*" multiple max="5">
                            <p class="text-xs text-gray-500 mt-1">You can upload up to 5 images. Leave blank to keep the
                                current images.</p>
                        </div>

                        <!-- Current Image Previews -->
                        <div class="text-center">
                            <p class="text-xs text-gray-600 mb-2">Current Images:</p>
                            <div class="flex space-x-2">
                                @foreach ($product->productImages as $image)
                                    <img src="{{ asset($image->image_url) }}" alt="Product Image"
                                        class="w-20 h-20 object-cover rounded-md mx-auto">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow-md hover:scale-105 transform transition-all duration-150">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </main>


    </div>
</x-shopedia.app>
