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
    Route::get('/planes', [PlaneController::class, 'index'])->name('planesIndex'); 
    Route::get('/planes/{id}', [PlaneController::class, 'show'])->name('planesShow'); 
    Route::put('/planes/{id}', [PlaneController::class, 'update'])->name('planesUpdate'); 
    Route::delete('/planes/{id}', [PlaneController::class, 'destroy'])->name('planesDestroy');

