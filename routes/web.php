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
Route::get('/flightList', [FlightListController::class, 'index'])->name('flightList');

Route::get('/listAircraftAdmin', [PlaneController::class, 'adminIndex'])->name('planeList');

Route::get('/createAircraft', [PlaneController::class, 'create'])->middleware('role:admin')->name('createAircraft');
Route::post('/createAircraft', [PlaneController::class, 'store']); 
Route::get('/editAircraft', [PlaneController::class, 'edit'])->name('editAircraft');  
Route::post('/searchAircraft', [PlaneController::class, 'search'])->name('searchAircraft');  
Route::put('/editAircraft/{id}', [PlaneController::class, 'update'])->name('updateAircraft'); 
