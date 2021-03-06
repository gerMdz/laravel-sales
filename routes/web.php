<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('products.carts', ProductCartController::class)->only(['store', 'destroy']);
Route::resource('carts', CartController::class)->only('index');
Route::resource('orders', OrderController::class)
    ->only(['create', 'store'])
    ->middleware(['verified']);
Route::resource('orders.payments', OrderPaymentController::class)
    ->only(['create', 'store'])
    ->middleware(['verified']);

Auth::routes([
    'verify' => true
]);

//Route::get('/home', [HomeController::class, 'index'])->name('home');
