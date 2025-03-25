@extends('layouts.app1')

@section('content')
<div class="principal-container">
    <div class="login-container2">
        <div class="user-icon">
            <img src="{{ asset('img/user.png') }}" alt="User">
        </div>
        <h2>{{ __('Registro') }}</h2>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="name" type="text" class="input-field2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="email" type="email" class="input-field2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="password" type="password" class="input-field2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="input-field2" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="login-btn" id="register-btn">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection