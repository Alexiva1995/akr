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

    .email::-webkit-input-placeholder {
        overflow: visible;
    }
</style>
@endpush

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<body>

    <div class="container login">

        <div class="row ">

            <div class="col-md-6 col-sm-12 col-12">

                <div class="title" style="margin-top:100px;">
                    Bienvenido de nuevo!
                </div>
                <div class="subtitle">
                    Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
                </div>
            </div>
            <div class="col-md-1 col-sm-12 col-12" style="margin-bottom:480px;">
            </div>

            <div class="col-md-5 col-sm-12 col-12">
                <div class="mb-1 carta w-100 ">
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
                                    <input id="email" type="text" class="email form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" tucorreo@email.com" style="font-family:FontAwesome, Arial" />

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
                                    <input id="password" type="password" class="form-control text-input-holder @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="font-family:FontAwesome,Arial " placeholder="&#61475; Ingresa tu contraseña">


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


                <header>
                    <nav class="navbar fixed-top">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#"><img src="{{asset('assets/Diseño/DreamsBlue.svg')}}" alt="hola"></a>

                            <ul class="nav justify-content-end mr-5">
                                <li class="nav-item">
                                    <a class="nav-link active text-white ." aria-current="page" href="#" style="font-size:18px;">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#" style="font-size:18px;">Block</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#" style="font-size:18px;">Contacto</a>
                                </li>

                            </ul>
                    </nav>
            </div>
            </header>

        </div>
    </div>
    </div>
    </div>
    </div>
    @include('auth.footer')

</body>


@endsection