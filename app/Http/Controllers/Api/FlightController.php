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
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'departure_location' => 'required|string|max:255',
            'arrival_location' => 'required|string|max:255',
            'available_seats' => 'required|integer|min:1',
        ]);

        $flight = Flight::create($validated);

        return response()->json($flight, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
