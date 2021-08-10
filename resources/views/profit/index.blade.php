{{-- @extends('layouts/contentLayoutMaster') --}}
@extends('layouts.dashboard')

@section('title', 'Flujo de Ganancia')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<style type="text/css">

    #table_detalle{
        overflow-y: hidden; 
        overflow-x: auto;
        width: auto;
        height: 50px;
        padding: 10px;
        white-space: nowrap;
    }

    .colu{
        width: 18%;
    }

    @media only screen and (max-width: 768px){
        .colu{
        width: 100%;
    }
    }


</style>
@endpush

@section('content')

<div id="record">
    <div class="card col-12">

        <div class="row match-height d-flex justify-content-around  mx-2">
            
            <div class="colu mt-2">
                <div class="card btn-warning text-center">
                    <p class="card-title my-2">Ganancia Total</p>
                    <span class="font-large-1 font-weight-bolder">{{number_format($ingreso - $comision-$retiro,2,".",",")}}</span>
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
                    <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                        <thead class="thead-primary">
                            <tr class="text-center text-white bg-purple-alt2">
                                <th>ID</th>
                                <th>Tipo de Transaccion</th>
                                <th>Correo del usuario al que pertenece</th>
                                <th>Monto</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($profit as $val => $item)
                            <tr class="text-center">
                                <td>{{$item->id}}</td>
                                @if ($item->tipo_transaction == '0')
                                <td> <a class=" badge badge-info text-white">Comision</a></td>
                                @else
                                <td> <a class=" badge badge-success text-white">Retiro</a></td>
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

