<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopedia Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-900 font-inter antialiased">
    <div class="flex min-h-screen" x-data="{ openSection: 'dashboard' }">
        <!-- Sleek Sidebar -->
        <div class="w-72 bg-white shadow-xl border-r border-gray-100 fixed left-0 top-0 bottom-0 z-40">
            <div class="px-6 py-8">
                <div class="flex items-center justify-center mb-12">
                    <h1 class="text-3xl font-bold text-indigo-600 tracking-tight">Shopedia</h1>
                </div>

                <nav class="space-y-2">
                    <a href="#" @click="openSection = 'dashboard'"
                        :class="{ 'bg-indigo-50': openSection === 'dashboard' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-3 text-indigo-500 group-hover:text-indigo-600">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" @click="openSection = 'users'"
                        :class="{ 'bg-indigo-50': openSection === 'users' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-3 text-indigo-500 group-hover:text-indigo-600">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Users
                    </a>
                    <a href="#" @click="openSection = 'products'"
                        :class="{ 'bg-indigo-50': openSection === 'products' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-3 text-indigo-500 group-hover:text-indigo-600">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                        </svg>
                        Products
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 ml-72 p-6">
            <div x-show="openSection === 'dashboard'">
                <h2 class="text-3xl font-semibold mb-4">Dashboard</h2>
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div
                        class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-indigo-500">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-indigo-600">{{ $users->count() }}</div>
                        <div class="text-sm text-green-600 mt-2">+12.5% this month</div>
                    </div>

                    <div
                        class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-green-500">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-green-600">{{ $products->count() }}</div>
                        <div class="text-sm text-green-600 mt-2">+8.3% this month</div>
                    </div>

                    <div
                        class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Revenue</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="text-purple-500">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600">$124,590</div>
                        <div class="text-sm text-green-600 mt-2">+15.2% this month</div>
                    </div>
                </section>

            </div>
            <div x-show="openSection === 'users'">
                <h2 class="text-3xl font-semibold mb-4">Users</h2>
                <input type="text" placeholder="Search Users..."
                    class="px-4 py-2 border border-gray-300 rounded-lg mb-4 w-full">
                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Recent Users</h3>
                        <a href="#" class="text-indigo-600 hover:underline text-sm">View All</a>
                    </div>
                    <div class="overflow-y-auto" style="max-height: 400px;">
                        <table class="w-full">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr class="bg-gray-100 text-gray-600 text-sm">
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Email</th>
                                    <th class="px-4 py-3 text-center">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b hover:bg-gray-50 transition-all">
                                        <td class="px-4 py-3">{{ $user->id }}</td>
                                        <td class="px-4 py-3">{{ $user->name }}</td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">{{ $user->role }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('admin.user.edit',['id' => $user->id]) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div x-show="openSection === 'products'">
                <h2 class="text-3xl font-semibold mb-4">Products</h2>
                <input type="text" placeholder="Search Products..."
                    class="px-4 py-2 border border-gray-300 rounded-lg mb-4 w-full">
                <!-- Products Table -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Recent Products</h3>
                        <a href="#" class="text-indigo-600 hover:underline text-sm">View All</a>
                    </div>
                    <div class="overflow-y-auto" style="max-height: 400px;">
                        <table class="w-full">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr class="bg-gray-100 text-gray-600 text-sm">
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Price</th>
                                    <th class="px-4 py-3 text-center">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="border-b hover:bg-gray-50 transition-all">
                                        <td class="px-4 py-3">{{ $product->product_id }}</td>
                                        <td class="px-4 py-3">{{ $product->product_name }}</td>
                                        <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                                                {{ $product->category->category_name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 flex justify-center space-x-4">
                                            <!-- Edit Button -->
                                            <a href="{{ route('product.edit.admin', ['product' => $product->product_id]) }}" 
                                                class="text-indigo-600 hover:underline">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('product.destory.admin', ['product' => $product->product_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
