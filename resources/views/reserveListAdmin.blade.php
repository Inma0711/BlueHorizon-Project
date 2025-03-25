@extends('layouts.app2')

@section('content')
    <div class="container">
        <h1>Lista de Reservas por Usuario</h1>

        @foreach($users as $user)
            <div class="user">
                <h2>{{ $user->name }}</h2>  

                <h3>Reservas Activas:</h3>
                @if($user->activeReservations->isEmpty())
                    <p>No tiene reservas activas.</p>
                @else
                    <ul>
                        @foreach($user->activeReservations as $reservation)
                            <li>
                                <strong>Vuelo:</strong> {{ $reservation->flight->departure_location }} - {{ $reservation->flight->arrival_location }}<br>
                                <strong>Fecha:</strong> {{ $reservation->flight->date }}<br>
                                <strong>Precio:</strong> {{ $reservation->flight->price }} €<br>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        @endforeach
    </div>
@endsection
