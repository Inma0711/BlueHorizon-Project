@extends('layouts.app2')

@section('content')
    <div class="container1-plane-edit">
        <div class="container2-plane-edit">

            <div class="container-form1">
                <form method="GET" action="{{ route('editAircraft') }}">
                    <label for="search_id">Seleccionar un avión:</label>
                    <select id="search_id" name="search_id" class="input-field" required onchange="this.form.submit()">
                        <option value="" disabled selected>Seleccione un avión</option>
                        @foreach ($planes as $p)
                            <option value="{{ $p->id }}" {{ isset($plane) && $plane->id == $p->id ? 'selected' : '' }}>
                                ID: {{ $p->id }} - {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

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

        <div class="container-form2">
            <form action="{{ route('updateAircraft', isset($plane) ? $plane->id : '') }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="title-edit">Editar Avión</h2>

                <div>
                    <label for="id">ID del avión:</label>
                    <input type="text" id="id" name="id" class="input-field"
                        value="{{ isset($plane) ? $plane->id : '' }}" 
                        readonly style="pointer-events: none; background-color: #e9ecef;">
                </div>

                <div>
                    <label for="name">Nombre del avión:</label>
                    <input type="text" id="name" name="name" class="input-field"
                        value="{{ isset($plane) ? $plane->name : '' }}" 
                        required {{ isset($plane) ? '' : 'disabled' }}
                        placeholder="Nombre avión">
                </div>

                <div>
                    <label for="max_seats">Número máximo de asientos:</label>
                    <input type="number" id="max_seats" name="max_seats" class="input-field"
                        value="{{ isset($plane) ? $plane->max_seats : '' }}" 
                        required min="1" max="300" {{ isset($plane) ? '' : 'disabled' }}
                        placeholder="Nº asientos">
                </div>

                <div>
                    <button type="submit" class="login-btn" {{ isset($plane) ? '' : 'disabled' }}>Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
