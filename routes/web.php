<?php

use App\Http\Controllers\AccountController;
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

Route::get('/', [HomeController::class, 'home']);

Route::get('/category/{categ}', [ProductController::class, 'showCategory'])->name('showCategory');

Route::get('/category/{categ}/{title}', [ProductController::class, 'showProduct'])->name('showProduct');

Route::get('/cart', [CartController::class, 'cart']);

Route::get('/account', [AccountController::class, 'account']);

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

