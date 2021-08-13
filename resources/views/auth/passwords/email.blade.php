@extends('layouts.auth')

@section('content')
@push('custom_css')

@endpush

@include('auth.navbar')
<div class="container">

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div id="home" class="hero route bg-image" style="background-image: url(assets/img/header.jpg)">
        <div class="row ">
            <div class="col-md-6 col-sm-12 col-12 infor">
                <div class="title ">
                    Recuperar Cuenta!
                </div>
                <div class="subtitle">
                    Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
                </div>
            </div>

            <div class="col-md-1 col-sm-12 col-12 ">
            </div>
            <div class="col-md-5 col-sm-12 col-12" style="margin-top: 150px;">
                <div class="mb-5 cardd w-100 login">
                    <div class="mt-3 mx-2">
                        
                    <a class="text-rosado float-left " href="{{route('login')}}">
                
                        <i style="color:white;" class="fa fa-arrow-left"></i>
                    </a>
                        <p class="titulo text-center ml-2">{{ __('Recuperar Contraseña') }}</p>

                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group row">


                                <div class="col-md-12 mt-1">
                                    <label>Correo Electronico o Nombre de Usuario</label>
                                    <input id="email" type="text" class=" email form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" " />

                                    <span class="floating-label mt-1"><i class="fas fa-envelope"></i> Digita tu Nombre de usuario o Email</span>


                                    @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-5 mt-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn-login w-100">
                                    {{ __('Enviar Código') }}
                                    </button>

                               
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        
        
        @include('auth.footer')


@endsection