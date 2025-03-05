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

    public function create()
    {
        return view('createAircraft');  

    }

    public function store(Request $request)
    {
           $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_seats' => 'required|integer|min:1', 
        ]);

        Plane::create([
            'name' => $validated['name'],
            'max_seats' => $validated['max_seats'],
        ]);

        return redirect()->route('createAircraft')->with('success', 'Avión creado con éxito');
        
    }

    public function show(Plane $plane)
    {
        //
    }

    public function edit($id)
    {
        // Obtener el avión por su ID
        $plane = Plane::findOrFail($id);

        // Retornar la vista con los datos del avión
        return view('editAircraft', compact('plane'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id' => 'required|integer|unique:planes,id,'.$id, // Asegura que el nuevo ID no esté en uso por otro avión
            'name' => 'required|string|max:255',
            'max_seats' => 'required|integer|min:1',
        ]);
    
        // Obtener el avión actual
        $plane = Plane::findOrFail($id);
    
        // Si el usuario cambió el ID, debemos actualizarlo también
        if ($plane->id != $validated['id']) {
            $plane->id = $validated['id'];
        }
    
        // Actualizar los otros datos del avión
        $plane->name = $validated['name'];
        $plane->max_seats = $validated['max_seats'];
        $plane->save(); // Guardar los cambios
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('editAircraft')->with('success', 'Avión actualizado con éxito');
    }
    

  
    public function destroy(Plane $plane)
    {
        //
    }

}