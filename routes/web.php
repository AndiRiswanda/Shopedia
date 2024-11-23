<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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
    Route::delete('/cart/{cartDetail}', [CartController::class, 'removeItem'])->name('cart.removeItem');

});





require __DIR__ . '/auth.php';
