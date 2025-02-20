@extends('layouts.app2')

@section('content')
    <div class="container-home">
        <div class="container-title">
            <h1 class="title-flight">VUELOS DISPONIBLES</h1>
        </div>

        <div class="flight-list">
            @foreach ($flightLists as $flightList)
                <div class="item">
                    <div class="container-flight1">
                        <img src="{{ asset('img/planeItem.png') }}" alt="Plane" class="plane-item">
                        <p>IDA</p>
                    </div>
                    <div class="container-flight2">
                        <div class="title-country">
                            {{ $flightList->departure_location }} - {{ $flightList->arrival_location }}
                        </div>
                        {{ $flightList->date }}
                    </div>
                    <div class="container-flight3">
                        {{ $flightList->departure_location }}
                        {{ $flightList->arrival_location }}
                        {{ $flightList->price }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
