<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('Home');

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
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
});





require __DIR__ . '/auth.php';
