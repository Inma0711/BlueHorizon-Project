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
        return view('aircraftForm');
    }

    public function create()
    {
        return view('aircraftForm');  

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

        return redirect()->route('aircraftForm')->with('success', 'Avión creado con éxito');
        
    }

  /*
    public function show(Plane $plane)
    {
        //
    }

    
    public function edit(Plane $plane)
    {
        //
    }

  
    public function update(Request $request, Plane $plane)
    {
        //
    }

  
    public function destroy(Plane $plane)
    {
        //
    }
        */

}