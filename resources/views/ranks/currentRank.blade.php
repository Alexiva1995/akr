@php
    if($user->rank_id > 0){
        $porc = ($porcentaje < 100) ? $porcentaje : 100;
        $pf = $rango2->points-$user->point_rank;
        $puntosFaltantes  = $pf > 0 ? $pf : 0;
    }else{
        $puntosFaltantes = 0;
        $porc = 0;
    }
@endphp

@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Mi Rango Actual</h1>
        </div>
    </div>
</div>
<div class="container mt-2 bg-imagee">
    <div class="row py-4 px-4">
        <div class="bg-rango pt-4 d-flex justify-content-center">
            <div class="text-center w-75 pb-4">
                <div class="m-auto circle-rango2"></div>
                <h2 class="mt-2">Rango Actual</h2>
                <h1>{{$rango}}</h1>
                <h2>Puntos faltantes para tu siguiente rango</h2>

                <div class="d-flex justify-content-around mt-2">
                    <h2>Puntos obtenidos: {{$user->point_rank}}</h2>
                    <h2>Puntos faltantes: {{$puntosFaltantes}}</h2>
                </div>

                  <div class="progress" style="height: 30px;">
                    <div class="progress-bar" role="progressbar" 
                        style="width: {{$porc}}%; background-color: rgba(5, 156, 189, 1); font-size: 1.5rem" 
                        aria-valuenow="{{$porc}}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        {{ $porc}}%
                    </div>
                  </div>

            </div>
        </div>
    </div>
</div>

@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')