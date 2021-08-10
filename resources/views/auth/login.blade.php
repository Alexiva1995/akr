@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>
    strong {
        color: #059CBD
    }

    #email::placeholder { 
        color: #B0B0B0; 
        font-size: 1.2rem;
    }
    #password::placeholder { 
        color: #B0B0B0; 
        font-size: 1.2rem;
    }

</style>
@endpush
<div class="fondo">
<div class="container login">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <div class="title">
                Bienvenido de nuevo!
            </div>
            <div class="subtitle">
                Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
            </div>
        </div>
        <div class="col-md-1 col-sm-12 col-12">
        </div>
        <div class="col-md-5 col-sm-12 col-12 ">
            <div class="mb-1 carta w-100">
                <div class="mt-4 mx-2 my-2">
                    <p class="titulo text-left">{{ __('Iniciar Sesión') }}</p>
                    <p class="subtitulo text-left ">Inicie sesion en su cuenta para empezar</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label>Correo Electronico</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="tucorreo@email.com">

                                

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Contraseña</label>
                                <input id="password" type="password" class="form-control text-input-holder @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingresa tu contraseña">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @if (Route::has('password.request'))
                                <div class="col-12 d-flex justify-content-center mt-2">
                                    <a class="forgot-password" href="{{ route('password.request') }}">
                                        Se te olvido tu contraseña?
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn-login w-100">
                                    Iniciar sesión
                                </button>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <p class="text-center">
                                <a href="{{ route('register') }}" class="registrate">
                                    ¿No registrado? <strong>Crear una cuenta</strong>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


        {{-- <div class="col-md-4 col-sm-8 col-12">
            <div class="card mb-1 card-margin">
                <div class="card-header">
                    <h5 class="card-title text-center col-12 text-input-holder">{{ __('Iniciar Sesión') }}</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control text-input-holder @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingresa tu email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control text-input-holder @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingresa tu contraseña">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @if (Route::has('password.request'))
                    <a class="text-rosado" href="{{ route('password.request') }}">
                        {{ __('Olvidé mi contraseña ->') }}
                    </a>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-12">
                    <button type="submit" class="btn bg-fucsia text-white btn-block btn-login">
                        {{ __('Ingresar') }}
                    </button>
                </div>
            </div>

            <fieldset class="checkbox mt-1">
                <div class="vs-checkbox-con vs-checkbox-danger justify-content-center">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="vs-checkbox">
                        <span class="vs-checkbox--check">
                            <i class="vs-icon feather icon-check"></i>
                        </span>
                    </span>
                    <span class="">Recordar</span>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="col-12">
    <p class="text-center">
        <small>
            <span>¿Aun no tienes una cuenta?</span>
            <br>
            <a class="text-rosado" href="{{ route('register') }}">
                {{ __('Registrate') }}
            </a>
        </small>
    </p>
</div>
</div> --}}
@endsection