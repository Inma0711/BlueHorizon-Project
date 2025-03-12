<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{

    public function indexAdmin()
    {
        $users = User::with('reservations.flight')->get();
        return view('reserveListAdmin', compact('users'));
    }

    /*
    public function indexUser()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('flight')->get();
        return view('user_reservations.user_index', compact('reservations'));
    }
        */

    /*
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
        */
}
