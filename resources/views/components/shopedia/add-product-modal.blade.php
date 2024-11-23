<!-- Add Product Modal -->
<div id="addProductModal"
class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
<div
    class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-3xl mx-6 relative transition-transform transform scale-95">
    <!-- Close Button -->
    <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 focus:outline-none"
        onclick="document.getElementById('addProductModal').classList.add('hidden')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Modal Title -->
    <h2 class="text-3xl font-bold text-purple-800 mb-6 text-center">Add New Product</h2>
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') }}" alt="Your Logo"
            class="h-16 w-auto">
    </div>
    <!-- Product Form -->
    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <!-- Two Columns for Input Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div>
                <label for="product_name"
                    class="block text-sm font-semibold text-gray-600 mb-2">Product Name</label>
                <input type="text" id="product_name" name="product_name"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300"
                    placeholder="Enter product name" required>
            </div>

            <!-- Product Price -->
            <div>
                <label for="price" class="block text-sm font-semibold text-gray-600 mb-2">Price
                    ($)</label>
                <input type="number" id="price" name="price"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300"
                    placeholder="Enter product price" required>
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description"
                class="block text-sm font-semibold text-gray-600 mb-2">Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300"
                placeholder="Enter product description" required></textarea>
        </div>

        <!-- Two Columns for Category and Stock -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Category -->
            <div>
                <label for="category_id"
                    class="block text-sm font-semibold text-gray-600 mb-2">Category</label>
                <select id="category_id" name="category_id"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300">
                    <option value="" disabled selected>Select category</option>
                    <!-- Loop through categories -->
                    @foreach ($category as $cat)
                        <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stock -->
            <div>
                <label for="stock"
                    class="block text-sm font-semibold text-gray-600 mb-2">Stock</label>
                <input type="number" id="stock" name="stock"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300"
                    placeholder="Enter product stock" required>
            </div>
        </div>

        <!-- Product Image -->
        <div>
            <label for="image" class="block text-sm font-semibold text-gray-600 mb-2">Product
                Image</label>
            <input type="file" id="image" name="image"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-purple-300"
                accept="image/*" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit"
                class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-8 py-3 rounded-full shadow-lg hover:scale-105 transform transition-all duration-200">
                Add Product
            </button>
        </div>
    </form>
</div>
</div>