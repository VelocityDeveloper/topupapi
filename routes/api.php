<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\CustomerController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::apiResources([
        'users' => UserController::class,
        'products' => ProductController::class,
        'product-category' => ProductCategoryController::class,
        'product-brand' => ProductBrandController::class,
        'product-type' => ProductTypeController::class,
        'customer' => CustomerController::class,
    ]);

    Route::get('/relay', [PriceListController::class, 'index']);
    Route::get('/customer/key/{id}', [CustomerController::class, 'get_key']);
    Route::post('/customer/generatekey/{id}', [CustomerController::class, 'generate_key']);
    Route::post('/users/password/{id}', [UserController::class, 'update_password']);
});
