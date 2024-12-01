<x-main.app>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-purple-600 to-purple-900 text-white py-16 rounded-2xl overflow-hidden">
        <div class="absolute inset-0 overflow-hidden rounded-2xl">
            <div class="absolute inset-0 bg-purple-900 opacity-50"></div>
            <div class="absolute inset-0" style="background-image: url('{{ asset('images/BackroundForBanner.jpg') }}'); opacity: 0.5"></div>
        </div>
        
        <div class="relative container mx-auto px-6">
            <h1 class="text-4xl font-bold mb-4">My Orders</h1>
            <p class="text-purple-200">Track and manage your shopping journey</p>
            
            <!-- Order Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
                @foreach ([
                    ['All Orders', $orders->count(), 'fas fa-shopping-bag'],
                    ['Processing', $orders->pluck('orderDetail')->flatten()->where('status', 'Processing')->count(), 'fas fa-cog'],
                    ['Shipped', $orders->pluck('orderDetail')->flatten()->where('status', 'Shipped')->count(), 'fas fa-shipping-fast'],
                    ['Delivered', $orders->pluck('orderDetail')->flatten()->where('status', 'Delivered')->count(), 'fas fa-check-circle']
                ] as [$title, $count, $icon])
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-200">{{ $title }}</p>
                                <h3 class="text-3xl font-bold">{{ $count }}</h3>
                            </div>
                            <div class="bg-purple-500/30 p-3 rounded-full">
                                <i class="{{ $icon }} text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Order Filters -->
            <div class="p-6 border-b border-purple-100">
                <div class="flex space-x-4">
                    @foreach(['All', 'Order Placed', 'Processing', 'Shipped', 'Delivered'] as $filter)
                        <a href="{{ route('order.show.buyer', ['filter' => $filter]) }}" 
                           class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300
                                {{ request()->get('filter') == $filter ? 
                                   'bg-purple-600 text-white shadow-lg' : 
                                   'text-purple-600 hover:bg-purple-50' }}">
                            {{ $filter }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Orders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                @forelse($orders as $order)
                    <div class="bg-white rounded-xl border border-purple-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Order #{{ $order->order_id }}</h3>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('F d, Y') }}</p>
                                </div>
                          </div>

                            <!-- Order Products -->
                            <div class="space-y-4">
                                @foreach($order->orderDetail as $detail)
                                    <div class="flex items-center space-x-4">
                                        <a href="{{ route('product.show', ['product' => $detail->product->product_id]) }}">
                                        <img src="{{ $detail->product->productImages->first()->image_url }}" alt="{{ $detail->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                        </a>
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-800">{{ $detail->product->name }}</h4>
                                            <p class="text-sm text-gray-500">Quantity: {{ $detail->quantity }}</p>
                                            <p class="text-sm text-gray-500">Status: {{ $detail->status }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 flex justify-between items-center">
                                <div class="text-lg font-semibold text-purple-600">RM {{ number_format($order->total, 2) }}</div>
                                <a href="{{ route('orders.show', $order->order_id) }}" 
                                   class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shopping-bag text-4xl text-purple-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No orders yet</h3>
                        <p class="text-gray-500">Start shopping to create your first order!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-main.app>