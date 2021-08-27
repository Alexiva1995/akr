@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>

<script src="{{asset('assets/js/liquidaciones.js')}}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Historial de Retiros</h1>
        </div>
        <div class="col-3">
            <button id="IDref" class="btn mb-2" onclick="getlink()">ID de
                referido: {{Auth::user()->id}} <i class="fas fa-link"></i></button>
        </div>
    </div>
</div>

<div id="settlement">

    <div class="col-12 ">
        <div class="card" style="background-color:#0f1522;">
            <div class="table-responsive">
                <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">

                    <thead class="">
                        <tr class="text-center text-white">
                            <th>Nombre</th>
                            <th>Monto </th>
                            <th>Feed</th>
                            <th>Hash</th>
                            <th>Billetera</th>
                            <th>Status</th>
                            <th>Tipo de retiro</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liquidaciones as $liqui)
                        <tr class="text-center" id="contend">
                            <td>{{$liqui['fullname']}}</td>
                            <td>{{$liqui['total']}}</td>
                            <td>{{$liqui['feed']}}</td>
                            <td>{{$liqui['hash']}}</td>
                            <td>{{$liqui['wallet_used']}}</td>
                           
                          

                            @if($liqui['status'] == 0)
                            <td>
                                <a class=" btn  text-bold-600 text-white" style="background: rgba(255, 122, 0, 0.77);border-radius: 8px;">En espera</a>
                            </td>


                            @elseif($liqui['status'] == 1)
                            <td>
                                <a class=" btn  text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Aprobada</a>
                            </td>

                            @elseif($liqui['status'] == 2)
                            <td>
                                <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Rechazado</a>
                            </td>

                            @endif


                            <td>{{$liqui['tipoLiquidacion']}}</td>
                            <td>{{date('d-M-Y', strtotime($liqui['created_at']))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('settlement.componentes.modalDetalles', ['all' => false])
</div>


@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')