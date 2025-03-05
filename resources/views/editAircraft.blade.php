@extends('layouts.app2')

@section('content')

<div class="principal-container">
    <div class="login-container">

        <h2>Editar avión</h2>

        <form action="{{ route('editAircraft', ['id' => $plane->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="id">ID del avión:</label>
                <input type="number" id="id" name="id" class="input-field" value="{{ old('id', $plane->id) }}" required>
            </div>
            <div>
                <label for="name">Nombre del avión:</label>
                <input type="text" id="name" name="name" class="input-field" value="{{ old('name', $plane->name) }}" required>
            </div>
            <div>
                <label for="max_seats">Número máximo de asientos:</label>
                <input type="number" id="max_seats" name="max_seats" class="input-field" value="{{ old('max_seats', $plane->max_seats) }}" required>
            </div>
            <div>
                <button type="submit" class="login-btn">Actualizar avión</button>
            </div>
        </form>

        @if (session('success'))
            <div>
                <p>{{ session('success') }}</p>
            </div>
        @endif

    </div>
</div>

@endsection
