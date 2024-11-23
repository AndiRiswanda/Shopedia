<x-shopedia.app>
    @section('title', Auth::user()->name . ' dashboard')
    <x-app.banner :store="$store" />

    <x-app.seller-header :user="Auth::user()" :store="$store" />
    <x-shopedia.alert />

    <main class="container mx-auto px-6 py-10">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
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
                        <p class="text-3xl font-bold text-purple-800">{{ $products->count() }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-purple-800">Your Products</h2>
                <div class="flex">
                    <button onclick="document.getElementById('addProductModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-purple-600 to-purple-800 mx-5 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add Product</span>
                </button>
                <button onclick="document.getElementById('editStoreModal').classList.remove('hidden')"
                    class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <span>Edit Store</span>
                </button>
                </div>

            </div>

            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        @include('components.shopedia.product-card', ['product' => $product])
                    @endforeach
                </div>
            @else
                @include('components.shopedia.no-product-card')
            @endif

            @include('components.shopedia.add-product-modal', ['categories' => $category])
            @include('components.shopedia.edit-seller-modal')
        </section>
    </main>
</x-shopedia.app>
