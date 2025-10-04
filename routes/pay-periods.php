<?php

use App\Http\Controllers\PayPeriodController;
use Illuminate\Support\Facades\Route;

Route::get('/pay-periods', [PayPeriodController::class, 'index'])
    ->name('pay-periods.index')
    ->middleware(['auth']);
