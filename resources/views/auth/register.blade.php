@extends('layouts.auth')


{{-- @push('custom_js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush --}}

@section('content')
@push('custom_css')
<style>
    .infor{
        margin-top: 25%;
    }
    select{
        color: black;
    }
</style>
@endpush

@php
$countries = DB::table('countries')->get();
$referred = null;
@endphp
@if ( request()->referred_id != null )
    @php
        $referred = DB::table('users')
        ->select('fullname')
        ->where('ID', '=', request()->referred_id)
        ->first();
    @endphp
@endif

<body >
    @include('auth.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-12 infor">
                <div class="title">
                    Crea tu cuenta!
                </div>
                <div class="subtitle">
                    Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
                <div class="carta w-100 ">
                    <div class="mt-2 mx-2">
                        <p class="titulo text-left">Registrate</p>
                        <p class="subtitulo text-left ">Crea tu cuenta y se parte de nuestro ecosistema.</p>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-body mt-0">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            @if ( request()->referred_id != null )
                            <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
                            @else
                            <input type="hidden" name="referred_id" value="1">
                            @endif

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name"  required autocomplete="name" autofocus
                                        placeholder=" Nombre y Apellido" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                                <div class="form-group col-md-6">
                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror"
                                        name="dni"  required autocomplete="dni" autofocus
                                        placeholder=" Número de Identificación" value="{{ old('dni') }}">

                                    @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                            
                            </div>

                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"  required autocomplete="phone" autofocus
                                        placeholder=" Teléfono" value="{{ old('phone') }}">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" required autocomplete="email"
                                        placeholder=" Correo Electronico" value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                                                            
                            </div>

                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <select id="country" type="text" class="form-control @error('country') is-invalid @enderror"
                                        name="country" required autocomplete="country" autofocus
                                        >
                                        <option selected disabled readonly>País</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 

                                <div class="form-group col-md-6">
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror"
                                        name="state"  required autocomplete="state" autofocus
                                        placeholder=" Estado o Provincia" value="{{ old('state') }}">

                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">   
                                <div class="form-group col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                        name="city"  required autocomplete="city" autofocus
                                        placeholder=" Ciudad" value="{{ old('city') }}">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="age" type="text" onfocus="(this.type='date')" class="form-control @error('age') is-invalid @enderror"
                                        name="age"  required autocomplete="age" autofocus
                                        placeholder=" Fecha de Nacimiento" value="{{ old('age') }}">

                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                                                                
                            </div>

                            <div class="row">  
                                <div class="form-group col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="&#61475; Ingrese una contraseña" >

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 

                                <div class="form-group col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="&#61475; confirme su contraseña">
                                </div>                                                                                
                            </div>

                            <fieldset class="checkbox registrate mb-1">
                                <div class="vs-checkbox-con vs-checkbox-primary float-left justify-content-center">
                                    <input type="checkbox" name="term" id="term" {{ old('term') ? 'checked' : '' }}>
                                    <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                    </span>
                                    @error('term')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <p style="font-size: 1rem">
                                    Acepto las políticas de manejo de informacion de <span>Venture Capital Association</span>
                                </p>
                            </fieldset>
                            <div class="form-group row d-flex ml-5" >
                                <div class="col-10" >
                                    <div class="form-group ml-3">
                                        {!! NoCaptcha::renderJs('es', false, 'recaptchaCallback') !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>

                                    <button type="submit" class="btn bg-fucsia text-white btn-block btn-login">
                                        {{ __('Registrate') }}
                                    </button>
                                </div>
                            </div>   
                            <div class="col-12 mt-2">
                                <p class="text-center">
                                    <a href="{{ route('login') }}" class="registrate">
                                        ¿Ya tienes una cuenta? <span>Inicia sesión</span>
                                    </a>
                                </p>
                            </div>                        
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @include('auth.footer')
    </div>

   
<!--
            {{-- <div class="col-md-10 col-sm-8 col-12">
                <div class="card mb-0 card-margin">
                    <div class="card-header">
                        <h5 class="card-title text-center col-12 text-input-holder">{{ __('Registrar') }}</h5>
                        @if (!empty($referred))
                        <h6 class="text-center col-12">Registro Referido por {{$referred->fullname}}</h6>
                        @endif
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            @if ( request()->referred_id != null )
                            <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
                            @else
                            <input type="hidden" name="referred_id" value="1">
                            @endif

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name"  required autocomplete="name" autofocus
                                        placeholder="Nombre y Apellido" value="{{ old('name') }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                                <div class="form-group col-md-6">
                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror"
                                        name="dni"  required autocomplete="dni" autofocus
                                        placeholder="Número de Identificación" value="{{ old('dni') }}">

                                    @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                            
                            </div>

                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"  required autocomplete="phone" autofocus
                                        placeholder="Teléfono" value="{{ old('phone') }}">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" required autocomplete="email"
                                        placeholder="Correo Electronico" value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                                                            
                            </div>

                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <select id="country" type="text" class="form-control @error('country') is-invalid @enderror"
                                        name="country" required autocomplete="country" autofocus
                                        >
                                        <option selected disabled readonly>Escoge tu país</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 

                                <div class="form-group col-md-6">
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror"
                                        name="state"  required autocomplete="state" autofocus
                                        placeholder="Estado o Provincia" value="{{ old('state') }}">

                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">   
                                <div class="form-group col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                        name="city"  required autocomplete="city" autofocus
                                        placeholder="Ciudad" value="{{ old('city') }}">

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="age" type="text" onfocus="(this.type='date')" class="form-control @error('age') is-invalid @enderror"
                                        name="age"  required autocomplete="age" autofocus
                                        placeholder="Fecha de Nacimiento" value="{{ old('age') }}">

                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                                                                
                            </div>

                            <div class="row">  
                                <div class="form-group col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Ingrese una contraseña" >

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 

                                <div class="form-group col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="confirme su contraseña">
                                </div>                                                                                
                            </div>

                            <div class="form-group row mb-0 d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! NoCaptcha::renderJs('es', false, 'recaptchaCallback') !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>

                                    <button type="submit" class="btn bg-fucsia text-white btn-block btn-login">
                                        {{ __('Registrarme') }}
                                    </button>
                                </div>
                            </div>

                            <fieldset class="checkbox mt-1 ml-2">
                                <div class="vs-checkbox-con vs-checkbox-primary float-left justify-content-center">
                                    <input type="checkbox" name="term" id="term" {{ old('term') ? 'checked' : '' }}>
                                    <span class="vs-checkbox">
                                        <span class="vs-checkbox--check">
                                            <i class="vs-icon feather icon-check"></i>
                                        </span>
                                    </span>
                                    @error('term')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <span class="">Acepto los <a href="">Terminos y
                                        Condiciones</a></span>
                            </fieldset>

                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <p class="text-center">
                        <small>
                            <span>¿Ya tienes una cuenta?</span>
                            <br>
                            <a class="text-rosado" href="{{ route('login') }}">
                                {{ __('Inicia sesión') }}
                            </a>
                        </small>
                    </p>
                </div>
            </div> --}}-->
</body>    
@endsection


