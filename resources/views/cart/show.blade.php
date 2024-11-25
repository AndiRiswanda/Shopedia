<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Shopedia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .custom-shadow {
            box-shadow: 0 4px 30px rgba(167, 139, 250, 0.15);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        
        .purple-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .cart-item-hover {
            transition: all 0.3s ease;
        }
        
        .cart-item-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(167, 139, 250, 0.2);
        }
        
        .quantity-input {
            background: linear-gradient(to right, #f3f4f6, #ffffff);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="relative">
        <div class="bg-gradient-to-r from-purple-400 to-purple-900 h-40 md:h-48 flex items-center justify-center text-white">
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-position: center 82%; background-image: url('{{ asset('images/BackroundForBanner.jpg') }}');" >
            </div>
            <div>
                <h1 class="relative text-3xl md:text-4xl font-bold">Shopedia</h1>
                <h3 class="text-center">Your Best Shopping Partner</h3>
            </div>
        </div>
    </div>
    <!-- Main Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('Home') }}" class="flex items-center space-x-3">
                    <img src="{!! asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') !!}" alt="Shopedia Logo" class="h-10">
                    <div class="h-8 w-px bg-gray-200"></div>
                </a>
                <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-purple-800">
                    Shopping Cart
                </h1>
                <div class="w-20"></div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Cart Items Section -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl custom-shadow p-8">
                    <!-- Cart Items -->
                    @forelse($cart->cartDetails as $detail)
                    <div class="py-6 border-b border-gray-100 cart-item-hover rounded-xl my-4 p-4">
                        <div class="flex items-start space-x-6">
                            <img src="{{ $detail->product->productImages->first()->image_url ?? 'https://via.placeholder.com/120' }}" 
                                 alt="{{ $detail->product->product_name }}" 
                                 class="w-32 h-32 object-cover rounded-xl shadow-md">
                            <div class="flex-1">
                                <h3 class="text-xl font-medium text-gray-800 hover:text-purple-600 transition-colors">
                                    {{ $detail->product->product_name }}
                                </h3>
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-sm">
                                        {{ $detail->product->category->category_name }}
                                    </span>
                                </div>
                                <div class="mt-6 flex items-center justify-between">
                                    <div class="text-2xl font-semibold text-purple-600">
                                        RM {{ number_format($detail->product->price, 2) }}
                                    </div>
                                    <div class="flex items-center space-x-3 bg-gray-50 rounded-xl p-2">
                                        <form action="{{ route('cart.decrementItem', $detail->cart_detail_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition-all duration-200">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </form>
                                        
                                        <span class="w-16 text-center font-medium text-lg quantity-input rounded-lg py-2">
                                            {{ $detail->quantity }}
                                        </span>
                                        
                                        <form action="{{ route('cart.incrementItem', $detail->cart_detail_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition-all duration-200">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Actions -->
                            <div class="flex flex-col items-center space-y-3">
                                <form action="{{ route('cart.removeItem', $detail->cart_detail_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('product.show', $detail->product->product_id) }}" class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-400 hover:text-purple-600 hover:bg-purple-50 transition-all duration-200">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-16 text-center">
                        <div class="w-32 h-32 mx-auto mb-8 bg-purple-50 rounded-full flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-6xl text-purple-200"></i>
                        </div>
                        <h3 class="text-2xl font-medium text-gray-800 mb-3">Your cart is empty</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Looks like you haven't added anything to your cart yet. Explore our products and find something you love!
                        </p>
                        <a href="{{ route('Home') }}" 
                           class="inline-block px-8 py-4 purple-gradient text-white rounded-xl hover:opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Start Shopping
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl custom-shadow p-8 sticky top-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-8">Order Summary</h2>
                    
                    <!-- Price Details -->
                    <div class="space-y-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $cart->cartDetails->sum('quantity') }} items)</span>
                            <span class="font-medium">
                                RM {{ number_format($cart->cartDetails->sum(function($detail) {
                                    return $detail->quantity * $detail->product->price;
                                }), 2) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping Fee</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        
                      
                        
                        <!-- Total -->
                        <div class="pt-6 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-medium text-gray-800">Total</span>
                                <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-purple-800">
                                    RM {{ number_format($cart->cartDetails->sum(function($detail) {
                                        return $detail->quantity * $detail->product->price;
                                    }), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Checkout Button -->
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full mt-8 px-8 py-4 purple-gradient text-white rounded-xl hover:opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3 font-medium">
                            <span>Proceed to Checkout</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                    
                    <!-- Continue Shopping -->
                    <a href="{{ route('Home') }}" 
                       class="w-full mt-4 px-8 py-4 bg-white text-purple-600 border-2 border-purple-100 rounded-xl hover:border-purple-600 hover:bg-purple-50 transition-all duration-200 flex items-center justify-center space-x-3 font-medium">
                        <i class="fas fa-arrow-left"></i>
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>