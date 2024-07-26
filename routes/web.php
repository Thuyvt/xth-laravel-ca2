<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Product::query()->latest('id')->with('category')->limit(30)->get();
    return view('welcome',compact('products'));
});

// CHi tiết sản phẩm
Route::get('product/{slug}', [\App\Http\Controllers\ProductController::class, 'detail'])
    ->name('product.detail');

// Mua hàng
Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('cart/list', [\App\Http\Controllers\CartController::class, 'list'])->name('cart.list');
Route::post('order/add', [\App\Http\Controllers\CartController::class, 'add'])->name('order.add');

