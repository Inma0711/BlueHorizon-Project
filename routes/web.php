<?php

use App\Models\Flight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\FlightListController;
use App\Http\Controllers\UserReservationController;
use App\Http\Controllers\AircraftListAdminController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->get('/createAircraft', [PlaneController::class, 'index'])->name('createAircraft');
Route::middleware('auth')->post('/storeAircraft', [PlaneController::class, 'store'])->name('storeAircraft');
Route::get('/editAircraft', [PlaneController::class, 'edit'])->name('editAircraft');  
Route::post('/searchAircraft', [PlaneController::class, 'search'])->name('searchAircraft');  
Route::put('/editAircraft/{id}', [PlaneController::class, 'update'])->name('updateAircraft'); 
Route::delete('/deleteAircraft/{id}', [PlaneController::class, 'destroy'])->name('deleteAircraft');
Route::get('/listAircraft', [PlaneController::class, 'adminIndex'])->name('planeList');

Route::get('/userReservation', [UserReservationController::class, 'indexAdmin'])->middleware('role:admin')->name('userReservation');
Route::get('/myReservations', [UserReservationController::class, 'indexUser'])->name('myReservations');
Route::middleware('auth')->get('/listAircraftAdmin', [PlaneController::class, 'adminIndex'])->name('listAircraftAdmin');
Route::post('/reserve-flight/{flight}', [UserReservationController::class, 'store'])->name('reserveFlight');
Route::get('/myReservations', [UserReservationController::class, 'indexUser'])->name('myReservations');
Route::delete('/reservations/{id}', [UserReservationController::class, 'destroy'])->name('reservationsDestroy');
Route::get('/userReservation', [UserReservationController::class, 'indexAdmin'])->middleware('role:admin')->name('userReservation');

Route::get('/flightList', [FlightListController::class, 'index'])->name('flightList');
Route::get('/createFlight', [FlightListController::class, 'create'])->middleware('role:admin')->name('createFlight');
Route::post('/createFlight', [FlightListController::class, 'store']); 
Route::get('/editFlight', [FlightListController::class, 'edit'])->name('editFlight');  
Route::post('/searchFlight', [FlightListController::class, 'search'])->name('searchFlight');  
Route::put('/editFlight/{id}', [FlightListController::class, 'update'])->name('updateFlight'); 
Route::delete('/deleteFlight/{id}', [FlightListController::class, 'destroy'])->name('deleteFlight');

