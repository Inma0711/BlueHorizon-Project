@extends('layouts.app2')

@section('content')
    <div class="container">
        <h1 class="title-flight">Lista de Reservas por Usuario</h1>

        @foreach($users as $user)
            @if(!$user->isAdmin())
                <div class="user-card">
                    
                    <div class="user-info">
                        <img src="{{ asset('img/userIcon.png') }}" alt="Usuario" class="user-avatar">
                        <h2>{{ $user->name }}</h2>
                    </div>

                    <div class="reservations">
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
                </div>
            @endif
        @endforeach
    </div>
@endsection
