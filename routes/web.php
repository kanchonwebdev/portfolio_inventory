<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'verified']], function () {
    /* tag controller */
    Route::get('tag/index', [TagController::class, 'index'])->name('tag.index');
    Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::post('tag/store', [TagController::class, 'store'])->name('tag.store');
    Route::get('tag/show/{id}', [TagController::class, 'show'])->name('tag.show');
    Route::get('tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
    Route::put('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
    Route::delete('tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');

    /* category controller */
    Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    /* shop controller */
    Route::get('shop/index', [ShopController::class, 'index'])->name('product.index');
    Route::get('shop/create', [ShopController::class, 'create'])->name('product.create');
    Route::post('shop/store', [ShopController::class, 'store'])->name('product.store');
    Route::get('shop/show/{id}', [ShopController::class, 'show'])->name('product.show');
    Route::get('shop/edit/{id}', [ShopController::class, 'edit'])->name('product.edit');
    Route::put('shop/update/{id}', [ShopController::class, 'update'])->name('product.update');
    Route::delete('shop/destroy/{id}', [ShopController::class, 'destroy'])->name('product.destroy');

    /* sale controller */
    Route::get('sale/index', [SaleController::class, 'index'])->name('sale.index');
    Route::get('sale/create', [SaleController::class, 'create'])->name('sale.create');
    Route::post('sale/store', [SaleController::class, 'store'])->name('sale.store');
    Route::get('sale/show/{id}', [SaleController::class, 'show'])->name('sale.show');
    Route::get('sale/edit/{id}', [SaleController::class, 'edit'])->name('sale.edit');
    Route::put('sale/update/{id}', [SaleController::class, 'update'])->name('sale.update');
    Route::delete('sale/destroy/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
