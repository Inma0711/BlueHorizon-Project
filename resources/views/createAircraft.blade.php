@extends('layouts.app2')

@section('content')

<div class="principal-container">
    <div class="login-container">
        <h2>Crear avión</h2>

        {{-- Mensaje de éxito (verde) --}}
        @if (session('success'))
            <div class="success-message">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Formulario de creación de avión --}}
        <form action="{{ url('/createAircraft') }}" method="POST">
            @csrf
            <div>
                <label for="name">Nombre del avión:</label>
                <input type="text" id="name" name="name" class="input-field" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="max_seats">Número máximo de asientos:</label>
                <input type="number" id="num_max" name="max_seats" class="input-field" value="{{ old('max_seats') }}" required>
            </div>
            <div>
                <button type="submit" class="login-btn">Crear avión</button>
            </div>
        </form>

        {{-- Mensaje de error --}}
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-divider">
            <span>O prueba otra acción</span>
        </div>
    </div>
</div>
@endsection
