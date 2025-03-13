@extends('layouts.app2')

@section('content')
    <div class="container1-plane-edit">
        <div class="container2-plane-edit">

            {{-- Formulario para buscar un vuelo por ID --}}
            <div class="container-form1">
                <form method="GET" action="{{ route('editFlight') }}">
                    <label for="search_id">Buscar ID del vuelo:</label>
                    <select id="search_id" name="search_id" class="input-field" required>
                        <option value="" disabled selected>Selecciona un vuelo</option>
                        @foreach ($flights as $flight)
                            <option value="{{ $flight->id }}">{{ $flight->id }} - {{ $flight->departure_location }} a {{ $flight->arrival_location }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="login-btn">Buscar</button>
                </form>
            </div>

            {{-- Mensajes de error o éxito --}}
            @if (session('success'))
                <div class="success-message">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="error-message">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
        </div>

        {{-- Formulario de edición (bloqueado hasta que se busque un vuelo) --}}
        <div class="container-form2">
            <form action="{{ isset($selectedFlight) ? route('updateFlight', $selectedFlight->id) : '#' }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="title-edit">Editar Vuelo</h2>

                <div>
                    <label for="id">ID del vuelo:</label>
                    <input type="text" id="id" name="id" class="input-field"
                        value="{{ isset($selectedFlight) ? $selectedFlight->id : '' }}" 
                        readonly style="pointer-events: none; background-color: #e9ecef;">
                </div>

                <div>
                    <label for="plane_id">Avión:</label>
                    <select id="plane_id" name="plane_id" class="input-field"
                        {{ isset($selectedFlight) ? '' : 'disabled' }}>
                        <option value="" disabled selected>Selecciona un avión</option>
                        @foreach ($planes as $plane)
                            <option value="{{ $plane->id }}" {{ isset($selectedFlight) && $selectedFlight->plane_id == $plane->id ? 'selected' : '' }}>
                                {{ $plane->id }} - {{ $plane->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date">Fecha del vuelo:</label>
                    <input type="date" id="date" name="date" class="input-field"
                        value="{{ isset($selectedFlight) ? $selectedFlight->date : '' }}" 
                        required min="{{ date('Y-m-d') }}"
                        {{ isset($selectedFlight) ? '' : 'disabled' }}>
                </div>

                <div>
                    <label for="departure_location">Ubicación de salida:</label>
                    <input type="text" id="departure_location" name="departure_location" class="input-field"
                        value="{{ isset($selectedFlight) ? $selectedFlight->departure_location : '' }}" 
                        required style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();">
                </div>

                <div>
                    <label for="arrival_location">Ubicación de llegada:</label>
                    <input type="text" id="arrival_location" name="arrival_location" class="input-field"
                        value="{{ isset($selectedFlight) ? $selectedFlight->arrival_location : '' }}" 
                        required style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();">
                </div>

                <div>
                    <label for="price">Precio:</label>
                    <input type="number" id="price" name="price" class="input-field"
                        value="{{ isset($selectedFlight) ? $selectedFlight->price : '' }}" 
                        required min="0"
                        {{ isset($selectedFlight) ? '' : 'disabled' }}>
                </div>

                <div>
                    <button type="submit" class="login-btn" {{ isset($selectedFlight) ? '' : 'disabled' }}>Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
