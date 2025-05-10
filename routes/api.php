<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/new-arrivals', [App\Http\Controllers\Api\ProductController::class, 'getNewArrivals']);
Route::get('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/recommended-products', [App\Http\Controllers\Api\ProductController::class, 'getRecommendedProducts']);
Route::get('/recommended-products/all', [App\Http\Controllers\Api\ProductController::class, 'getAllRecommendedProducts']);
Route::get('/high-discount-products', [App\Http\Controllers\Api\ProductController::class, 'getHighDiscountProducts']);
Route::get('/best-seller-products', [App\Http\Controllers\Api\ProductController::class, 'getBestSellerProducts']);
Route::get('/featured-products', [App\Http\Controllers\Api\ProductController::class, 'getFeaturedProducts']);

