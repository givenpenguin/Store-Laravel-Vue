<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/products', \App\Http\Controllers\API\Product\IndexController::class);
Route::get('/admin/products/{product}', \App\Http\Controllers\API\Product\ShowController::class);
