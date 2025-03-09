@extends('layouts.app2')

@section('content')

<div class="container1-plane-create">
    <div class="container2-plane-create">
        <h2 class="title-create">Crear avión</h2>

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

        <form action="{{ url('/createAircraft') }}" method="POST" class="form-create">
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


    </div>
</div>
@endsection