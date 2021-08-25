@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@push('custom_css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/tree.css') }}"> --}}
@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between mb-1">
            <h1 class="text-white">Retiros</h1>
            <button id="IDref"  class="btn mb-2" onclick="getlink()">ID de
                referido: {{Auth::user()->id}} <i class="fas fa-link"></i></button>
            </div>
        </div>
    </div>
    <div class="container bg-image2">
        <div class="row py-1 bg-color">
            <div class="col-md-12 retiro text-center text-white">
                <h1>Retiro solicitado </h1>
                <h1>con éxito</h1>
                <strong>Recuerda:</strong>
                <p>La solicitud estara los días viernes de <strong>8 am a 6pm.</strong>
                    <br> El mínimo de retiro son 70 USD.
                    <br> Se cobrará el 10% del total a retirar.
                    <br> Las monedas las pueden retirar cualquier día de la semana,
                </p>
                <a href="#" class="btn btn-retiros col-md-4 col-sm-12 py-1 mt-1">Ver historial de pagos</a>
            </div>
        </div>
    </div>
@endsection