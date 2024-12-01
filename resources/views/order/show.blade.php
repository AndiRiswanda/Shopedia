<x-main.app>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- Order Header --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Order #{{ $order->order_id }}</h1>
                            <p class="text-purple-100 text-sm">
                                Placed on {{ $order->created_at->format('F d, Y') }}
                            </p>
                        </div>
                        <div class="bg-white/20 rounded-xl px-4 py-2 backdrop-blur-md">
                            @php
                                $allDelivered = $order->orderDetail->every(function ($detail) {
                                    return $detail->status == 'Delivered';
                                });
                                $orderStatus = $allDelivered ? 'Completed' : 'In Progress';
                            @endphp
                            <span class="text-lg font-semibold text-white">
                                {{ $orderStatus }}
                            </span>
                        </div>
                    </div>
                </div>
                {{-- Overall Order Timeline --}}
                <div class="px-6 py-8">
                    @php
                        $orderStatuses = ['Order Placed', 'Processing', 'Shipped', 'Delivered'];
                        $statuses = $order->orderDetail->pluck('status')->toArray();
                        $statusIndices = array_map(function ($status) use ($orderStatuses) {
                            $index = array_search($status, $orderStatuses);
                            return $index === false ? 0 : $index;
                        }, $statuses);
                        $currentStatusIndex = max($statusIndices);
                        $progressPercentage = (($currentStatusIndex + 1) / count($orderStatuses)) * 100;
                    @endphp

                    <div class="relative w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mb-6">
                        <div class="absolute top-0 left-0 h-full bg-purple-500 transition-all duration-300"
                            style="width: {{ $progressPercentage }}%">
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4 relative">
                        @foreach ($orderStatuses as $index => $step)
                            <div class="flex flex-col items-center relative">
                                <div class="relative z-10">
                                    <div
                                        class="w-8 h-8 rounded-full border-4 
                                                                    {{ $index <= $currentStatusIndex
                                                                        ? ($index == $currentStatusIndex
                                                                            ? 'bg-yellow-500 border-yellow-500'
                                                                            : 'bg-purple-500 border-purple-500')
                                                                        : 'bg-white border-gray-300' }} 
                                                                    flex items-center justify-center transition-all duration-300">
                                        @switch($step)
                                            @case('Order Placed')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 {{ $index <= $currentStatusIndex ? 'text-white' : 'text-gray-400' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                                </svg>
                                            @break

                                            @case('Processing')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 {{ $index <= $currentStatusIndex ? 'text-white' : 'text-gray-400' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            @break

                                            @case('Shipped')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 {{ $index <= $currentStatusIndex ? 'text-white' : 'text-gray-400' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    <path
                                                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                                </svg>
                                            @break

                                            @case('Delivered')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 {{ $index <= $currentStatusIndex ? 'text-white' : 'text-gray-400' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break
                                        @endswitch
                                    </div>
                                </div>
                                <p
                                    class="mt-2 text-center text-xs sm:text-sm {{ $index <= $currentStatusIndex ? 'text-gray-800 font-semibold' : 'text-gray-400' }}">
                                    {{ $step }}
                                </p>
                                @if ($step == 'Order Placed')
                                    <p class="text-xs text-gray-500 text-center">
                                        {{ $order->created_at->format('F d, Y h:ia') }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (Auth::user()->role == 'Seller')
                    <div class="px-6 py-4 bg-gray-50">
                        <a href="{{ route('store.index') }}"
                            class="text-purple-600 hover:text-purple-800 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                @endif
            </div>

            {{-- Order Content --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Order Summary Section --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">
                            Order Summary
                        </h2>
                        <div class="space-y-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-semibold">
                                    RM {{ number_format($order->total, 2) }}
                                </span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-purple-600 font-semibold">
                                    Free
                                </span>
                            </div>
                            <div class="border-t border-gray-100 pt-4 mt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-800">
                                        Total
                                    </span>
                                    <span class="text-2xl font-bold text-purple-600">
                                        RM {{ number_format($order->total, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Store and Products Section --}}
                <div class="lg:col-span-2 space-y-8">
                    @foreach ($order->orderDetail->groupBy('product.store_id') as $storeId => $details)
                        @php
                            $store = $details->first()->product->store;
                        @endphp

                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            {{-- Store Header --}}
                            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-800">
                                    {{ $store->store_name }}
                                </h2>
                            </div>

                            {{-- Products List --}}
                            <div class="divide-y divide-gray-200">
                                @foreach ($details as $orderDetail)
                                    <div class="px-6 py-4 flex items-center space-x-4">
                                        {{-- Product Image --}}
                                        <div class="flex-shrink-0">
                                            <a
                                                href="{{ route('product.show', ['product' => $orderDetail->product->product_id]) }}">
                                                <img src="{{ asset($orderDetail->product->productImages->first()->image_url) }}"
                                                    alt="{{ $orderDetail->product->name }}"
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            </a>
                                        </div>

                                        {{-- Product Details --}}
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-semibold text-gray-800">
                                                {{ $orderDetail->product->name }}
                                            </h3>
                                            <p class="text-gray-600">
                                                Quantity: {{ $orderDetail->quantity }}
                                                | Price: RM {{ number_format($orderDetail->product->price, 2) }}
                                            </p>
                                        </div>

                                        {{-- Product Status Progress --}}
                                        <div class="w-1/2">
                                            @php
                                                $productStatuses = [
                                                    'Order Placed',
                                                    'Processing',
                                                    'Shipped',
                                                    'Delivered',
                                                ];
                                                $currentStatusIndex = array_search(
                                                    $orderDetail->status,
                                                    $productStatuses,
                                                );
                                            @endphp

                                            <div
                                                class="relative w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mb-2">
                                                <div class="absolute top-0 left-0 h-full bg-purple-500 transition-all duration-300"
                                                    style="width: {{ ($currentStatusIndex / (count($productStatuses) - 1)) * 100 }}%">
                                                </div>
                                            </div>

                                            <div class="flex justify-between text-xs text-gray-500">
                                                @foreach ($productStatuses as $index => $status)
                                                    <span
                                                        class="{{ $index <= $currentStatusIndex ? 'font-semibold text-gray-800' : '' }}">
                                                        {{ $status }}
                                                    </span>
                                                @endforeach
                                            </div>

                                            {{-- Button for Shipped Orders --}}
                                            @if ($orderDetail->status === 'Shipped' && Auth::user()->role !== 'Seller')
                                                <div class="mt-4">
                                                    <form
                                                        action="{{ route('orders.deliver', [$order->order_id, $orderDetail->product->store_id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center justify-center space-x-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>Mark as Delivered</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-main.app>
