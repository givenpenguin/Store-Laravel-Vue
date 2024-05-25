<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', \App\Http\Controllers\API\Product\IndexController::class);
Route::get('/filters', \App\Http\Controllers\API\Product\FilterListController::class);
Route::get('/product/{product}', \App\Http\Controllers\API\Product\ShowController::class);

Route::post('/orders', \App\Http\Controllers\API\Order\StoreController::class);
