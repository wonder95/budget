<?php
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/reports', [ReportsController::class, 'index'])
    ->name('reports.index')
    ->middleware(['auth']);
