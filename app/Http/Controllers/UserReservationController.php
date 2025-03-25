<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{

    public function indexAdmin()
    {
        $users = User::with(['reservations.flight', 'activeReservations.flight'])->get();

        return view('reserveListAdmin', compact('users'));
    }


    public function store($flight_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar un vuelo.');
        }

        $flight = Flight::findOrFail($flight_id);
        $plane = $flight->plane;

        if (!$plane) {
            return redirect()->back()->with('error', 'No se encontró un avión para este vuelo.');
        }

        if ($plane->max_seats <= 0) {
            return redirect()->back()->with('error', 'No hay asientos disponibles en este vuelo.');
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

        $plane->max_seats -= 1;

        if ($plane->max_seats == 0) {
            $plane->delete();
        } else {
            $plane->save();
        }

        return redirect()->back()->with('success', '¡Reserva realizada con éxito!');
    }

    public function indexUser()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus reservas.');
        }

        $user = Auth::user();

        $futureReservations = $user->activeReservations()->with('flight.plane')->get();
        $pastReservations = $user->pastReservations()->with('flight.plane')->get();

        return view('myReservations', compact('futureReservations', 'pastReservations'));
    }

    public function activeReservationsIndex()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->route('dashboard')->with('error', 'No tienes reservas activas.');
        }

        $activeReservations = $user->activeReservations()->with('flight')->get();

        return view('activeReservations', compact('activeReservations'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $flight = $reservation->flight;

        if ($flight && $flight->plane) {

            $flight->plane->increment('max_seats');
        }

        $reservation->delete();

        return response()->json(['success' => 'Reservation deleted successfully']);
    }
}
