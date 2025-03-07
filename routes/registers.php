<?php
use App\Http\Controllers\RegistersController;
use Illuminate\Support\Facades\Route;

Route::get('/registers', [RegistersController::class, 'index'])
    ->name('registers.index')
    ->middleware(['auth']);
