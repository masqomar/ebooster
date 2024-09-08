<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/aff/register', [\App\Http\Controllers\Affiliate\RegisterController::class, 'index'])->name('affiliate.register');
    Route::post('/aff/store', [\App\Http\Controllers\Affiliate\RegisterController::class, 'store'])->name('affiliate.register.store');
    Route::get('/my-commissions', [\App\Http\Controllers\Affiliate\CommissionController::class, 'index'])->name('affiliate.commission.index');
});

// Route Affiliator
Route::domain('{tenant:subdomain}.' . config('app.url'))->name('subdomain.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Subdomain\IndexController::class, 'index'])->name('index');
    Route::get('/join/{id}', [\App\Http\Controllers\Subdomain\IndexController::class, 'registerByAff'])->name('registerByAff');
    Route::post('/check-coupon-code', [\App\Http\Controllers\Subdomain\IndexController::class, 'checkingCoupon'])->name('coupon');
    Route::post('/join/store', [\App\Http\Controllers\Subdomain\IndexController::class, 'store'])->name('registerByAff.store');
    Route::get('/payment/{id}/down-payment', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'payment'])->name('down-payment');
    Route::get('/payment-success/{id}/down-payment', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'downPaymentSuccess'])->name('down-payment-success');
    Route::get('/payment/{id}/full-payment', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'fullPayment'])->name('fullPayment');
    Route::post('/full-payment/store', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'fullPaymentStore'])->name('fullPaymentStore');
    Route::get('/payment/{id}/full-payment-detail', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'fullPaymentDetail'])->name('fullPaymentDetail');
    Route::get('/payment-success/{id}/full-payment', [\App\Http\Controllers\Subdomain\OfflinePaymentController::class, 'fullPaymentSuccess'])->name('full-payment-success');
});

// Midtrans Callback
Route::post('payment/callback', [\App\Http\Controllers\MidtransCallbackController::class, 'midtransCallback']);

Route::get('/', function () {
    return view('welcome');
});
