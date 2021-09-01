@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Informes / Registros</h1>
            <h4 class="text-white">Registro de Inversión</h4>
        </div>

        <div class="col-3">
        <button class="btn" id="IDref" onclick="getlink()">ID de
                referido: {{ Auth::user()->id }} <i class="fa fa-link"></i>
            </button>
        </div>
    </div>

</div>
<br>
<div class="col-12 ">
    <div class="card" style="background-color:#0f1522;">
        <div class="table-responsive">
            <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                <thead>

                    <tr class="text-center text-white">
                        <th>ID de transacción</th>
                        <th>Pasarela</th>
                        <th>Monto</th>
                        <th>Despues Del Depósito</th>
                        <th>Tarifa</th>
                        <th>Estado</th>
                        <th>Tiempo</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($inver as $inve)
                    <tr class="text-center" id="contend">
                        <td># {{$inve->id}}</td>
                        
                        <td>CoinPayments</td>

                        <td>{{$inve->invertido + $inve->fee}} $</td>

                        <td>{{$inve->invertido}} $</td>

                        <td>{{$inve->fee}} $</td>

                        @if($inve->status == 1)                        
                        <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Activo</a></td>
                        @else($inve->status == 2)
                        <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Culminada</a></td>
                        @endif

                        <td>{{$inve->created_at->diffForHumans()}}</td>

                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.linkReferido')
@include('layouts.componenteDashboard.optionDatatable')