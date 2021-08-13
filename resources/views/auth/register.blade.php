@extends('layouts.auth')


@section('content')

{{-- @push('custom_js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush --}}

@section('content')
@push('custom_css')

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

<body>
    @include('auth.navbar')
    <div class="container">
        <div class="row">
            <div class=" col-md-6   infor">
                <div class="title">
                    Crea tu cuenta!
                </div>
                <div class="subtitle">
                    Manten tu rostro siempre hacia la luz del sol, y las sombras caeran detrás de ti.
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12">
                <div class="cardd w-100 ">
                    <div class="mt-1 mx-2">
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
                </div>
            </div>
            @endif

            <div id="id" class="card-body ">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if ( request()->referred_id != null )
                    <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
                    @else
                    <input type="hidden" name="referred_id" value="1">
                    @endif

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="name" type="text" class=" form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus placeholder="" value="{{ old('name') }}">

                            <span class="floating-label "><i class="fas fa-id-badge"></i> Nombre y Apellido</span>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="dni" type="text" class=" form-control @error('dni') is-invalid @enderror" name="dni" required autocomplete="dni" autofocus placeholder=" " value="{{ old('dni') }}">


                            <span class="floating-label "><i class="far fa-address-card"></i> Número de Identificación </span>

                            @error('dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="phone" type="text" class=" form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" autofocus placeholder="" value="{{ old('phone') }}">


                            <span class="floating-label "><i class="fas fa-phone"></i> Teléfono </span>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="email" type="email" class=" form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="" value="{{ old('email') }}">

                            <span class="floating-label "><i class="fas fa-envelope"></i> Correo Electronico </span>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>




                    <div class="row">
                        <div class="form-group col-md-6">
                            <select style="  margin-top: 8px;" id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" required autocomplete="country" autofocus>
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
                            <input style="  margin-top: 8px;" id="state" type="text" class=" form-control @error('state') is-invalid @enderror" name="state" required autocomplete="state" autofocus placeholder="" value="{{ old('state') }}">

                            <span class="floating-label "><i class="fas fa-map-marker-alt"></i> Estado o Provincia </span>



                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="city" type="text" class=" form-control @error('city') is-invalid @enderror" name="city" required autocomplete="city" autofocus placeholder="" value="{{ old('city') }}">


                            <span class="floating-label "><i class="fas fa-map-marker-alt"></i> Ciudad </span>

                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="age" type="text" onfocus="(this.type='date')" class="text-white form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age" autofocus placeholder=" " value="{{ old('age') }}">


                            <span class="floating-label "><i class="fas fa-calendar"></i> Fecha de Nacimiento </span>

                            @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="password" type="password" class=" form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="">


                            <span class="floating-label"><i class="fas fa-lock"></i> Ingrese una contraseña </span>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input style="  margin-top: 8px;" id="password-confirm" type="password" class=" form-control" name="password_confirmation" required autocomplete="new-password" placeholder="">



                            <span class="floating-label "><i class="fas fa-lock"></i> confirme su contraseña </span>

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
                    <div class="captchat form-group row d-flex ml-5">
                        <div class="col-10">
                            <div class="form-group ml-3" id="Captcha">
                                {!! NoCaptcha::renderJs('es', false, 'recaptchaCallback') !!}
                                {!! NoCaptcha::display() !!}
                            </div>

                            <button type="submit" class="btn bg-fucsia text-white btn-block btn-login">
                                {{ __('Registrate') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
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

</body>
@include('auth.footer')
@endsection