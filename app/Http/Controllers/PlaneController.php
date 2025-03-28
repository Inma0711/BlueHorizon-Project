<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlaneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('createAircraft');
    }

    public function adminIndex()
    {
        $planes = Plane::all();
        return view('listAircraftAdmin', compact('planes'));
    }


    public function create()
    {
        return view('createAircraft');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_seats' => 'required|integer|min:1',
        ], [
            'max_seats' => 'No se puede poner un número negativo para los asientos',
        ]);

        Plane::create([
            'name' => $validated['name'],
            'max_seats' => $validated['max_seats'],
        ]);

        return redirect()->route('planeList')->with('success', 'Avión creado con éxito');
    }


    public function edit(Request $request)
    {
        $plane = null;
        
        if ($request->has('search_id')) {
            $plane = Plane::find($request->input('search_id'));
    
            if (!$plane) {
                return redirect()->route('editAircraft')->with('error', 'Avión no encontrado');
            }
        }
    
        $planes = Plane::all(); 
    
        return view('editAircraft', compact('plane', 'planes'));
    }
    


    public function search(Request $request)
    {
        $plane = null;

        if ($request->has('search_id')) {
            $searchId = $request->input('search_id');
            $plane = Plane::find($searchId);

            if (!$plane) {
                return redirect()->route('editAircraft')->with('error', 'Avión no encontrado');
            }
        }

        return view('editAircraft', compact('plane'));
    }


    public function update(Request $request, $id)
    {
        $plane = Plane::find($id);
        if (!$plane) {
            return redirect()->route('editAircraft')->with('error', 'Debe buscar un ID válido antes de editar.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_seats' => 'required|integer|min:1|max:300',
        ]);


        $plane->update($validated);

        return redirect()->route('planeList')->with('success', 'Avión actualizado con éxito');
    }

    
    public function destroy($id)
{
    $plane = Plane::find($id);

    if ($plane) {
        $plane->delete();
        return redirect()->route('planeList')->with('success', 'Avión eliminado correctamente');
    } else {
        return redirect()->route('planeList')->with('error', 'Avión no encontrado');
    }
}

    
}
