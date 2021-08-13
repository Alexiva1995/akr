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
<div id="AKR">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad </th>                                   
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indexs as $index)
                                <tr class="text-center">
<<<<<<< HEAD
                                    <td>{{$index->id}}</td>
                                    <td></td>
                                    <td>{{$crypto->cantidad}}</td>                                    
                                    <td>{{$crypto->status}}</td>
                                    <td>{{date('Y-M-d', strtotime($crypto->created_at))}}</td>
                                    <td>
                                        <button class="btn btn-info" onclick="v_liquidation.getDetailComisionLiquidation({{$crypto->id}})">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-success" onclick="v_liquidation.getDetailComisionLiquidationStatus({{$crypto->id}}, 'aproved')">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="v_liquidation.getDetailComisionLiquidationStatus({{$crypto->id}}, 'reverse')">
=======
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
>>>>>>> cb6bf521fe46c8ef3d447688ac35c21742a63959
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
<<<<<<< HEAD
    @include('VTR.componentes.modalDetalles', ['all' => false])
=======
    @include('VTR.componentes.modalDetalles', ['all' => true])
>>>>>>> cb6bf521fe46c8ef3d447688ac35c21742a63959
    @include('VTR.componentes.modalAction')
</div>


@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
