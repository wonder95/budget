<?php

use App\Http\Controllers\BudgetCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/budget-categories', [BudgetCategoryController::class, 'index'])
    ->name('budget-categories.index')
    ->middleware(['auth']);

