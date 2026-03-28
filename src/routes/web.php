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

// Stripe（既存）
Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');
Route::post('/stripe/charge', [StripeController::class, 'charge']);
Route::get('/stripe/success', [StripeController::class, 'success']);

// 商品出品画面
Route::middleware('auth')->group(function () {
    Route::get('/sell', [App\Http\Controllers\SellController::class, 'index'])->name('sell.index');
    Route::post('/sell', [App\Http\Controllers\SellController::class, 'store'])->name('sell.store');
});

// マイページ
Route::middleware('auth')->get('/mypage', [App\Http\Controllers\MypageController::class, 'index'])->name('mypage.index');

// プロフィール設定
Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('mypage.profile');
    Route::put('/mypage/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('mypage.profile.update');
});

// メール認証誘導画面
Route::get('/email/verify', fn() => view('auth.verify-email'));

//いいね//
Route::middleware('auth')->group(function () {
    Route::post('/items/{item}/like', [App\Http\Controllers\LikeController::class, 'toggle'])->name('items.like');
});

//コメント//
Route::middleware('auth')->group(function () {
    Route::post('/items/{item}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});