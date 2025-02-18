<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaneController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

//Route::middleware('auth:sanctum')->group(function () {});
    Route::post('/planes', [PlaneController::class, 'store'])->name('planesStore'); 
    Route::get('/planes', [PlaneController::class, 'index']); 
    Route::get('/planes/{id}', [PlaneController::class, 'show']); 
    Route::put('/planes/{id}', [PlaneController::class, 'update']); 
    Route::delete('/planes/{id}', [PlaneController::class, 'destroy']);

