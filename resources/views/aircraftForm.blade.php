@extends('layouts.app2')

@section('content')

<form action="{{ url('/aircraftForm') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nombre del avión:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="max_seats">Número máximo de asientos:</label>
        <input type="number" id="num_max" name="max_seats" value="{{ old('max_seats') }}" required>
    </div>
    <div>
        <button type="submit">Crear avión</button>
    </div>
</form>

@if (session('success'))
<div>
    <p>{{ session('success') }}</p>
</div>
@endif

@endsection
