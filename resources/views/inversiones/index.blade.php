@extends('layouts.dashboard')

@section('content')

<h1 class="text-white mb-2">inversiones</h1>


<div id="logs-list">
    <div class="col-12">
        <div class="card" style="background-color:#0f1522;">

            <div class=" card-dashboard">
                @if($tipo == 1)

                <div class="d-flex float-right">
                    <a href="{{ route('inversiones.index',1) }}" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;" class="btn text-white  text-bold-600 mr-1 "> Activas</a>

                    <a href="{{ route('inversiones.index',2) }}" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;" class="btn text-white text-bold-600 ml-1"> Culminadas</a>
                </div>
                @else

                <div class="d-flex float-right">
                    <a href="{{ route('inversiones.index',1) }}" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;" class="btn text-white text-bold-600 mr-1"> Activas</a>

                    <a href="{{ route('inversiones.index',2) }}" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;" class="btn text-white  text-bold-600 ml-1 "> Culminadas</a>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                        <thead class="">

                            <!-- #, correo, Paquete, Estado, Fecha, Progreso, Ganancia -->

                            <tr class="text-center text-white">
                                <th>ID</th>
                                <th>Correo</th>
                                <th>Monto</th>
                                <th>Ganancia</th>

                                <th>Fecha</th>
                                {{-- <th>Estado</th> --}}
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($inversiones as $inversion)
                            @php
                            $ganancia = $inversion->capital - $inversion->invertido;
                            $porcentaje = ($ganancia / $inversion->invertido) * 100;
                            @endphp
                            <tr class="text-center" id="contend">
                                <td>{{$inversion->id}}</td>
                                <td>{{$inversion->correo}}</td>
                                <td>{{number_format($inversion->capital,2,',','.')}}</td>
                                <td>$ {{number_format($inversion->ganacia, 2, ',', '.')}}</td>

                                <td>{{date('Y-M-d', strtotime($inversion->created_at))}}</td>
                                {{-- <td>{{$inversion->status}}</td> --}}
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