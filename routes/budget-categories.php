<?php

use App\Http\Controllers\BudgetCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/budget-categories', [BudgetCategoryController::class, 'index'])
    ->name('budget-categories.index')
    ->middleware(['auth']);

Route::post('/budget-categories/create', [BudgetCategoryController::class, 'store'])
    ->name('budget-categories.store')
    ->middleware(['auth']);

Route::post('/budget-categories/update/{category}', [BudgetCategoryController::class, 'update'])
    ->name('budget-categories.update')
    ->middleware(['auth']);
