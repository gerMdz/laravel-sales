<?php

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

Route::get('products',[ProductController::class, 'index'])->name('products.index');

Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::match(['put', 'patch'],'products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
