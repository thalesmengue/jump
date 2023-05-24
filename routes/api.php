<?php

use App\Http\Controllers\Api\ServiceOrdersController;
use Illuminate\Support\Facades\Route;

Route::post('/service-orders', [ServiceOrdersController::class, 'store'])->name('service-orders.store');
Route::get('/service-orders', [ServiceOrdersController::class, 'index'])->name('service-orders.index');
Route::get('/service-orders/{plate}/{perPage?}', [ServiceOrdersController::class, 'getByPlate'])->name('service-orders.getByPlate');
