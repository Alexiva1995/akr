@extends('layouts.dashboard')

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

<h1 class="text-white mb-2">Generacion</h1>


<div id="settlement">
    <div class="col-12">
        <div class="card" style="background-color:#0f1522;">

            <form action="{{route('liquidation.store')}}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="myTable w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                        <thead class="">
                            <tr class="text-center text-white ">
                                <th> Seleccionar</th>
                                <th>ID Usuario</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Total Comision</th>
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comisiones as $comision)
                            <tr class="text-center" id="contend">
                                <td>
                                    <input type="checkbox" value="{{$comision->iduser}}" name="listUsers[]" value="{{$comision->iduser}}">
                                </td>
                                <td>{{$comision->iduser}}</td>
                                <td>{{$comision->getWalletUser->fullname}}</td>
                                <td>{{$comision->getWalletUser->email}}</td>
                                <td>{{$comision->total}}</td>
                                <td>{{$comision->getWalletUser->status}}</td>
                                <td>
                                    <a onclick="vm_liquidation.getDetailComision({{$comision->iduser}})" class="btn btn-info">
                                        <i class="feather icon-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- @if(\Carbon\Carbon::now()->format('l') == 'Friday') --}}
                <div class="form-group text-center">
                    <button class="btn btn-primary">Generar Liquidacion</button>
                </div>
                {{-- @endif --}}
            </form>
        </div>
    </div>
</div>
</div>
@include('settlement.componentes.modalDetalles', ['all' => true])
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')