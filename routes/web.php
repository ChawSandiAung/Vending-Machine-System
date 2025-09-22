<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProductsController::class, 'index'])->name('products.index');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('products/{product}/purchase', [ProductsController::class, 'purchaseForm'])->name('products.purchaseForm');
    Route::post('products/{product}/purchase', [ProductsController::class, 'purchase'])->name('products.purchase');

    Route::middleware('admin')->group(function () {
        Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('products', [ProductsController::class, 'store'])->name('products.store');
        Route::delete('products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
    });
});
