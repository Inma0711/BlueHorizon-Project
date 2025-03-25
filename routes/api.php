<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaneController;
use App\Http\Controllers\Api\FlightController;

Route::get('/planes', [PlaneController::class, 'index'])->name('planeIndex'); 
Route::post('/planes', [PlaneController::class, 'store'])->name('planeStore'); 

Route::get('/planes/{id}', [PlaneController::class, 'show'])->name('planeShow'); 
Route::put('/planes/{id}', [PlaneController::class, 'update'])->name('planeUpdate'); 
Route::delete('/planes/{id}', [PlaneController::class, 'destroy'])->name('planeDelete');

Route::post('/flights', [FlightController::class, 'store'])->name('flightStore'); 
Route::get('/flights', [FlightController::class, 'index'])->name('flightIndex'); 
Route::get('/flights/{id}', [FlightController::class, 'show'])->name('flightShow'); 
Route::put('/flights/{id}', [FlightController::class, 'update'])->name('flightUpdate'); 
Route::delete('/flights/{id}', [FlightController::class, 'destroy'])->name('flightDelete');
