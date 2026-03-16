<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/mylist', [ItemController::class, 'mylist'])->name('items.mylist');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

// 商品購入画面
Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');

// 購入実行（ログイン必須）
Route::post('/purchase/{id}', [PurchaseController::class, 'store'])
    ->name('purchase.store')
    ->middleware('auth');

// 住所変更画面（ログイン必須）
Route::get('/purchase/{id}/address', [PurchaseController::class, 'addressEdit'])
    ->name('purchase.address.edit')
    ->middleware('auth');

Route::post('/purchase/{id}/address', [PurchaseController::class, 'addressUpdate'])
    ->name('purchase.address.update')
    ->middleware('auth');

Route::post('/items/{item}/comments', [App\Http\Controllers\CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

// Stripe（既存）
Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');
Route::post('/stripe/charge', [StripeController::class, 'charge']);
Route::get('/stripe/success', [StripeController::class, 'success']);
