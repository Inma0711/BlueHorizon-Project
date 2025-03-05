@extends('layouts.app2')

@section('content')
    <div class="principal-container">
        <div class="login-container">

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

            <div class="container-form1">
                <form method="POST" action="{{ route('searchAircraft') }}">
                    @csrf
                    <label for="search_id">Buscar ID del avión:</label>
                    <input type="number" id="search_id" name="search_id" class="input-field" placeholder="Escribe la ID"
                        required>
                    <button type="submit" class="login-btn">Buscar</button>
                </form>
            </div>
        </div>


        <div class="container-form2">
            <form action="{{ route('updateAircraft', isset($plane) ? $plane->id : '') }}" method="POST">
                @csrf
                @method('PUT')

                <span>Editar Avión</span>
                <div>
                    <label for="id">ID del avión:</label>
                    <input type="number" id="id" name="id" class="input-field" value="{{ $plane->id ?? '' }}"
                        readonly>
                </div>

                <div>
                    <label for="name">Nombre del avión:</label>
                    <input type="text" id="name" name="name" class="input-field" value="{{ $plane->name ?? '' }}"
                        required>
                </div>

                <div>
                    <label for="max_seats">Número máximo de asientos:</label>
                    <input type="number" id="max_seats" name="max_seats" class="input-field"
                        value="{{ $plane->max_seats ?? '' }}" required>
                </div>


                <div>
                    <button type="submit" class="login-btn">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
