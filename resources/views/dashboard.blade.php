<x-app-layout> 
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
        <div class="container mx-auto px-4 py-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Sidebar -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="text-center">
                        <img src="{{ asset($user->profile_url) }}"  
                        alt="{{ $user->name }}'s profile" 
                        class="w-32 h-32 rounded-full mx-auto mb-4 object-cover object-center bg-purple-200 border-4 border-purple-200 transform scale-125 translate-y-2">
                                           <h2 class="text-2xl font-bold text-purple-800">{{$user->name}}</h2>
                        <p class="text-purple-600">Shopedia</p>
                    </div>
    
                    <div class="mt-6 space-y-4">
                        <a href="#" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            My Orders
                        </a>
                        @if (Auth::user()->roles == 'Buyer')
                        <a href="#" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            Wishlist
                        </a>
                        @else
                        <a href="{{route('store.index')}}" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            Edit Store
                        </a>
                        @endif
                        @if (Auth::user()->roles == 'Buyer')
                        <a href="#" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            My Cart
                        </a>
                        @else
                        <a href="{{route('store.index')}}" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            My Store
                        </a>
                        @endif

                        <a href="{{route('Home')}}" class="block px-4 py-3 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition">
                            Go Back Shopping
                        </a>
                    </div>
                </div>
    
                <!-- Main Content Area -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Recent Orders -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-800 mb-4">Recent Orders</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between bg-purple-50 p-4 rounded-lg">
                                <div>
                                    <p class="font-semibold text-purple-800">#12345</p>
                                    <p class="text-sm text-purple-600">3 Items | Placed on May 15, 2024</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Delivered</span>
                                    <a href="#" class="text-purple-600 hover:text-purple-800">View Details</a>
                                </div>
                            </div>
                            <div class="flex items-center justify-between bg-purple-50 p-4 rounded-lg">
                                <div>
                                    <p class="font-semibold text-purple-800">#12346</p>
                                    <p class="text-sm text-purple-600">2 Items | Placed on April 22, 2024</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Processing</span>
                                    <a href="#" class="text-purple-600 hover:text-purple-800">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Account Summary -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-800 mb-4">Account Summary</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <p class="text-purple-600">Total Spent</p>
                                <p class="text-2xl font-bold text-purple-800">$2,345</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <p class="text-purple-600">Loyalty Points</p>
                                <p class="text-2xl font-bold text-purple-800">1,250</p>
                            </div>
                        </div>
                    </div>
    
                    <!-- Recommended Products -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-800 mb-4">Recommended For You</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-purple-50 p-4 rounded-lg text-center">
                                <img src="/api/placeholder/150/150" alt="Product" class="w-full mb-2 rounded">
                                <p class="font-semibold text-purple-800">Summer Dress</p>
                                <p class="text-purple-600">$79.99</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg text-center">
                                <img src="/api/placeholder/150/150" alt="Product" class="w-full mb-2 rounded">
                                <p class="font-semibold text-purple-800">Leather Bag</p>
                                <p class="text-purple-600">$129.99</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg text-center">
                                <img src="/api/placeholder/150/150" alt="Product" class="w-full mb-2 rounded">
                                <p class="font-semibold text-purple-800">Sports Shoes</p>
                                <p class="text-purple-600">$89.99</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>