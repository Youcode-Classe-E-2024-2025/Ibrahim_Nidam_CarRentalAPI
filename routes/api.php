<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/cars', CarController::class);
    Route::post('/rentals', [RentalController::class, 'store']);
    Route::get('/rentals/success', [RentalController::class, 'success'])->name('rentals.success');
    Route::get('/rentals/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');
});
