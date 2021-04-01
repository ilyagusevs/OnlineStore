<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/category/{categ}', [ProductController::class, 'showCategory'])->name('showCategory');
Route::get('/category/{categ}/{alias}', [ProductController::class, 'showProduct'])->name('showProduct');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'cartAdd'])->where('id', '[0-9]+')->name('cart-add');
Route::post('/cart/plus/{id}', [CartController::class, 'cartPlus'])->where('id', '[0-9]+')->name('cart-plus');
Route::post('/cart/minus/{id}', [CartController::class, 'cartMinus'])->where('id', '[0-9]+')->name('cart-minus');
Route::post('/cart/remove/{id}', [CartController::class, 'cartRemove'])->where('id', '[0-9]+')->name('cart-remove');
Route::post('/cart/clear', [CartController::class, 'cartClear'])->name('cart-clear');

Route::get('/cart/checkout', [CartController::class, 'cartCheckout'])->name('cart-checkout');
Route::post('/cart/saveorder', [CartController::class, 'saveOrder'])->name('cart-saveorder');
Route::get('/cart/success', [CartController::class, 'cartSuccess'])->name('cart.success');

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/adminpanel/orders', [AdminController::class, 'adminOrders'])->name('admin-orders');
    });
    Route::get('/account', [AccountController::class, 'account']);
});
