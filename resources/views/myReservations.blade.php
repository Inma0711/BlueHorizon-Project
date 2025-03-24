@extends('layouts.app2')

@section('content')

    <div class="container-title">
        <h1 class="title-plane">MIS RESERVAS</h1>
    </div>

    <div class="button-option">
        <button class="button-option">Futuras</button>
        <button class="button-option">Pasadas</button>
    </div>

    <div id="future" class="reservations-container">
        <h2>Future Reservations</h2>
        @foreach ($futureReservations as $futureReservation)
            <div class="reserva">
                <p><strong>Passenger:</strong> {{ $futureReservation->user->name }}</p>
                <p><strong>Departure:</strong> {{ $futureReservation->flight->departure_location }}</p>
                <p><strong>Destination:</strong> {{ $futureReservation->flight->arrival_location }}</p>
                <p><strong>Plane:</strong> {{ $futureReservation->flight->plane->name }}</p>
                <p><strong>Date:</strong> {{ $futureReservation->flight->date }}</p>
                <button class="delete-btn" data-id="{{ $futureReservation->id }}">Delete</button>
            </div>
        @endforeach
    </div>
    
    <div id="past" class="reservations-container">
        <h2>Past Reservations</h2>
        @foreach ($pastReservations as $pastReservation)
            <div class="reserva">
                <p><strong>Passenger:</strong> {{ $pastReservation->user->name }}</p>
                <p><strong>Departure:</strong> {{ $pastReservation->flight->departure_location }}</p>
                <p><strong>Destination:</strong> {{ $pastReservation->flight->arrival_location }}</p>
                <p><strong>Plane:</strong> {{ $pastReservation->flight->plane->name }}</p>
                <p><strong>Date:</strong> {{ $pastReservation->flight->date }}</p>
            </div>
        @endforeach
    </div>
    

@endsection
