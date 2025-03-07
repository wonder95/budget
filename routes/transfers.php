<?php

use App\Http\Controllers\TransferController;

Route::get('/transfers', [TransferController::class, 'index'])
    ->name('transfers.index')
    ->middleware(['auth']);
