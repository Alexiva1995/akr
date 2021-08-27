@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
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

<h1 class="text-white mb-2">Pendientes AKR</h1>

<div id="settlement">
    <div class="col-12 ">
        <div class="card" style="background-color:#0f1522;">
            <div class="table-responsive">
            <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                    <thead >
                        <tr class="text-center text-white ">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad </th>
                            <th>Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cryptos as $crypto)
                        <tr class="text-center" id="contend">
                            <td>{{$crypto->id}}</td>
                            <td>{{$crypto->fullname}}</td>
                            <td>{{$crypto->total}}</td>
                            <td>{{date('Y-M-d', strtotime($crypto->created_at))}}</td>
                            <td>
                                <button class="btn btn-info" onclick="vm_liquidation.getDetailCryptoLiquidation({{$crypto->id}})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn btn-success" onclick="vm_liquidation.getDetailCryptoLiquidationStatus({{$crypto->id}}, 'aproved')">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button class="btn btn-danger" onclick="vm_liquidation.getDetailCryptoLiquidationStatus({{$crypto->id}}, 'reverse')">
                                    <i class="fa fa-reply"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('VTR.componentes.modalDetalles', ['all' => true])
@include('VTR.componentes.modalAction')
</div>


@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')