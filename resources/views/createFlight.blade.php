@extends('layouts.app2')

@section('content')

<div class="container1-plane-create">
    <div class="container2-plane-create">
        <h2 class="title-create">Crear Vuelo</h2>

        @if (session('success'))
            <div class="success-message">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/createFlight') }}" method="POST" class="form-create">
            @csrf
            <div>
                <label for="plane_id">ID del avión:</label>
                <input type="number" id="plane_id" name="plane_id" class="input-field" value="{{ old('plane_id') }}" min="1" required>
            </div>
            <div>
                <label for="date">Fecha del vuelo:</label>
                <input type="date" id="date" name="date" class="input-field" value="{{ old('date') }}" required>
            </div>
            <div>
                <label for="departure_location">Ubicación de salida:</label>
                <input type="text" id="departure_location" name="departure_location" class="input-field" value="{{ old('departure_location') }}" required>
            </div>
            <div>
                <label for="arrival_location">Ubicación de destino:</label>
                <input type="text" id="arrival_location" name="arrival_location" class="input-field" value="{{ old('arrival_location') }}" required>
            </div>
            <div>
                <label for="price">Precio:</label>
                <input type="number" id="price" name="price" class="input-field" value="{{ old('price') }}" min="0" required>
            </div>
            <div>
                <label for="status">Estado del vuelo:</label>
                <select id="status" name="status" class="input-field" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div>
                <button type="submit" class="login-btn">Crear Vuelo</button>
            </div>
        </form>

    </div>
</div>

@endsection
