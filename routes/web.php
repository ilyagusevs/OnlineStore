<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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
Route::post('/cart/add/{id}', [CartController::class, 'cartAdd'])->name('cart-add');
Route::post('/cart/plus/{id}', [CartController::class, 'cartPlus'])->name('cart-plus');
Route::post('/cart/minus/{id}', [CartController::class, 'cartMinus'])->name('cart-minus');
Route::post('/cart/remove/{id}', [CartController::class, 'cartRemove'])->name('cart-remove');

Route::get('/cart/checkout', [CartController::class, 'cartCheckout'])->name('cart-checkout');
Route::post('/cart/saveorder', [CartController::class, 'saveOrder'])->name('cart-saveorder');

Route::get('search', [ProductController::class, 'search'])->name('search');

Route::group([
    'as' => 'user.', 
    'prefix' => 'user', 
    'middleware' => ['auth'] 
], function () {
    Route::get('orders', [OrderController::class, 'orders'])->name('my-orders');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('show-order');

    Route::get('dashboard',[UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
	Route::put('/update-profile',[UserController::class, 'updateProfile'])->name('update-profile');
    Route::get('/change-password',[UserController::class, 'changePassword'])->name('change-password');
	Route::post('/update-password',[UserController::class, 'updatePassword'])->name('update-password');
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
        Route::resource('category', AdminCategoryController::class);
        Route::resource('product', AdminProductController::class);
        Route::get('product/category/{category}', [AdminProductController::class, 'category'])->name('product.category');
        Route::resource('brand', AdminBrandController::class);
        Route::resource('order', AdminOrderController::class, ['except'=> [
            'create', 'store', 'edit', 'update', 'destroy'
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
});

