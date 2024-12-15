<?php
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');


Route::get('/dashboard', function () {
    $user = Auth::user();
    $query = Order::where('user_id', Auth::user()->id);
    $totalSpent = Order::where('user_id', Auth::user()->id)->sum('total');
    $recomended = Product::inRandomOrder()->take(3)->get();;
    $orders = $query->orderBy('created_at', 'desc')->take(3)->get();
    return view('dashboard', compact(['user','orders','totalSpent','recomended']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/picture', [ProfileController::class, 'updatePicture'])
        ->name('profile.update-picture');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cart', CartController::class);
    Route::patch('/cart/increment/{cartDetail}', [CartController::class, 'incrementItem'])->name('cart.incrementItem');
    Route::patch('/cart/decrement/{cartDetail}', [CartController::class, 'decrementItem'])->name('cart.decrementItem');
    Route::delete('/cart/remove/{cartDetail}', [CartController::class, 'removeItem'])->name('cart.removeItem');
    Route::resource('wishlist', WishlistController::class);
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders', [OrderController::class, 'index'])->name('order.show.buyer');
    Route::patch('/orders/{order}/deliver/{storeId}', [CartController::class, 'markAsDelivered'])
    ->name('orders.deliver');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    
});





require __DIR__ . '/auth.php';
