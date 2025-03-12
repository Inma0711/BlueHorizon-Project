<?php

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
Route::get('/flightList', [FlightListController::class, 'index'])->name('flightList');

Route::get('/listAircraftAdmin', [PlaneController::class, 'adminIndex'])->name('planeList');

Route::get('/createAircraft', [PlaneController::class, 'create'])->middleware('role:admin')->name('createAircraft');
Route::post('/createAircraft', [PlaneController::class, 'store']); 
Route::get('/editAircraft', [PlaneController::class, 'edit'])->name('editAircraft');  
Route::post('/searchAircraft', [PlaneController::class, 'search'])->name('searchAircraft');  
Route::put('/editAircraft/{id}', [PlaneController::class, 'update'])->name('updateAircraft'); 
Route::delete('/deleteAircraft/{id}', [PlaneController::class, 'destroy'])->name('deleteAircraft');


Route::get('/userReservation', [UserReservationController::class, 'indexAdmin'])->middleware('role:admin')->name('userReservation');
Route::get('/myReservations', [UserReservationController::class, 'indexUser'])->name('myReservations');