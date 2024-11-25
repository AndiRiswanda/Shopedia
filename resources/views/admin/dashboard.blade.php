<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-900 font-inter antialiased">
    <div class="flex min-h-screen" x-data="{ openSection: 'dashboard' }">
        <!-- Sidebar -->
        <div class="w-72 bg-white shadow-xl border-r border-gray-100 fixed left-0 top-0 bottom-0 z-40">
            <div class="px-6 py-8">
                <h1 class="text-3xl font-bold text-purple-600 mb-8">Admin Dashboard</h1>
                <nav class="space-y-2">
                    <a href="#" @click="openSection = 'dashboard'" :class="{ 'bg-purple-50': openSection === 'dashboard' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-3 text-purple-500 group-hover:text-purple-600">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="#" @click="openSection = 'users'" :class="{ 'bg-purple-50': openSection === 'users' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-3 text-purple-500 group-hover:text-purple-600">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Users
                    </a>
                    <a href="#" @click="openSection = 'products'" :class="{ 'bg-purple-50': openSection === 'products' }"
                        class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 rounded-lg transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mr-3 text-purple-500 group-hover:text-purple-600">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Products
                    </a>
                    <a href=""><form method="POST" action="{{ route('logout') }}" class="mt-auto pt-4">
                        @csrf
                        <button type="submit" 
                            class="flex w-full items-center px-4 py-3 text-gray-700 hover:bg-red-50 rounded-lg transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="mr-3 text-red-500 group-hover:text-red-600">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Logout
                        </button>
                    </form></a>
                </nav>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 ml-72 p-6">
            <div x-show="openSection === 'dashboard'">
                <h2 class="text-3xl font-semibold mb-4">Dashboard</h2>
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-purple-500">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600">{{ $users->count() }}</div>
                        <div class="text-sm text-green-600 mt-2">+12.5% this month</div>
                    </div>
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Revenue</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-purple-500">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600">${{ number_format($revenue, 2) }}</div>
                        <div class="text-sm text-green-600 mt-2">+15.2% this month</div>
                    </div>
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">New Orders</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-purple-500">
                                <path d="M3 3h18v18H3z" />
                                <path d="M3 9h18" />
                                <path d="M9 21V9" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600">{{ $newOrders }}</div>
                        <div class="text-sm text-green-600 mt-2">+8.3% this month</div>
                    </div>
                </section>

                <!-- Charts Section -->
                <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">User Growth</h3>
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Revenue Trends</h3>
                        <canvas id="revenueTrendsChart"></canvas>
                    </div>
                </section>
            </div>

            <div x-show="openSection === 'users'">
                <h2 class="text-3xl font-semibold mb-4">Users</h2>
                <form id="userSearchForm" class="flex gap-2 mb-4">
                    <div class="relative flex-1">
                        <input type="text" id="userSearch" placeholder="Search Users..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </form>
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
                <form id="productSearchForm" class="flex gap-2 mb-4">
                    <div class="relative flex-1">
                        <input type="text" id="productSearch" placeholder="Search Products..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </form>
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

    <!-- Chart.js Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // User Growth Chart
            var ctx1 = document.getElementById('userGrowthChart').getContext('2d');
            var userGrowthChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Users',
                        data: [120, 190, 300, 500, 200, 300],
                        backgroundColor: 'rgba(139, 92, 246, 0.2)',
                        borderColor: 'rgba(139, 92, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Revenue Trends Chart
            var ctx2 = document.getElementById('revenueTrendsChart').getContext('2d');
            var revenueTrendsChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Revenue',
                        data: [3000, 4000, 3200, 5000, 4200, 5300],
                        backgroundColor: 'rgba(139, 92, 246, 0.2)',
                        borderColor: 'rgba(139, 92, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function performSearch() {
            const searchQuery = document.getElementById('userSearch').value.toLowerCase();
            const userRows = document.querySelectorAll('table tbody tr');
            
            userRows.forEach(row => {
                const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const userEmail = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const userRole = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                
                const showRow = userName.includes(searchQuery) || 
                               userEmail.includes(searchQuery) || 
                               userRole.includes(searchQuery);
                
                row.style.display = showRow ? '' : 'none';
            });
        }
    
        // Handle form submission
        document.getElementById('userSearchForm').addEventListener('submit', (e) => {
            e.preventDefault();
            performSearch();
        });
    
        // Real-time search as typing (optional)
        document.getElementById('userSearch').addEventListener('keyup', performSearch);

        function performUserSearch() {
            const searchQuery = document.getElementById('userSearch').value.toLowerCase();
            const userRows = document.querySelectorAll('table tbody tr');
            
            userRows.forEach(row => {
                const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const userEmail = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const userRole = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                
                const showRow = userName.includes(searchQuery) || 
                               userEmail.includes(searchQuery) || 
                               userRole.includes(searchQuery);
                
                row.style.display = showRow ? '' : 'none';
            });
        }

        function performProductSearch() {
            const searchQuery = document.getElementById('productSearch').value.toLowerCase();
            const productRows = document.querySelectorAll('table tbody tr');
            
            productRows.forEach(row => {
                const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const productCategory = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                
                const showRow = productName.includes(searchQuery) || 
                               productCategory.includes(searchQuery);
                
                row.style.display = showRow ? '' : 'none';
            });
        }

        // Real-time search as typing for user search
        document.getElementById('userSearch').addEventListener('keyup', performUserSearch);

        // Real-time search as typing for product search
        document.getElementById('productSearch').addEventListener('keyup', performProductSearch);
    </script>
</body>

</html>
