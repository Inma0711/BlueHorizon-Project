<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightListController extends Controller
{

    public function index()
    {
        $flightLists = Flight::all();
        return view('flightList', compact('flightLists'));
    }

    public function create()
    {
        $planes = Plane::all();
        return view('createFlight', compact('planes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'date' => 'required|date|after_or_equal:today',
            'departure_location' => ['required', 'string', 'max:255', 'regex:/^[A-Z\s]+$/'],
            'arrival_location' => ['required', 'string', 'max:255', 'regex:/^[A-Z\s]+$/'],
            'price' => 'required|integer|min:0',
        ], [
            'date.after_or_equal' => 'No puedes crear un vuelo con fecha pasada.',
        ]);

        $validated['departure_location'] = strtoupper($validated['departure_location']);
        $validated['arrival_location'] = strtoupper($validated['arrival_location']);
        $validated['status'] = true;

        Flight::create($validated);

        return redirect()->route('flightList')->with('success', 'Vuelo creado con éxito');
    }


    public function edit(Request $request)
    {
        $flights = Flight::all();
        $planes = Plane::all();
        $selectedFlight = null;

        if ($request->has('search_id')) {
            $selectedFlight = Flight::find($request->input('search_id'));

            if (!$selectedFlight) {
                return redirect()->route('editFlight')->with('error', 'Vuelo no encontrado');
            }
        }

        return view('editFlight', compact('flights', 'planes', 'selectedFlight'));
    }


    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);
        if (!$flight) {
            return redirect()->route('editFlight')->with('error', 'Debe buscar un ID válido antes de editar.');
        }

        $validated = $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'date' => 'required|date|after_or_equal:today',
            'departure_location' => ['required', 'string', 'max:255', 'regex:/^[A-Z\s]+$/'],
            'arrival_location' => ['required', 'string', 'max:255', 'regex:/^[A-Z\s]+$/'],
            'price' => 'required|integer|min:0',
        ]);

        $flight->update($validated);

        return redirect()->route('flightList')->with('success', 'Vuelo actualizado con éxito');
    }

    public function search(Request $request)
    {
        $flight = null;
        if ($request->has('search_id')) {
            $flight = Flight::find($request->input('search_id'));
            if (!$flight) {
                return redirect()->route('editFlight')->with('error', 'Vuelo no encontrado');
            }
        }
        return view('editFlight', compact('flight'));
    }


    public function destroy($id)
    {
        $flight = Flight::find($id);

        if ($flight) {

            $flight->delete();

            $maxId = DB::table('flights')->max('id');

            DB::statement("ALTER TABLE flights AUTO_INCREMENT = " . ($maxId + 1));

            return redirect()->route('flightList')->with('success', 'Vuelo eliminado correctamente');
        } else {
            return redirect()->route('flightList')->with('error', 'Vuelo no encontrado');
        }
    }
}
