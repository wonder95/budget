<?php

use App\Http\Controllers\PayPeriodController;
use Illuminate\Support\Facades\Route;

Route::get('/pay-periods', [PayPeriodController::class, 'index'])
    ->name('pay-periods.index')
    ->middleware(['auth']);

Route::post('/pay-periods/create', [PayPeriodController::class, 'store'])
    ->name('pay-periods.store')
    ->middleware(['auth']);

Route::put('/pay-periods/update/{payPeriod}', [PayPeriodController::class, 'update'])
    ->name('pay-periods.update')
    ->middleware(['auth']);
