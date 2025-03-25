@extends('layouts.app1')

@section('content')
    <div class="container-home">
        <div class="container-title">
            <h1>BLUE</h1>
            <h2>HORIZON</h2>

            <div class="container-button">
                <p>"Tu viaje, nuestro horizonte"</p>
                <a href="{{ Auth::check() && Auth::user()->isAdmin ? route('userReservation') : route('flightList') }}" class="btn-home">COMENZAR</a>
            </div>
        </div>
    </div>
@endsection