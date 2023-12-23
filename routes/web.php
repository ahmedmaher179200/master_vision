<?php

use App\Http\Controllers\Controller;
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
Route::get('/', [Controller::class, 'products']);
Route::get('/cart', [Controller::class, 'cart'])->name('cart');
Route::post('/checkout', [Controller::class, 'checkout'])->name('checkout');


Route::post('/add-product-to-cart-ajax', [Controller::class, 'addProductToCartAjax'])->name('addProductToCartAjax');

