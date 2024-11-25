<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Order Status Hero -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-8 py-12">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Order #{{ $order->order_id }}</h1>
                        <p class="text-purple-100">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl px-6 py-4 backdrop-blur-lg">
                        <span class="text-lg font-semibold text-white">{{ $order->status }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Tracking Timeline -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Timeline</h2>
                    <div class="relative">
                        <div class="absolute left-8 top-0 h-full w-0.5 bg-purple-200"></div>
                        @foreach(['Order Placed', 'Processing', 'Shipped', 'Delivered'] as $step)
                            <div class="relative flex items-center mb-8">
                                <div class="absolute left-8 -translate-x-1/2 w-4 h-4 rounded-full 
                                    {{ array_search($step, ['Order Placed', 'Processing', 'Shipped', 'Delivered']) <= array_search($order->status, ['Order Placed', 'Processing', 'Shipped', 'Delivered']) ? 'bg-purple-600 ring-4 ring-purple-100' : 'bg-purple-200' }}">
                                </div>
                                <div class="ml-12">
                                    <h3 class="text-lg font-medium text-gray-800">{{ $step }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $step == 'Order Placed' ? $order->created_at->format('F d, Y h:ia') : '' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                <!-- Received Item Button -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Confirm Receipt</h2>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-semibold hover:bg-purple-700 transition-colors">
                            I Received My Item
                        </button>
                    </form>
                </div>
                </div>


                <!-- Product List -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Items</h2>
                    <div class="space-y-6">
                        @foreach($order->orderDetail as $detail)
                            <div class="flex items-center space-x-6 p-4 hover:bg-purple-50 rounded-xl transition-colors">
                                <img src="{{ $detail->product->productImages->first()->image_url ?? 'placeholder.jpg' }}" 
                                     class="w-24 h-24 object-cover rounded-xl shadow-md" 
                                     alt="{{ $detail->product->product_name }}">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-800">
                                        {{ $detail->product->product_name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Quantity: {{ $detail->quantity }}
                                    </p>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <span class="text-purple-600 font-semibold">
                                            RM {{ number_format($detail->product->price, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>RM {{ number_format($order->total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="border-t border-gray-100 pt-4 mt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">Total</span>
                                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-indigo-600">
                                    RM {{ number_format($order->total, 2) }}
                                </span>
                            </div>
                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>