@extends('layouts.app2')

@section('content')
    <!--<div class="container-home">-->
    <div class="container-title">
        <h1 class="title-flight">VUELOS DISPONIBLES</h1>
    </div>

    @if (Auth::check() && Auth::user()->isAdmin)
        <div class="button-option">
            <a href="{{ route('createFlight') }}" class="btn btn-success">Crear</a>
            <a href="{{ route('editFlight') }}" class="btn btn-success">Editar</a>
        </div>
    @endif

    <div class="flight-list">
        @foreach ($flightLists as $flightList)
        @if ($flightList->status)
        <div class="item-flight">
            <div class="item">
                <div class="container-flight1">
                    <img src="{{ asset('img/planeItem.png') }}" alt="Plane" class="plane-item">
                    <p>IDA</p>
                </div>
                <div class="container-flight2">
                    <div class="title-country">
                        {{ $flightList->departure_location }} - {{ $flightList->arrival_location }}
                    </div>
                    <div class="flight-date">
                        {{ $flightList->date }}
                    </div>
                    <div class="flight-user">
                        <img src="{{ asset('img/userIcon.png') }}" alt="User Icon" class="user-item">
                        <span>{{ $flightList->plane->max_seats ?? 'No disponible' }}</span>
                    </div>
                </div>
                <div class="container-flight3">
                    <div class="ctf-3-1">
                        {{ $flightList->departure_location }}
                    </div>
                    <div class="ctf-3-2">
                        {{ $flightList->arrival_location }}
                    </div>
                    <form action="{{ route('reserveFlight', $flightList->id) }}" method="POST" class="reservation-form">
                        @csrf
                        <button type="submit" class="ctf-3-3">
                            {{ $flightList->price }}€
                        </button>
                    </form>
                </div>
            </div>

            
            @if (Auth::check() && Auth::user()->isAdmin)
            <div class="button-delete-container">
                <form action="{{ route('deleteFlight', $flightList->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-delete">
                        <img src="{{ asset('img/deleteItem.png') }}" alt="Eliminar" class="trash-icon">
                    </button>
                </form>
            </div>
            @endif
            
        </div>
        @endif 
        @endforeach
    </div>
    <!--</div>-->
@endsection
