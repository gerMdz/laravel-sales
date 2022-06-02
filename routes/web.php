<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;

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

Route::resource('products', ProductController::class);
Route::resource('products.carts', ProductCartController::class)->only(['store', 'destroy']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
