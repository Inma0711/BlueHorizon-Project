<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\FlightListController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/flightlist', [FlightListController::class, 'index'])->name('flightList');
Route::get('/aircraftForm', [PlaneController::class, 'index'])->middleware('role:admin')->name('aircraftForm');

Route::get('/aircraftForm', [PlaneController::class, 'create'])->name('aircraftForm');
Route::post('/aircraftForm', [PlaneController::class, 'store']); 