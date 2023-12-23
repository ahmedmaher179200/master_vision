<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/latest-products', [ProductController::class, 'latestProducts'])->name('latest-products');
Route::get('/category-details', [ProductController::class, 'categoryDetails'])->name('category-details');
Route::post('/order', [ProductController::class, 'order'])->name('order');

