<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{

    public function indexAdmin()
    {
        $users = User::with('reservations.flight')->get();
        return view('reserveListAdmin', compact('users'));
    }

    public function store($flight_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar un vuelo.');
        }

        $existingReservation = Reservation::where('user_id', Auth::id())
                                          ->where('flight_id', $flight_id)
                                          ->first();

        if ($existingReservation) {
            return redirect()->back()->with('error', 'Ya tienes una reserva en este vuelo.');
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight_id
        ]);

        return redirect()->back()->with('success', '¡Reserva realizada con éxito!');
    }
    
    /*
    public function indexUser()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('flight')->get();
        return view('user_reservations.user_index', compact('reservations'));
    }
        */

    /*
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
        */
}
