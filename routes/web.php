<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElectricityBillController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/calculate-electricity-bill', [ElectricityBillController::class, 'calculateElectricityBill'])->name('calculateElectricityBill');
