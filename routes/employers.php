<?php

use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

Route::get('/employers', [EmployerController::class, 'index'])
->name('employers.index')
->middleware(['auth']);

Route::post('/employers/create', [EmployerController::class, 'store'])
->name('employers.store')
->middleware(['auth']);

Route::put('/employers/update/{employer}', [EmployerController::class, 'update'])
->name('employers.update')
->middleware(['auth']);
