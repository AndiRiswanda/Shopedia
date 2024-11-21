<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Heroicons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.0.18/24/outline/style.min.css">
    <style>
        /* Custom scrollbar for smooth scrolling */
        body::-webkit-scrollbar {
            width: 12px;
        }

        body::-webkit-scrollbar-track {
            background: #f3e8ff;
        }

        body::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #9333ea, #4c1d95);
            border-radius: 6px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #6b21a8;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-100 via-purple-50 to-white min-h-screen">

    <!-- Top Banner -->
    <div class="relative">
        <div
            class="bg-gradient-to-r from-purple-600 to-purple-900 h-40 md:h-48 flex items-center justify-center text-white">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-position: center 82%; background-image: url('{{ asset('images/BackroundForBanner.jpg') }}');">
            </div>
            <div>
                <h1 class="relative text-3xl md:text-4xl font-bold">Proud With Shopedia</h1>
                <h3 class="text-center">Where Every Product Have love</h3>
            </div>
        </div>

    </div>


    <!-- Header Section -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Store Info -->
            <div class="flex items-center space-x-4">
                <!-- Store Profile Picture -->
                <div class="h-12 w-12 md:h-16 md:w-16 rounded-full bg-gray-200 overflow-hidden shadow">
                    <img src="https://via.placeholder.com/64" alt="Store Profile Picture"
                        class="h-full w-full object-cover">
                </div>
                <!-- Welcome Text -->
                <div>
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
                    <h2 class="text-sm md:text-base text-gray-500">{{ $store->store_name }}</h2>
                </div>
            </div>

            <!-- Actions -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Add this right after your header section in dashboard.blade.php -->
    @if (session('success'))
        <div class="container mx-auto px-6 py-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container mx-auto px-6 py-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        <!-- Stats Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Products -->
            <div
                class="bg-gradient-to-br from-purple-50 to-purple-100 shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="bg-purple-600 text-white rounded-lg p-3 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-purple-600 font-semibold">Total Products</p>
                        <p class="text-3xl font-bold text-purple-800">{{ count($storeProducts) }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-purple-800">Your Products</h2>
                <button onclick="document.getElementById('addProductModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add Product</span>
                </button>
            </div>

            <!-- Product Cards -->
            @if (count($storeProducts) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($storeProducts as $product)
                        <div
                            class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                            <!-- Product Image Section -->
                            <div class="relative h-64">

                                <img src="{{ $product->products->productImages->first()->image_url ?? 'https://karanzi.websites.co.in/obaju-turquoise/img/product-placeholder.png' }}"
                                    alt="{{ $product->products->product_name }}" class="w-full h-64 object-cover">

                                <div
                                    class="absolute top-0 left-0 bg-black bg-opacity-50 text-white p-2 text-sm rounded-br-lg">
                                    {{ $product->products->category->category_name ?? 'Uncategorized' }}
                                </div>
                            </div>

                            <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100">
                                <h3 class="text-xl font-semibold text-purple-800">
                                    {{ $product->products->product_name }}
                                </h3>
                            </div>
                            <div class="p-4 space-y-3">
                                <p class="text-gray-600">{{ $product->products->description }}</p>
                                <div class="flex justify-between items-center">
                                    <p class="text-xl font-bold text-purple-800">
                                        ${{ number_format($product->products->price, 2) }}</p>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('product.edit', $product->product_id) }}"
                                            class="px-4 py-2 bg-purple-50 border border-purple-200 text-purple-600 rounded-lg hover:bg-purple-100">
                                            Edit
                                        </a>
                                        <a href="{{ route('product.show.seller', ['product' => $product->products->product_id]) }}"
                                            class="px-4 py-2 bg-purple-50 border border-purple-200 text-purple-600 rounded-lg hover:bg-purple-100">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- if no product -->
                <div class="bg-purple-50 border-2 border-dashed border-purple-200 rounded-xl p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-purple-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-bold text-purple-900 mb-2">No Products Yet</h3>
                    <p class="text-purple-600 mb-6">Start adding products to your store and watch your business grow!
                    </p>
                    <button onclick="document.getElementById('addProductModal').classList.remove('hidden')"
                        class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-full shadow-lg">
                        Add Your First Product
                    </button>
                </div>
            @endif

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


</body>

</html>
