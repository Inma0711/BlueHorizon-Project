@extends('layouts.app2')

@section('content')

    <div class="container-title">
        <h1 class="title-plane">MIS RESERVAS</h1>
    </div>

    <div class="button-option">
        <button class="button-option">Futuras</button>
        <button class="button-option">Pasadas</button>
    </div>

    <div id="futuras" class="reservations-container">
        <h2>Reservas Futuras</h2>
        @foreach ($futuras as $reserva)
            <div class="reserva">
                <p><strong>Pasajero:</strong> {{ $reserva->user->name }}</p>
                <p><strong>Salida:</strong> {{ $reserva->flight->departure_location }}</p>
                <p><strong>Destino:</strong> {{ $reserva->flight->arrival_location }}</p>
                <p><strong>Avión:</strong> {{ $reserva->flight->plane->name }}</p>
                <p><strong>Fecha:</strong> {{ $reserva->flight->date }}</p>
            </div>
        @endforeach
    </div>
    
    <div id="pasadas" class="reservations-container">
        <h2>Reservas Pasadas</h2>
        @foreach ($pasadas as $reserva)
            <div class="reserva">
                <p><strong>Pasajero:</strong> {{ $reserva->user->name }}</p>
                <p><strong>Salida:</strong> {{ $reserva->flight->departure_location }}</p>
                <p><strong>Destino:</strong> {{ $reserva->flight->arrival_location }}</p>
                <p><strong>Avión:</strong> {{ $reserva->flight->plane->name }}</p>
                <p><strong>Fecha:</strong> {{ $reserva->flight->date }}</p>
            </div>
        @endforeach
    </div>


@endsection
