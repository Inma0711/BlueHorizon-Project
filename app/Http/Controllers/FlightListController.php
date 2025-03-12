<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            'date' => 'required|date',
            'departure_location' => 'required|string|max:255',
            'arrival_location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Flight::create($validated);

        return redirect()->route('createFlight')->with('success', 'Vuelo creado con éxito');
    }
    public function edit(Request $request)
    {
        $flight = null;
        if ($request->has('search_id')) {
            $flight = Flight::find($request->input('search_id'));

            if (!$flight) {
                return redirect()->route('editFlight')->with('error', 'Vuelo no encontrado');
            }
        }
        $planes = Plane::all();
        return view('editFlight', compact('flight', 'planes'));
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);
        if (!$flight) {
            return redirect()->route('editFlight')->with('error', 'Debe buscar un ID válido antes de editar.');
        }

        $validated = $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'date' => 'required|date',
            'departure_location' => 'required|string|max:255',
            'arrival_location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $flight->update($validated);

        return redirect()->route('editFlight')->with('success', 'Vuelo actualizado con éxito');
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
    /*
   
    public function destroy(string $id)
    {
        //
    }
        */
}
