<x-shopedia.app>
    @section('title', 'Store Orders')

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-12">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold mb-4">Store Orders</h1>
            <p class="text-purple-100">Manage and track your store's orders</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="container mx-auto px-6 -mt-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach([
                ['New Orders', $orders->where('status', 'Order Placed')->count(), 'fas fa-shopping-bag'],
                ['Processing', $orders->where('status', 'Processing')->count(), 'fas fa-cog'],
                ['Shipped', $orders->where('status', 'Shipped')->count(), 'fas fa-shipping-fast'],
                ['Completed', $orders->where('status', 'Delivered')->count(), 'fas fa-check-circle']
            ] as [$title, $count, $icon])
            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">{{ $title }}</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $count }}</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="{{ $icon }} text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Orders List -->
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Filters -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search orders..." 
                                class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                            <option>All Status</option>
                            <option>Order Placed</option>
                            <option>Processing</option>
                            <option>Shipped</option>
                            <option>Delivered</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr class="hover:bg-purple-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $order->order_id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-purple-600 font-semibold">
                                            {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $order->status === 'Delivered' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'Shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'Processing' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'Order Placed' ? 'bg-purple-100 text-purple-800' : '' }}
                                ">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('orders.show', $order->id) }}" 
                                   class="text-purple-600 hover:text-purple-900">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-shopedia.app>