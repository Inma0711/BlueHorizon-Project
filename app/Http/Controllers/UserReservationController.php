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
        $users = User::with('reservations.flight')->get();
        return view('reserveListAdmin', compact('users'));
    }
    
    public function store($flight_id)
    {   
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar un vuelo.');
        }
    
        // Obtener el vuelo y el avión asociado
        $flight = Flight::findOrFail($flight_id);
        $plane = $flight->plane; 
    
        // Verificar si el avión existe
        if (!$plane) {
            return redirect()->back()->with('error', 'No se encontró un avión para este vuelo.');
        }
    
        // Verificar si hay asientos disponibles
        if ($plane->max_seats <= 0) {
            return redirect()->back()->with('error', 'No hay asientos disponibles en este vuelo.');
        }
    
        // Verificar si el usuario ya tiene una reserva en este vuelo
        $existingReservation = Reservation::where('user_id', Auth::id())
                                          ->where('flight_id', $flight_id)
                                          ->first();
    
        if ($existingReservation) {
            return redirect()->back()->with('error', 'Ya tienes una reserva en este vuelo.');
        }
    
        // Crear la reserva
        Reservation::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight_id
        ]);
    
        // Restar un asiento al avión y guardar el cambio
        $plane->max_seats -= 1;
        $plane->save();
    
        // Si ya no quedan asientos, cambiar el estado del vuelo a inhabilitado
        if ($plane->max_seats == 0) {
            $flight->status = false; // Suponiendo que status es un booleano (1 = activo, 0 = inhabilitado)
            $flight->save();
        }
    
        // 🔄 Redirigir de vuelta a la página actualizada con un mensaje de éxito
        return redirect()->back()->with('success', '¡Reserva realizada con éxito! Un asiento ha sido descontado.');
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
