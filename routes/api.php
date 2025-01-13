<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PriceListController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-category', ProductCategoryController::class);
    Route::apiResource('product-brand', ProductBrandController::class);
    Route::apiResource('product-type', ProductTypeController::class);
});

Route::get('/relay', [PriceListController::class, 'index']);
