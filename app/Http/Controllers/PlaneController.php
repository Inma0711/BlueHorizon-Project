<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;
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
        // Validación de los datos del formulario
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
    
        return redirect()->route('createAircraft')->with('success', 'Avión creado con éxito');
    }
    

   public function edit()
   {
       return view('editAircraft');
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
    // Verificar si el avión existe
    $plane = Plane::find($id);
    if (!$plane) {
        return redirect()->route('editAircraft')->with('error', 'Debe buscar un ID válido antes de editar.');
    }

    // Validar datos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'max_seats' => 'required|integer|min:1|max:300',
    ]);

    // Actualizar avión
    $plane->update($validated);

    return redirect()->route('editAircraft')->with('success', 'Avión actualizado con éxito');
}
}

