<?php

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Apply Sanctum's Authentication Middleware
Route::middleware([
    EnsureFrontendRequestsAreStateful::class, // 👈 Sanctum Middleware
    'auth:sanctum'
])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Secure Product and Category Routes
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/categories', CategoryController::class);
});
