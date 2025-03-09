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

    <div class="flight-list">
         @foreach ($planes as $plane)
         <div class="item">
                    <tr>
                        <td>{{ $plane->name }}</td>
                        <td>{{ $plane->max_seats }}</td>
                    </tr>
                </div>
                @endforeach
            </div>
        
    @endif
    </div>
@endsection
