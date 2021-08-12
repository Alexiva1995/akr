@extends('layouts.dashboard')

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

</style>
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

{{-- permite llamar las librerias montadas --}}
@push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/js/liquidaciones.js')}}"></script>
@endpush

@section('content')
<div id="settlement">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <form action="{{route('crypto.store')}}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th> Seleccionar</th>
                                    <th>ID Usuario</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cryptos as $crypto)
                                    <tr class="text-center">
                                        <td>
                                            <input type="checkbox" value="{{$crypto->iduser}}" name="listUsers[]" value="{{$crypto->iduser}}">
                                        </td> 
                                        <td>{{$crypto->iduser}}</td>
                                        <td>{{$crypto->user->fullname}}</td>
                                        <td>{{$crypto->user->email}}</td>
                                        <td>{{$crypto->total}}</td>
                                        <td>{{$crypto->status}}</td>
                                        <td>                                            
                                            <a onclick="vm_liquidation.getDetailCrypto({{$crypto->iduser}})" class="btn btn-info">
                                                <i class="feather icon-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary">Generar Liquidacion</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    % de Moneda
                </button>
            </div>
        </div>
    </div>
    @include('settlement.componentes.modalDetalles', ['all' => true])
    @include('VTR.componentes.modalDetalles', ['all' => true])
    @include('VTR.component.modal%')
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')


