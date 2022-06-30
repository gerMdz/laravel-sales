<?php

use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\PanelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
|
*/
Route::get('/', [PanelController::class, 'index'])->name('panel');
Route::resource('products', ProductController::class);

