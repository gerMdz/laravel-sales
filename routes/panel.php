<?php

use App\Http\Controllers\Panel\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
|
*/

Route::resource('products', ProductController::class);

