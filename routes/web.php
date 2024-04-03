<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalculatorController;



Route::group([], function () {
    Route::get('/', [CalculatorController::class, 'index'])->name('index');
    Route::post('/calculate', [CalculatorController::class, 'calculate'])->name('calculate');
});

