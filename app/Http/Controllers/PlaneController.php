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

    /*
    public function search(Request $request)
    {
        // Inicializamos la variable plane en null
        $plane = null;
    
        // Si se ha enviado un ID de avión para buscar
        if ($request->has('search_id')) {
            $plane = Plane::find($request->input('search_id')); // Buscar avión por ID
    
            // Si no se encuentra el avión, redirige con un mensaje de error
            if (!$plane) {
                return redirect()->route('editAircraft')->with('error', 'Avión no encontrado');
            }
        }
    
        // Retornamos la vista con el avión encontrado (o null si no se encuentra)
        return view('editAircraft', compact('plane'));
    }
    
    
    public function edit($id)
    {
        $plane = Plane::findOrFail($id);
        return view('editAircraft', compact('plane'));
    }
    
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'max_seats' => 'required|integer|min:1',
        ]);
    
        $plane = Plane::findOrFail($id);
        $plane->name = $validated['name'];
        $plane->max_seats = $validated['max_seats'];
        $plane->save();
    
        return redirect()->route('editAircraft', $id)->with('success', 'Avión actualizado con éxito');
    }
  
    public function destroy(Plane $plane)
    {
        //
    }
    
   */

   
   public function edit()
   {
       return view('editAircraft');
   }

   // Método que maneja la búsqueda del avión por ID.
   public function search(Request $request)
   {
       $plane = null;
       
       if ($request->has('search_id')) {
           // Buscar el avión por su ID
           $plane = Plane::find($request->input('search_id'));

           if (!$plane) {
               // Si no se encuentra el avión, redirigir con un mensaje de error
               return redirect()->route('editAircraft')->with('error', 'Avión no encontrado');
           }
       }

       // Si el avión fue encontrado, mostramos el formulario con los datos del avión
       return view('editAircraft', compact('plane'));
   }

   // Método para actualizar el avión
   public function update(Request $request, $id)
   {
       // Validación de los campos
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'max_seats' => 'required|integer|min:1',
       ]);

       // Buscar el avión por ID
       $plane = Plane::findOrFail($id);

       // Actualizar los campos del avión
       $plane->name = $validated['name'];
       $plane->max_seats = $validated['max_seats'];
       $plane->save();

       // Redirigir con un mensaje de éxito
       return redirect()->route('editAircraft')->with('success', 'Avión actualizado con éxito');
   }
}

