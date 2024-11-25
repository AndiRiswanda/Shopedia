<x-shopedia.app>
    @section('title', Auth::user()->name . ' dashboard')
    <x-app.banner :store="$store" />
    <x-app.seller-header :user="Auth::user()" :store="$store" />
    <x-shopedia.alert />

    <main class="container mx-auto px-6 py-10">
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Products Card -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="bg-purple-600 text-white rounded-lg p-3 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-purple-600 font-semibold">Total Products</p>
                        <p class="text-3xl font-bold text-purple-800">{{ $products->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="bg-green-600 text-white rounded-lg p-3 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-green-600 font-semibold">Total Orders</p>
                        <p class="text-3xl font-bold text-green-800">{{ $orders->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 text-white rounded-lg p-3 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600 font-semibold">Total Revenue</p>
                        <p class="text-3xl font-bold text-blue-800">RM {{ number_format($orders->sum('total'), 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="bg-gradient-to-br from-amber-50 to-amber-100 shadow-lg rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="bg-amber-600 text-white rounded-lg p-3 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-amber-600 font-semibold">Unique Customers</p>
                        <p class="text-3xl font-bold text-amber-800">{{ $orders->unique('user_id')->count() }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-purple-800">Your Products</h2>
            <div class="flex space-x-4">
                <a href="{{ route('order.show.seller') }}" 
                   class="bg-gradient-to-r from-green-600 to-green-800 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>View Orders</span>
                </a>

                <button onclick="document.getElementById('addProductModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add Product</span>
                </button>

                <button onclick="document.getElementById('editStoreModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <span>Edit Store</span>
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        @if ($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    @include('components.shopedia.product-card', ['product' => $product])
                @endforeach
            </div>
        @else
            @include('components.shopedia.no-product-card')
        @endif

        @include('components.shopedia.add-product-modal', ['categories' => $category])
        @include('components.shopedia.edit-seller-modal')
    </main>
</x-shopedia.app>
