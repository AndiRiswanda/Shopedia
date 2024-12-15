<div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
    <div class="relative aspect-square">
        <img src="{{ $product->productImages->first()->image_url ?? 'https://karanzi.websites.co.in/obaju-turquoise/img/product-placeholder.png' }}"
            alt="{{ $product->product_name }}" 
            class="w-full h-full object-cover absolute inset-0">
        <div class="absolute top-0 left-0 bg-black bg-opacity-50 text-white p-2 text-sm rounded-br-lg">
            {{ $product->category->category_name ?? 'Uncategorized' }}
        </div>
    </div>

    <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100">
        <h3 class="text-xl font-semibold text-purple-800">
            {{ $product->product_name }}
        </h3>
    </div>
    <div class="p-4 space-y-3">
        
        <div class="flex justify-between items-center">
            <p class="text-xl font-bold text-purple-800">
                Rp{{ number_format($product->price, 2) }}</p>
            <div class="flex space-x-2">
                <a href="{{ route('product.edit', $product->product_id) }}"
                    class="px-2 py-2 bg-purple-50 border border-purple-200 text-purple-600 rounded-lg hover:bg-purple-100">
                    Edit
                </a>
                <a href="{{ route('product.show.seller', ['product' => $product->product_id]) }}"
                    class="px-2 py-2 bg-purple-50 border border-purple-200 text-purple-600 rounded-lg hover:bg-purple-100">
                    View Details
                </a>
            </div>
        </div>
    </div>
</div>