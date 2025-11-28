<?php

use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/vendors', [VendorController::class, 'index'])
    ->name('vendors.index')
    ->middleware(['auth']);

Route::post('/vendors/create', [VendorController::class, 'store'])
    ->name('vendors.store')
    ->middleware(['auth']);
