<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProductController;

Route::get('products', [ApiProductController::class, 'index']);
Route::get('products/{product}', [ApiProductController::class, 'show']);
Route::delete('products/{product}', [ApiProductController::class, 'destroy']);
