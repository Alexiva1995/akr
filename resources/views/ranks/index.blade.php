@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Rangos</h1>
        </div>
        <div class="col-3">
        <button class="btn" id="IDref" onclick="getlink()">ID de
                referido: {{ Auth::user()->id }} <i class="fa fa-link"></i>
            </button>
        </div>
    </div>
</div>
<div class="container mt-2 bg-imagee">
    <div class="row py-2 px-2">
        @foreach ($rangos as $rango)
           <div class="col-md-3">
               <div class="row">
                   <div class="my-1 bg-image2" style="width: 90%;">
                       <div class="bg-rank pt-4 pb-4">
                        <a href="" class="btn btn-rank">?</a>
                        <div class="m-auto circle-rango"
                        ></div>
                           <h6 class="pt-2 text-center text-white font-weight-bold">{{$rango->name}}</h6>
                       </div>
                   </div>
               </div>
            </div> 
        @endforeach
    </div>
</div>

@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')