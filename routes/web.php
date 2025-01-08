<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
Route::redirect('/', '/home', 301);

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', RoleCheck::class.':admin'])->name('dashboard');

Route::middleware(['auth', RoleCheck::class.':admin'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    // Route::patch('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::middleware(['auth', RoleCheck::class.':admin,user'])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::post('/payment/{cartId}/create', [PaymentController::class, 'createPayment'])->name('payment.create');
});

require __DIR__.'/auth.php';
