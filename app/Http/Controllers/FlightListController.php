<?php

namespace App\Http\Controllers;

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

    /*
    public function store(Request $request)
    {
        //
    }
    */
    /*
    public function show(string $id)
    {
        //
    }
    */
    /*
    public function update(Request $request, string $id)
    {
        //
    }
    */
    /*
    public function destroy(string $id)
    {
        //
    }
        */
}
