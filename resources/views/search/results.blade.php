<x-main.app>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
        <div class="container mx-auto px-4 py-8">

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar Filters -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-4">
                        <h3 class="text-lg font-bold text-purple-800 mb-4 flex items-center">
                            <i class="fas fa-filter mr-2"></i> Filters
                        </h3>
                        <!-- Add this at the start of the filters section -->
                        <form id="filterForm" method="GET" action="{{ route('search') }}">
                            <input type="hidden" name="query" value="{{ $query }}">

                            <!-- Categories Section -->
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-700 mb-3">Categories</h4>
                                <div class="space-y-2">
                                    <!-- Add All Categories option -->
                                    <label
                                        class="flex items-center space-x-2 text-gray-600 hover:text-purple-600 cursor-pointer">
                                        <input type="radio" name="category" value=""
                                            {{ request('category') == null ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                        <span>All Categories</span>
                                    </label>

                                    @foreach ($categories as $category)
                                        <label
                                            class="flex items-center space-x-2 text-gray-600 hover:text-purple-600 cursor-pointer">
                                            <input type="radio" name="category" value="{{ $category->category_id }}"
                                                {{ request('category') == $category->category_id ? 'checked' : '' }}
                                                onchange="this.form.submit()"
                                                class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                            <span>{{ $category->category_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>


                            <!-- Price Range -->
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-700 mb-3">Price Range</h4>
                                <div class="space-y-4">
                                    <div>
                                        <input type="range" id="priceRange" min="0"
                                            max="{{ $products->max('price') }}" step="10"
                                            value="{{ request('price_max', $products->max('price')) }}"
                                            class="w-full h-2 bg-purple-200 rounded-lg appearance-none cursor-pointer"
                                            oninput="updatePriceRangeValue(this.value)">
                                    </div>
                                    <div class="flex justify-between space-x-4">
                                        <input type="number" name="price_min" id="priceMin"
                                            value="{{ request('price_min', 0) }}" placeholder="Min"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                        <input type="number" name="price_max" id="priceMax"
                                            value="{{ request('price_max', $products->max('price')) }}"
                                            placeholder="Max"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                    </div>
                                    <button type="button" onclick="applyPriceFilter()"
                                        class="w-full py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                        Apply Filter
                                    </button>
                                </div>
                            </div>


                            <form id="filterForm" action="{{ route('search') }}" method="GET">
                                <input type="hidden" name="query" value="{{ $query }}">
                                <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', '') }}">

                                <div class="mb-6">
                                    <h4 class="font-semibold text-gray-700 mb-3">Sort By</h4>
                                    <div class="space-y-2">
                                        <button type="button" onclick="updateSort('price_asc')"
                                            class="w-full text-left px-4 py-2 rounded-lg hover:bg-purple-50 
                                                   {{ request('sort') === 'price_asc' ? 'bg-purple-100 text-purple-600' : 'text-gray-600 hover:text-purple-600' }} 
                                                   transition-colors">
                                            <i class="fas fa-sort-amount-down mr-2"></i>Price: Low to High
                                        </button>
                                        <button type="button" onclick="updateSort('price_desc')"
                                            class="w-full text-left px-4 py-2 rounded-lg hover:bg-purple-50
                                                   {{ request('sort') === 'price_desc' ? 'bg-purple-100 text-purple-600' : 'text-gray-600 hover:text-purple-600' }}
                                                   transition-colors">
                                            <i class="fas fa-sort-amount-up mr-2"></i>Price: High to Low
                                        </button>
                                        <button type="button" onclick="updateSort('newest')"
                                            class="w-full text-left px-4 py-2 rounded-lg hover:bg-purple-50
                                                   {{ request('sort') === 'newest' ? 'bg-purple-100 text-purple-600' : 'text-gray-600 hover:text-purple-600' }}
                                                   transition-colors">
                                            <i class="fas fa-calendar mr-2"></i>Newest First
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="lg:w-3/4">
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <div
                                    class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <!-- Product Image -->
                                    <div class="relative overflow-hidden">
                                        <img src="{{ asset($product->productImages->first()->image_url) }}"
                                            alt="{{ $product->product_name }}"
                                            class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute top-0 right-0 m-4">
                                            <button
                                                class="p-2 bg-white rounded-full shadow-md text-purple-400 hover:text-purple-700 transition-colors">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="p-6">
                                        <div class="flex items-center mb-2">
                                            <span
                                                class="px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded-full">{{ $product->category->category_name }}</span>
                                        </div>
                                        <h3
                                            class="font-bold text-gray-800 text-lg mb-2 group-hover:text-purple-600 transition-colors">
                                            {{ $product->product_name }}
                                        </h3>
                                        <p class="text-purple-600 text-xl font-bold mb-4">
                                            ${{ number_format($product->price, 2) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('product.show', $product->product_id) }}"
                                                class="w-full text-center py-3 bg-purple-600 text-white rounded-xl 
                                                      hover:bg-purple-700 transition-colors duration-300 flex items-center justify-center space-x-2">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>View Details</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Enhanced Empty State -->
                        <div class="text-center py-16 bg-white rounded-2xl shadow-md">
                            <div class="mb-6 text-purple-200">
                                <i class="fas fa-search text-8xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                                No products found
                            </h3>
                            <p class="text-gray-600 mb-8">
                                Try adjusting your search or filter to find what you're looking for
                            </p>
                            <a href="{{ route('Home') }}"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors duration-300">
                                <i class="fas fa-home mr-2"></i>
                                Back to Home
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center pb-8">
        {{ $products->links() }}
    </div>
</x-main.app>
<script>
    function updateSort(sortValue) {
        document.getElementById('sortInput').value = sortValue;
        document.getElementById('filterForm').submit();
    }

    function updatePriceRangeValue(value) {
        document.getElementById('priceMax').value = value;
    }

    function applyPriceFilter() {
        const minPrice = document.getElementById('priceMin').value;
        const maxPrice = document.getElementById('priceMax').value;

        const form = document.getElementById('filterForm');

        let minInput = form.querySelector('input[name="price_min"]');
        if (!minInput) {
            minInput = document.createElement('input');
            minInput.type = 'hidden';
            minInput.name = 'price_min';
            form.appendChild(minInput);
        }
        minInput.value = minPrice;

        let maxInput = form.querySelector('input[name="price_max"]');
        if (!maxInput) {
            maxInput = document.createElement('input');
            maxInput.type = 'hidden';
            maxInput.name = 'price_max';
            form.appendChild(maxInput);
        }
        maxInput.value = maxPrice;

        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const range = document.getElementById('priceRange');
        const maxPrice = range.getAttribute('max');
        updatePriceRangeValue(maxPrice);
    });

    function applyCategoryFilter() {
        document.getElementById('filterForm').submit();
    }
</script>
