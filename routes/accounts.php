<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/accounts', [AccountController::class, 'index'])
    ->name('accounts.index')
    ->middleware(['auth']);

Route::post('/accounts/create', [AccountController::class, 'store'])
    ->name('accounts.store')
    ->middleware(['auth']);

Route::post('/accounts/update/{account}', [AccountController::class, 'update'])
    ->name('accounts.update')
    ->middleware(['auth']);

Route::get('/accounts/{account:slug}/register', [AccountController::class, 'register'])
    ->name('accounts.register')
    ->middleware(['auth']);
