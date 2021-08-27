{{-- @extends('layouts/contentLayoutMaster') --}}
@extends('layouts.dashboard')

@section('title', 'Flujo de Ganancia')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<style type="text/css">
    #table_detalle {
        overflow-y: hidden;
        overflow-x: auto;
        width: auto;
        height: 50px;
        padding: 10px;
        white-space: nowrap;
    }

    .colu {
        width: 18%;
    }

    @media only screen and (max-width: 768px) {
        .colu {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

<h1 class="text-white mb-2">Flujo De Ganancias</h1>

<div id="record">
<div class="col-12 ">
    <div class="card" style="background-color:#0f1522;">

        <div class="row match-height d-flex justify-content-around  mx-2">

            <div class="colu mt-2">
                <div class="card btn-warning text-center">
                    <p class="card-title my-2">Ganancia Total</p>
                    <span class="font-large-1 font-weight-bolder">{{number_format($ingreso+$fee - $comision-$retiro,2,".",",")}}</span>
                </div>
            </div>

            <div class="colu mt-2">
                <div class="card btn-primary text-center">
                    <p class="card-title my-2">Ingreso</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($ingreso, 2, ".",",")}}</span>
                </div>
            </div>

            <div class="colu mt-2">
                <div class="card btn-primary text-center">
                    <p class="card-title my-2">Comisión</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($comision, 2, ".",",")}}</span>
                </div>
            </div>

            <div class="colu mt-2">
                <div class="card btn-primary text-center">
                    <p class="card-title my-2">Retiro</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($retiro,2,".",",")}}</span>
                </div>
            </div>
            <div class="colu mt-2">
                <div class="card btn-primary text-center">
                    <p class="card-title my-2">Fee</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($fee,2,".",",")}}</span>
                </div>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body card-dashboard">
                {{-- <h1 href="#" class="btn btn-primary float-right mb-0 waves-effect waves-light">Comisiones sin liquidar: {{$user}}</h1> --}}
                <div class="table-responsive">
            <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                        <thead >
                            <tr class="text-center text-white ">
                                <th>ID</th>
                                <th>Tipo de Transaccion</th>
                                <th>Correo del usuario al que pertenece</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profit as $val => $item)
                            <tr class="text-center" id="contend">
                                <td>{{$item->id}}</td>
                                @if ($item->tipo_transaction == '0')
                                <td> <a class="btn btn-info text-white">Comision</a></td>
                                @else
                                <td> <a class=" btn btn-success text-white">Retiro</a></td>
                                @endif
                                <td>{{$item->getWalletUser->email}}</td>
                                <td> {{$item->monto}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')