<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkout', [CheckoutController::class, 'realizarCheckout']);
Route::post('/payment/webhook', [CheckoutController::class, 'listener'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
