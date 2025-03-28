<?php

namespace App\Http\Controllers\Api;

use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{

    public function index()
    {
        $flights = Flight::with('plane')->get();
        return response()->json($flights, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'date' => 'required|date',
            'departure_location' => 'required|string|max:255',
            'arrival_location' => 'required|string|max:255',
            'price' => 'required|integer|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $validated['status'] = $validated['status'] ?? 0;

        $flight = Flight::create($validated);

        return response()->json($flight, 201);
    }

    public function show(string $id)
    {
        $flight = Flight::with('plane')->find($id);

        if (!$flight) {
            return response()->json(['message' => 'Vuelo no encontrado'], 404);
        }

        return response()->json($flight, 200);
    }

    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Vuelo no encontrado'], 404);
        }

        $validated = $request->validate([
            'plane_id' => 'sometimes|exists:planes,id',
            'date' => 'sometimes|date',
            'departure_location' => 'sometimes|string|max:255',
            'arrival_location' => 'sometimes|string|max:255',
            'price' => 'sometimes|integer|max:255',
            'status' => 'sometimes|boolean'
        ]);

        $flight->update($validated);

        return response()->json($flight, 200);
    }

    public function destroy(string $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Vuelo no encontrado'], 404);
        }

        $flight->delete();

        return response()->json(['message' => 'Vuelo eliminado correctamente'], 200);
    }

    public function reserve(string $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Vuelo no encontrado'], 404);
        }

        $flight->reserve();

        return response()->json(['message' => 'Vuelo reservado correctamente', 'flight' => $flight], 200);
    }

    public function cancel(string $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Vuelo no encontrado'], 404);
        }

        $flight->cancel();

        return response()->json(['message' => 'Vuelo cancelado correctamente', 'flight' => $flight], 200);
    }
}