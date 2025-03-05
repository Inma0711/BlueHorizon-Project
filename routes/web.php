<?php

use App\Http\Controllers\AircraftListAdminController;
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
Route::get('/createAircraft', [PlaneController::class, 'index'])->middleware('role:admin')->name('createAircraft');
Route::get('/listAircraftAdmin', [AircraftListAdminController::class, 'index'])->middleware('role:admin')->name('listAircraftAdmin');

Route::get('/createAircraft', [PlaneController::class, 'create'])->name('createAircraft');
Route::post('/createAircraft', [PlaneController::class, 'store']); 