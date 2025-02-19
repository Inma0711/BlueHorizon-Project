<?php

namespace App\Http\Controllers\Api;

use App\Models\Plane;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaneController extends Controller
{

    public function index()
    {
        return response()->json(Plane::all(), 200);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:planes',
            'max_seats' => 'required|integer|min:1'
        ]);

        $plane = Plane::create($request->all());
        return response()->json($plane, 201);
    }


    public function show(string $id)
    {
        $plane = Plane::find($id);
        if (!$plane) {
            return response()->json(['message' => 'Avión no encontrado'], 404);
        }
        return response()->json($plane, 200);
    }


    public function update(Request $request, string $id)
    {
        $plane = Plane::find($id);
        if (!$plane) {
            return response()->json(['message' => 'Avión no encontrado'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|unique:planes,name,' . $id,
            'max_seats' => 'sometimes|integer|min:1'
        ]);

        $plane->update($request->all());
        return response()->json($plane, 200);
    }


    public function destroy(string $id)
    {
        $plane = Plane::find($id);
        if (!$plane) {
            return response()->json(['message' => 'Avión no encontrado'], 404);
        }

        $plane->delete();
        return response()->noContent();
    }
}
