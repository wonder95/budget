<?php

use App\Http\Controllers\PayPeriodController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/pay-periods', [PayPeriodController::class, 'index'])
        ->name('pay-periods.index');

    Route::post('/pay-periods/create', [PayPeriodController::class, 'store'])
        ->name('pay-periods.store');

    Route::put('/pay-periods/update/{payPeriod}', [PayPeriodController::class, 'update'])
        ->name('pay-periods.update');

    Route::get('/pay-periods/transactions/{payPeriod:start_date}', [PayPeriodController::class, 'transactions'])
        ->name('pay-periods.transactions');
});
