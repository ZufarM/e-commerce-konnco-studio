<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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


Auth::routes();

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('addDeliveryAddress', [HomeController::class, 'addDeliveryAddress'])->name('addDeliveryAddress');

Route::post('cart', [CartItemController::class, 'addToCart'])->name('cart.store');
Route::delete('remove/{id}', [CartItemController::class, 'removeCart'])->name('cart.remove');

Route::post('checkout', [OrderController::class, 'store'])->name('checkout');
Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('order/{order_id}', [OrderController::class, 'show'])->name('order');
