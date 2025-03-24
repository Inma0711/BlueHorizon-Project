@extends('layouts.app2')

@section('content')

    <div class="container-title">
        <h1 class="title-plane">MIS RESERVAS</h1>
    </div>

    <div class="button-option">
        <button class="button-option" id="btn-future">Futuras</button>
        <button class="button-option" id="btn-past">Pasadas</button>
    </div>

    <div id="future-reservations" class="reservations-container">
        <h2>Futuras Reservas</h2>
        @foreach ($futureReservations as $futureReservation)
            <div class="reservation">
                <p><strong>Pasajero:</strong> {{ $futureReservation->user->name }}</p>
                <p><strong>Salida:</strong> {{ $futureReservation->flight->departure_location }}</p>
                <p><strong>Destino:</strong> {{ $futureReservation->flight->arrival_location }}</p>
                <p><strong>Avión:</strong> {{ $futureReservation->flight->plane->name }}</p>
                <p><strong>Fecha:</strong> {{ $futureReservation->flight->date }}</p>
                <button class="delete-btn" data-id="{{ $futureReservation->id }}">Cancelar</button>
            </div>
        @endforeach
    </div>
    
    <div id="past-reservations" class="reservations-container" style="display: none;">
        <h2>Reservas Pasadas</h2>
        @foreach ($pastReservations as $pastReservation)
            <div class="reservation">
                <p><strong>Pasajero:</strong> {{ $pastReservation->user->name }}</p>
                <p><strong>Salida:</strong> {{ $pastReservation->flight->departure_location }}</p>
                <p><strong>Destino:</strong> {{ $pastReservation->flight->arrival_location }}</p>
                <p><strong>Avión:</strong> {{ $pastReservation->flight->plane->name }}</p>
                <p><strong>Fecha:</strong> {{ $pastReservation->flight->date }}</p>
            </div>
        @endforeach
    </div>
    

@endsection
