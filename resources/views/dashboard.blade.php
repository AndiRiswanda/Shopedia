<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
        <div class="container mx-auto px-4 py-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Sidebar -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="text-center">
                        <img src="{{ asset($user->profile_url) }}" alt="{{ $user->name }}'s profile"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover object-center bg-purple-200 border-4 border-purple-200 transform scale-125 translate-y-2">
                        <h2 class="text-2xl font-bold text-purple-800">{{ $user->name }}</h2>
                        <p class="text-purple-600">Shopedia</p>
                    </div>

                    <div class="mt-6 space-y-4">
                        @if (Auth::user()->role == 'Buyer')
                            <a href="{{ route('order.show.buyer', ['store' => Auth::user()->id]) }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                My Orders
                            </a>
                        @elseif(Auth::user()->role == 'Seller')
                            <a href="{{ route('order.show.seller', ['store' => Auth::user()->store->store_id]) }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                My Orders
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                Admin Dashboard
                            </a>
                        @endif

                        @if (Auth::user()->role == 'Buyer')
                            <a href="{{ route('wishlist.index') }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                Wishlist
                            </a>
                        @elseif(Auth::user()->role == 'Seller')
                            <a href="{{ route('store.index') }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                My Store
                            </a>
                        @else
                        @endif
                        @if (Auth::user()->role == 'Buyer')
                            <a href="{{ route('cart.index') }}"
                                class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                                My Cart
                            </a>
                        @endif

                        <a href="{{ route('Home') }}"
                            class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            Go Back Shopping
                        </a>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="md:col-span-2 space-y-6">
                    @if (Auth::user()->role == 'Buyer')
                        <!-- Recent Orders -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            @if ($orders && $orders->count() > 0)
                                <h3 class="text-xl font-bold text-purple-800 mb-4">Recent Orders</h3>
                                <div class="space-y-4">
                                    @forelse($orders as $order)
                                        <div class="flex items-center justify-between bg-purple-50 p-4 rounded-lg">
                                            <div>
                                                <p class="font-semibold text-purple-800">
                                                    {{ $order->orderDetail->first()->product->product_name }}
                                                </p>
                                                <p class="text-sm text-purple-600">
                                                    {{ optional($order->orderDetail)->count() ?? 0 }} Items |
                                                    Placed on {{ $order->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm 
                                                        @php
$allDelivered = true;
                                                        if($order->orderDetail && $order->orderDetail->count() > 0) {
                                                            foreach($order->orderDetail as $detail) {
                                                                if($detail->status !== 'Delivered') {
                                                                    $allDelivered = false;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        $orderStatus = $allDelivered ? 'Delivered' : 'Processing'; @endphp
                                                    
                                                    @switch($orderStatus)
                                                        @case('Delivered')
                                                            bg-green-100 text-green-800
                                                            @break
                                                        @case('Processing')
                                                            bg-yellow-100 text-yellow-800
                                                            @break
                                                        @case('Shipped')
                                                            bg-blue-100 text-blue-800
                                                            @break
                                                        @default
                                                            bg-gray-100 text-gray-800
                                                    @endswitch">
                                                    {{ $orderStatus }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-4 text-gray-500">
                                            No orders found
                                        </div>
                                    @endforelse
                                </div>
                        </div>
                    @endif
                    <!-- Account Summary -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-800 mb-4">Account Summary</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <p class="text-purple-600">Total Spent</p>
                                <p class="text-2xl font-bold text-purple-800">
                                    Rp{{ number_format($totalSpent, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <p class="text-purple-600">Loyalty Points</p>
                                <p class="text-2xl font-bold text-purple-800">
                                    {{ $orders->flatMap(function ($order) {
                                            return $order->orderDetail;
                                        })->where('status', 'Delivered')->count() * 5 }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Products -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-800 mb-4">Recommended For You</h3>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($recomended as $product)
                                <div class="bg-purple-50 p-4 rounded-lg text-center">
                                    <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                        <img src="{{ $product->productImages->first()->image_url ?? '/api/placeholder/150/150' }}"
                                            alt="{{ $product->product_name }}"
                                            class="w-full mb-2 rounded-xl object-cover h-40">
                                    </a>
                                    <p class="font-semibold text-purple-800">
                                        {{ $product->product_name }}</p>
                                    <p class="text-purple-600">
                                        Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role == 'Seller')
                <iframe src="http://127.0.0.1:8000/product/ini/store/{{ Auth::user()->store->store_id }}"
                    width="500" height="500" style="border:none;"></iframe>


                @endif




            </div>
        </div>
    </div>
    </div>
</x-app-layout>
