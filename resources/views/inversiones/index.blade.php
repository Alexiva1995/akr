@extends('layouts.dashboard')

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    @if($tipo == 1)
                        <h1 class="text-center">Inversiones Activas</h1>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('inversiones.index',1) }}" class="btn btn-secondary  text-bold-600 mr-1 disabled">Ver las Inversiones Activas</a> 
                            <a href="{{ route('inversiones.index',2) }}" class="btn btn-primary text-bold-600 ml-1">Ver las Inversiones Inactivas</a> 
                        </div>
                    @else
                        <h1 class="text-center">Inversiones Inactivas</h1>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('inversiones.index',1) }}" class="btn btn-primary  text-bold-600 mr-1">Ver las Inversiones Activas</a> 
                            <a href="{{ route('inversiones.index',2) }}" class="btn btn-secondary text-bold-600 ml-1 disabled">Ver las Inversiones Inactivas</a> 
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">

                            <!-- #, correo, Paquete, Estado, Fecha, Progreso, Ganancia -->

                                <tr class="text-center text-white bg-purple-alt2">                                
                                    <th>ID</th>
                                    <th>Correo</th>
                                    <th>Paquete</th>
                                    <th>Ganancia</th>
                                    <th>Progreso</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($inversiones as $inversion)

                                @php
                                $ganancia = $inversion->capital - $inversion->invertido;

                                $porcentaje = ($ganancia / $inversion->invertido) * 100;
                                @endphp
                                <tr class="text-center">
                                
                                    <td>{{$inversion->id}}</td>
                                    <td>{{$inversion->correo}}</td>
                                    <td>{{$inversion->getPackageOrden->getGroup->name }} - {{$inversion->getPackageOrden->name}}</td>
                                    <td>$ {{number_format($inversion->ganacia, 2, ',', '.')}}</td>
                                    <td>{{number_format($inversion->progreso, 2, ',', '.')}}</td>
                                    <td>{{date('Y-M-d', strtotime($inversion->fecha_vencimiento))}}</td>
                                    <td>{{$inversion->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')


