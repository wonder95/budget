<?php

use App\Http\Controllers\SpendingCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/spending-categories', [SpendingCategoryController::class, 'index'])
    ->name('spending-categories.index')
    ->middleware(['auth']);

