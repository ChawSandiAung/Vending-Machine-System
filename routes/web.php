<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;

// Public route
Route::get('/', [ProductsController::class, 'index'])->name('products.index');

// Guest routes (login & register)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Product purchase
    Route::get('products/{product}/purchase', [ProductsController::class, 'purchaseForm'])->name('products.purchaseForm');
    Route::post('products/{product}/purchase', [ProductsController::class, 'purchase'])->name('products.purchase');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('products', [ProductsController::class, 'store'])->name('products.store');
        Route::delete('products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
    });
});
