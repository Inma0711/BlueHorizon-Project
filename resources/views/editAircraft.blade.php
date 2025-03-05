@extends('layouts.app2')

@section('content')

<style>
    /* Estilos CSS aquí */
    /* Puedes agregar los estilos que hemos discutido antes aquí o directamente en tu archivo CSS. */
</style>

<div class="principal-container">
    <div class="login-container">
        <h2>Editar avión</h2>

        {{-- Mensaje de éxito (verde) --}}
        @if (session('success'))
            <div class="success-message">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Mensaje de error (rojo) --}}
        @if (session('error'))
            <div class="error-message">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Primer formulario: Buscar avión por ID --}}
        <form method="POST" action="{{ route('searchAircraft') }}">
            @csrf
            <label for="search_id">Buscar ID del avión:</label>
            <input type="number" id="search_id" name="search_id" class="input-field" placeholder="Escribe la ID" required>
            <button type="submit" class="login-btn">Buscar</button>
        </form>

        {{-- Separador entre los formularios --}}
        <div class="form-divider">
            <span>Editar Avión</span>
        </div>

        {{-- Segundo formulario: Mostrar los campos del avión para editar --}}
        <form action="{{ route('updateAircraft', isset($plane) ? $plane->id : '') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ID del avión, solo lectura --}}
            <div>
                <label for="id">ID del avión:</label>
                <input type="number" id="id" name="id" class="input-field" value="{{ $plane->id ?? '' }}" readonly>
            </div>

            {{-- Nombre del avión --}}
            <div>
                <label for="name">Nombre del avión:</label>
                <input type="text" id="name" name="name" class="input-field" value="{{ $plane->name ?? '' }}" required>
            </div>

            {{-- Número máximo de asientos --}}
            <div>
                <label for="max_seats">Número máximo de asientos:</label>
                <input type="number" id="max_seats" name="max_seats" class="input-field" value="{{ $plane->max_seats ?? '' }}" required>
            </div>

            {{-- Botón para actualizar los datos --}}
            <div>
                <button type="submit" class="login-btn">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

@endsection
