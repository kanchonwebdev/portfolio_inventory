<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
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

    /* order controller */
    Route::get('order/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('order/show/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('order/destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
});

/* product controller */
Route::get('product/all', [ProductController::class, 'all'])->name('shop.all');
Route::get('product/index', [ProductController::class, 'index'])->name('shop.index');
Route::get('product/show/{id}', [ProductController::class, 'show'])->name('shop.show');
Route::post('product/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('shop.addToCart');
Route::get('product/remove-from-cart/{id}', [ProductController::class, 'removeFromCart'])->name('shop.removeFromCart');
Route::get('product/view-cart', [ProductController::class, 'viewCart'])->name('shop.viewCart');
Route::get('product/clear-cart', [ProductController::class, 'clearCart'])->name('shop.clearCart');
Route::post('product/update-cart', [ProductController::class, 'updateCart'])->name('shop.updateCart');
Route::get('product/cart', [ProductController::class, 'cart'])->name('shop.cart');

/* checkout controller */
Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('product/checkout', [ProductController::class, 'checkout'])->middleware(['auth', 'verified'])->name('shop.checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
