<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // return $request->user();
    $results = $request->user();

    // Dapatkan semua permissions
    $permissons = $request->user()->getPermissionsViaRoles();

    //collection permissions
    $results['user_permissions'] = collect($permissons)->pluck('name');

    unset($results->roles);

    return $results;
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
        'posts'             => PostsController::class,
        'terms'             => TermsController::class,
        'products'          => ProductController::class,
        'product-category'  => ProductCategoryController::class,
        'product-brand'     => ProductBrandController::class,
        'product-type'      => ProductTypeController::class,
        'customer'          => CustomerController::class,
        'transaction'       => TransactionController::class
    ]);

    Route::get('/relay', [PriceListController::class, 'index']);
    Route::get('/customer/key/{id}', [CustomerController::class, 'get_key']);
    Route::post('/customer/generatekey/{id}', [CustomerController::class, 'generate_key']);
});

require __DIR__ . '/api-dash.php';
