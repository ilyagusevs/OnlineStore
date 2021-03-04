<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('layouts.navbar-footer');
// });

Route::get('/', [HomeController::class, 'home']);

Route::get('/{categ}', [ProductController::class, 'showCategory'])->name('showCategory');

Route::get('/{categ}/{product_id}', [ProductController::class, 'show'])->name('showProduct');

Route::get('/cart', [CartController::class, 'cart']);   

Route::get('/account', [AccountController::class, 'account']);   

