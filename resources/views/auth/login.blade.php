@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-box">
        <h2>Iniciar sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="email">Correo electrónico</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">Contraseña</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Iniciar sesión
            </button>

            <div class="register-prompt">
                <p>Aún no estás registrado?</p>
                <a href="{{ route('register') }}" class="btn-register">¡Regístrate!</a>
            </div>
        </form>
    </div>
</div>
@endsection
