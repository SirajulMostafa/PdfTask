<?php

use App\Http\Controllers\FileController;

Route::get('file', [FileController::class, 'index'])->name('file');
Route::post('file', [FileController::class, 'store'])->name('file.store');

