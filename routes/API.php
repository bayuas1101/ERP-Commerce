<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;

/*
Public Route
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/*-
Autehenticate Routs
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', function (Illuminate\Http\Request $request) {
        return $request->user();
    });
});

/*
Admin Only Routers Admin dibuat melalaui seeder Admin
dan supplier dibuat oleh admin
*/
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {

    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);
});
