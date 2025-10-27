<?php

use App\Http\Controllers\SpendingCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/spending-categories', [SpendingCategoryController::class, 'index'])
    ->name('spending-categories.index')
    ->middleware(['auth']);

Route::post('/spending-categories/create', [SpendingCategoryController::class, 'store'])
    ->name('spending-categories.store')
    ->middleware(['auth']);

Route::put('/spending-categories/update/{category}', [SpendingCategoryController::class, 'update'])
    ->name('spending-categories.update')
    ->middleware(['auth']);
