<x-main.app>
    <!-- Category Banner -->
    <div class="relative h-64 mb-8">
        <div class="absolute inset-0 bg-cover rounded-3xl bg-center"
            style="background-image: url('{{ asset('images/categories/' . strtolower(str_replace(' ', '-', $category->category_name)) . '.jpg') }}');">
            <div class="absolute inset-0 bg-black rounded-3xl bg-opacity-50"></div>
        </div>

        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="text-white">
                <div class="flex items-center space-x-4 mb-4">
                    @if (!str_contains(strtolower($category->category_name), 'electronics'))
                        <i
                            class="fas fa-{{ str_contains(strtolower($category->category_name), 'electronics')
                                ? 'laptop'
                                : (str_contains(strtolower($category->category_name), 'fashion')
                                    ? 'tshirt'
                                    : (str_contains(strtolower($category->category_name), 'beauty')
                                        ? 'spa'
                                        : (str_contains(strtolower($category->category_name), 'sports')
                                            ? 'running'
                                            : (str_contains(strtolower($category->category_name), 'figure')
                                                ? 'gamepad'
                                                : (str_contains(strtolower($category->category_name), 'health')
                                                    ? 'heartbeat'
                                                    : (str_contains(strtolower($category->category_name), 'automotive')
                                                        ? 'car'
                                                        : (str_contains(strtolower($category->category_name), 'pets')
                                                            ? 'paw'
                                                            : (str_contains(strtolower($category->category_name), 'home')
                                                                ? 'home'
                                                                : (str_contains(strtolower($category->category_name), 'books')
                                                                    ? 'book'
                                                                    : 'tags'))))))))) }} 
                        fa-3x"></i>

                        <h1 class="text-4xl font-bold">{{ $category->category_name }}</h1>
                    @endif
                </div>
                @if (!str_contains(strtolower($category->category_name), 'electronics'))
                    <p class="text-lg opacity-90">
                        Discover our amazing selection of {{ strtolower($category->category_name) }}
                    </p>
                @endif

            </div>
        </div>
    </div>


    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
        <div class="container mx-auto px-4 py-8">
            @if ($products->count() > 0)
                <div class="min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
                    <div class="container mx-auto px-4 py-8">
                        <h1 class="text-3xl font-bold text-purple-800 mb-8">
                            {{ $category->category_name }}
                        </h1>
                        @if ($products->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($products as $product)
                                    <a href="{{ route('product.show', $product) }}">
                                        <div
                                            class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">
                                            <div class="relative overflow-hidden">
                                                <img src="{{ asset($product->productImages->first()->image_url) }}"
                                                    alt="{{ $product->product_name }}" class="w-full h-48 object-cover">
                                            </div>

                                            <div class="p-4">
                                                <h3 class="font-bold text-gray-800 text-lg mb-2">
                                                    {{ $product->product_name }}
                                                </h3>
                                                <p class="text-purple-600 text-xl font-bold">
                                                    Rp {{ number_format($product->price, 2) }}
                                                </p>

                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <div class="mt-8">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center min-h-[400px] bg-white rounded-2xl p-8">
                        <img src="{{ asset('images/takjumpa.jpg') }}" 
                             alt="Not Found" 
                             class="w-64 h-64 object-contain mb-6">
                        
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">
                            No Products Found
                        </h2>
                        
                        <p class="text-gray-600 mb-6">
                            We couldn't find any products matching your criteria
                        </p>
                        
                        <a href="{{ route('Home') }}" 
                           class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Back to Home
                        </a>
                    </div>
            @endif
        </div>
</x-main.app>
