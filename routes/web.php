<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'home'])->name('welcome');

Route::get('/category/{categ}', [ProductController::class, 'showCategoryProduct'])->name('show-category-product');
Route::get('/category/{categ}/{slug}', [ProductController::class, 'showProduct'])->name('show-product');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'cartAdd'])->where('id', '[0-9]+')->name('cart-add');
Route::post('/cart/plus/{id}', [CartController::class, 'cartPlus'])->where('id', '[0-9]+')->name('cart-plus');
Route::post('/cart/minus/{id}', [CartController::class, 'cartMinus'])->where('id', '[0-9]+')->name('cart-minus');
Route::post('/cart/remove/{id}', [CartController::class, 'cartRemove'])->where('id', '[0-9]+')->name('cart-remove');

Route::get('/cart/checkout', [CartController::class, 'cartCheckout'])->name('cart-checkout');
Route::post('/cart/saveorder', [CartController::class, 'saveOrder'])->name('cart-saveorder');
Route::get('/cart/success', [CartController::class, 'cartSuccess'])->name('cart.success');

Route::group([
    'as' => 'user.', // имя маршрута, например user.index
    'prefix' => 'user', // префикс маршрута, например user/index
    'middleware' => ['auth'] // один или несколько посредников
], function () {
    Route::get('orders', [OrderController::class, 'orders'])->name('my-orders');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('show-order');
});

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group([
    'as' => 'admin.',
    'middleware' => 'auth',
    'prefix' => 'admin'
], function () {
    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/orders', [AdminController::class, 'adminOrders'])->name('admin-orders');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('product', AdminProductController::class);
        Route::resource('brand', AdminBrandController::class);
        Route::resource('order', AdminOrderController::class, ['except'=> [
            'create', 'store', 'destroy'
        ]]);
        Route::resource('user', AdminUserController::class, ['except' => [
            'create', 'store', 'show', 'destroy'
        ]]);

        Route::match(['get', 'post'], '/add-images/{id}', [AdminProductController::class, 'addImages']);
        Route::get('/delete-image/{id}', [AdminProductController::class, 'deleteImage']);
        Route::match(['get', 'post'], '/add-sizes/{id}', [AdminProductController::class, 'addSizes']);
        Route::post('/edit-sizes/{id}', [AdminProductController::class, 'editSizes']);
        Route::get('/delete-sizes/{id}', [AdminProductController::class, 'deleteSizes']);
        
    });

    

    Route::get('/account', [AccountController::class, 'account']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', [AccountController::class, 'account']);
});

