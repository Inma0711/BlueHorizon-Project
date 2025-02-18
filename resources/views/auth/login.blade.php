@extends('layouts.app1')

@section('content')
<div class="principal-container">
<div class="login-container"> 
    <div class="user-icon">
        <img src="{{ asset('img/user.png') }}" alt="User">
    </div>
    <h2>{{ ('Iniciar Sesión') }}</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input id="email" type="email" class="input-field @error('email') is-invalid @enderror" 
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror

        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" 
            name="password" required autocomplete="current-password" placeholder="Contraseña">
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror

        <div class="checkbox-container">
            <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="checkbox-label" for="remember">
                {{ __('Recuerdame') }}
            </label>
        </div>

        <button type="submit" class="login-btn">
            {{ ('Entrar') }}
        </button>

        @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste la contraseña?') }}
            </a>
        @endif
    </form>
</div>
</div>

<div class="lights-container">
    <div class="light"></div>
    <div class="light"></div>
    <div class="light"></div>
    <div class="light"></div>
    <div class="light"></div> 
</div>
@endsection
