@extends('layouts.app2')

@section('content')

    <div class="container-title">
        <h1 class="title-plane">AVIONES</h1>
    </div>

    @if ($planes->isEmpty())
        <p>No hay aviones registrados.</p>
    @else
        <div class="button-option">
            <a href="{{ route('createAircraft') }}" class="button-option">Crear</a>
            <a href="{{ route('editAircraft') }}" class="button-option">Editar</a>
        </div>

        <div class="plane-list">
            @foreach ($planes as $plane)
            <div class="prueba">
                <div class="item-plane">
                    <div class="container-form">
                        <img src="{{ asset('img/planeItem.png') }}" alt="Plane" class="plane-item">
                        <span class="plane-name"><strong>Nombre:</strong> {{ $plane->name }}</span>
                    </div>

                    <div class="container-form">
                        <img src="{{ asset('img/chairItem.png') }}" alt="Plane" class="plane-item">
                        <span class="plane-name"><strong>Asientos:</strong> {{ $plane->max_seats }}</span>
                    </div>
                </div>
                <div class="button-delete-container">
                    <button class="button-delete">
                        <img src="{{ asset('img/deleteItem.png') }}" alt="Eliminar" class="trash-icon">
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    </div>
@endsection
