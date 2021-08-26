@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Informes / Registros</h1>
            <h4 class="text-white">Registro de transacciones</h4>
        </div>

        <div class="col-3">
            <button id="IDref" class="btn mb-2" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fas fa-link"></i></button>
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
                        <th>Estado</th>
                        <th>Tiempo</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($transac as $transac)
                    <tr class="text-center" id="contend">
                        <td># {{$transac->id}}</td>

                        <td>CoinPayments</td>

                        <td>{{$transac->total + $transac->fee}} $</td>

                        @if($transac->status == 0)
                        <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(255, 122, 0, 0.77);border-radius: 8px;">En espera</a></td>

                        @elseif($transac->status == 1)
                        <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Aprobada</a></td>

                        @elseif($transac->status == 2)
                        <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Rechazada</a></td>

                        @endif
                        <td>{{$transac->created_at->diffForHumans()}}</td>

                        <td>Deposito</td>

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