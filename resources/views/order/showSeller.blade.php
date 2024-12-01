<x-shopedia.app>
    @section('title', 'Store Orders')
    <x-app.seller-header :user="Auth::user()" :store="Auth::user()->store" />
    <x-shopedia.alert />
    {{-- Banner --}}
    <div class="relative bg-cover bg-center text-white py-12"
        style="background-position: center 82%; background-image: url('{{ Auth::user()->store->banner_url ? asset('storage/' . Auth::user()->store->banner_url) : asset('images/BackroundForBanner.jpg') }}');">
        <div class="relative container mx-auto px-6">
            <h1 class="text-4xl font-bold mb-4">Store Orders</h1>
            <p class="text-purple-100">Manage and track your store's orders</p>
        </div>
    </div>
    {{-- stat --}}
    <div class="container mx-auto px-6 -mt-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ([['Orders', $newOrders, 'fas fa-shopping-bag'], ['Processing', $processingOrders, 'fas fa-cog'], ['Shipped', $shippedOrders, 'fas fa-shipping-fast'], ['Completed', $completedOrders, 'fas fa-check-circle']] as [$title, $count, $icon])
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
    <main class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-purple-100">
                <div class="p-6 text-gray-900">
                    {{-- List order --}}
                    <div class="container mx-auto px-6 py-8">
                        <a href="{{ route('store.index') }}"
                            class="px-3 py-2 bg-purple-600 hover:bg-purple-700 rounded-full text-purple-100 text-sm">
                            Back to Dashboard
                        </a>
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            {{-- Filter  --}}
                            <div class="p-6 border-b border-gray-100">
                                <div
                                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative">
                                            <input type="text" id="searchInput" onkeyup="filterOrders()"
                                                placeholder="Search orders..."
                                                class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                        </div>
                                        <select id="sortOrders" onchange="sortOrders(this.value)"
                                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                                            <option value="newest">Newest First</option>
                                            <option value="oldest">Oldest First</option>
                                            <option value="highest">Highest Amount</option>
                                            <option value="lowest">Lowest Amount</option>
                                            <option value="status">By Status</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- order table --}}
                            <div class="overflow-x-auto">
                                <table id="ordersTable" class="min-w-full">
                                    <thead class="header bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Product</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Customer</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantity</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($orders as $order)
                                            @foreach ($order->orderDetail as $detail)
                                                @if ($detail->product->store_id == Auth::user()->store->store_id)
                                                    <tr class="hover:bg-purple-50 transition-colors"
                                                        data-date="{{ $order->created_at }}"
                                                        data-amount="{{ $order->total }}"
                                                        data-status="{{ $order->status }}">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="flex-shrink-0 h-10 w-10">
                                                                    <img src="{{ asset($detail->product->productImages->first()->image_url) }}"
                                                                        alt="{{ $detail->product->name }}"
                                                                        class="h-10 w-10 rounded-full object-cover">
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $detail->product->product_name }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        ID: {{ $detail->product->product_id }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                                    <span class="text-purple-600 font-semibold">
                                                                        <img src="{{ asset($order->user->profile_url) }}"
                                                                            alt="{{ $order->user->name }}'s profile"
                                                                            class="w-10 h-10 rounded-full object-cover">
                                                                    </span>
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $order->user->name }}
                                                                    </div>
                                                                    <div class="text-sm text-gray-500">
                                                                        {{ $order->user->email }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <span
                                                                class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $detail->status === 'Delivered' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $detail->status === 'Shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $detail->status === 'Processing' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $detail->status === 'Order Placed' ? 'bg-purple-100 text-purple-800' : '' }}
                                    ">
                                                                {{ $detail->status }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500">
                                                            {{ $detail->quantity }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500">
                                                            Rm {{ number_format($order->total, 0) }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500">
                                                            {{ $order->created_at->format('M d, Y') }}
                                                        </td>
                                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                                            @if ($detail->status === 'Order Placed' || $detail->status === 'Processing')
                                                                <form
                                                                    action="{{ route('orders.ship', $order->order_id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $detail->product_id }}">
                                                                    <button type="submit"
                                                                        class="px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-colors duration-300">
                                                                        Mark as Shipped
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- note to self: please take a minute to understand how i truly made this code lol  :/ --}}
    <script>
        function filterOrders() {
            let input = document.getElementById("searchInput");
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll("#ordersTable tr:not(.header)");

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        }

        function getStatusPriority(status) {
            const priorities = {
                'Order Placed': 4,
                'Processing': 3,
                'Shipped': 2,
                'Delivered': 1
            };
            return priorities[status] || 0;
        }

        function sortOrders(criteria) {
            let tbody = document.querySelector("#ordersTable tbody");
            let rows = Array.from(tbody.querySelectorAll("tr"));

            rows.sort((a, b) => {
                switch (criteria) {
                    case 'newest':
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'oldest':
                        return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'highest':
                        return parseFloat(b.dataset.amount) - parseFloat(a.dataset.amount);
                    case 'lowest':
                        return parseFloat(a.dataset.amount) - parseFloat(b.dataset.amount);
                    case 'status':
                        return getStatusPriority(b.dataset.status) - getStatusPriority(a.dataset.status);
                    default:
                        return 0;
                }
            });

            rows.forEach(row => tbody.appendChild(row));
        }
    </script>
</x-shopedia.app>
