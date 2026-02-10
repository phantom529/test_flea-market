<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;

Route::get('/purchase/{id}', [PurchaseController::class, 'show']);

Route::get('/stripe', [StripeController::class, 'index'])
    ->name('stripe.index');

Route::post('/stripe/charge', [StripeController::class, 'charge']);
Route::get('/stripe/success', [StripeController::class, 'success']);

Route::get('/purchase', function () {
    return 'purchase top';
});

