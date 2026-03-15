<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ItemController;


Route::get('/', [ItemController::class, 'index'])->name('items.index');// おすすめ（全商品）
Route::get('/mylist', [ItemController::class, 'mylist'])->name('items.mylist'); // マイリスト（要ログイン）
Route::get('/items/{item}', [ItemController::class, 'show'])
    ->name('items.show');


Route::get('/purchase/{id}', [PurchaseController::class, 'show']);

Route::get('/stripe', [StripeController::class, 'index'])
    ->name('stripe.index');

Route::post('/stripe/charge', [StripeController::class, 'charge']);
Route::get('/stripe/success', [StripeController::class, 'success']);
