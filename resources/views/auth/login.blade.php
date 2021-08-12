@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>
    input:focus ~ .floating-label,
input:not(:focus):valid ~ .floating-label{
  
  font-size: 11px;
  opacity: 1;
}


@media screen and (max-width: 600px){
    .title,.subtitle{
        margin-left: 10px;
        margin-right: 6px;
    }
}


</style>
@endpush



<body>
    @include('auth.navbar')
    <div class="container">
        <div class="row ">
            <div class="col-md-6 col-sm-12 col-12 infor">
                <div class="title">
                    Bienvenido de nuevo!
                </div>
                <div class="subtitle">
                    Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
                </div>
            </div>
            <div class="col-md-1 col-sm-12 col-12 ">
            </div>
            <div class="col-md-5 col-sm-12 col-12">
                <div class="mb-5 carta w-100 login">
                    <div class="mt-4 mx-2">
                        <p class="titulo text-left">{{ __('Iniciar Sesión') }}</p>
                        <p class="subtitulo text-left ">Inicie sesion en su cuenta para empezar</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label>Correo Electronico</label>
                                    <input id="email" type="text" 
                                    class=" email form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" tucorreo@email.com" />

                                  

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
                                    <input id="password" type="password" 
                                    class=" form-control text-input-holder @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="font-family:FontAwesome,Arial " placeholder=" Ingresa tu contraseña">

                                   

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
                                        ¿No registrado? <span>Crear una cuenta</span>
                                    </a>
                                </p>
                            </div>
                        </form>

                    </div>
                    </div>  
                </div>
                </div>

</body>
@include('auth.footer')

@endsection