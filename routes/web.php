<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth::routes();

Route::group(['prefix' => 'admin'], function ()
{
    Route::get('/', \App\Http\Controllers\Admin\IndexController::class)->name('admin.index');

    Route::group(['prefix' => 'categories'], function ()
    {
        Route::get('/', \App\Http\Controllers\Category\IndexController::class)->name('category.index');
        Route::get('/create', \App\Http\Controllers\Category\CreateController::class)->name('category.create');
        Route::post('/', \App\Http\Controllers\Category\StoreController::class)->name('category.store');
        Route::get('/{category}/edit', \App\Http\Controllers\Category\EditController::class)->name('category.edit');
        Route::get('/{category}', \App\Http\Controllers\Category\ShowController::class)->name('category.show');
        Route::patch('/{category}', \App\Http\Controllers\Category\UpdateController::class)->name('category.update');
        Route::delete('/{category}', \App\Http\Controllers\Category\DeleteController::class)->name('category.delete');
    });

    Route::group(['prefix' => 'sizes'], function ()
    {
        Route::get('/', \App\Http\Controllers\Size\IndexController::class)->name('size.index');
        Route::get('/create', \App\Http\Controllers\Size\CreateController::class)->name('size.create');
        Route::post('/', \App\Http\Controllers\Size\StoreController::class)->name('size.store');
        Route::get('/{size}/edit', \App\Http\Controllers\Size\EditController::class)->name('size.edit');
        Route::get('/{size}', \App\Http\Controllers\Size\ShowController::class)->name('size.show');
        Route::patch('/{size}', \App\Http\Controllers\Size\UpdateController::class)->name('size.update');
        Route::delete('/{size}', \App\Http\Controllers\Size\DeleteController::class)->name('size.delete');
    });

    Route::group(['prefix' => 'users'], function ()
    {
        Route::get('/', \App\Http\Controllers\User\IndexController::class)->name('user.index');
        Route::get('/create', \App\Http\Controllers\User\CreateController::class)->name('user.create');
        Route::post('/', \App\Http\Controllers\User\StoreController::class)->name('user.store');
        Route::get('/{user}/edit', \App\Http\Controllers\User\EditController::class)->name('user.edit');
        Route::get('/{user}', \App\Http\Controllers\User\ShowController::class)->name('user.show');
        Route::patch('/{user}', \App\Http\Controllers\User\UpdateController::class)->name('user.update');
        Route::delete('/{user}', \App\Http\Controllers\User\DeleteController::class)->name('user.delete');
    });

    Route::group(['prefix' => 'products'], function ()
    {
        Route::get('/', \App\Http\Controllers\Product\IndexController::class)->name('product.index');
        Route::get('/create', \App\Http\Controllers\Product\CreateController::class)->name('product.create');
        Route::post('/', \App\Http\Controllers\Product\StoreController::class)->name('product.store');
        Route::get('/{product}/edit', \App\Http\Controllers\Product\EditController::class)->name('product.edit');
        Route::get('/{product}', \App\Http\Controllers\Product\ShowController::class)->name('product.show');
        Route::patch('/{product}', \App\Http\Controllers\Product\UpdateController::class)->name('product.update');
        Route::delete('/{product}', \App\Http\Controllers\Product\DeleteController::class)->name('product.delete');
    });
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
