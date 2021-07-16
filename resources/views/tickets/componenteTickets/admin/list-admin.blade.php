@extends('layouts.dashboard')

@section('content')

<div id="record">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <h1>Historial de Tickets</h1>
                        <br>
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">

                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Prioridad</th>
                                    <th>Accion</th>
                                </tr>

                            </thead>

                            <tbody>


                                @foreach ($ticket as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->iduser}}</td>
                                    {{-- <td>{{ $item->estado}}</td>
                                    <td>{{ $item->prioridad}}</td>
                                    <td>{{ $item->issue}}</td>
                                    --}}
                                    @if ($item->status == '0')
                                    <td> <a class=" btn btn-info text-white text-bold-600" style="background-color:red;">Abierto</a></td>
                                    @elseif($item->status == '1')
                                    <td> <a class=" btn btn-danger text-white text-bold-600">Cerrado</a></td>
                                    @endif

                                    @if ($item->priority == '0')
                                    <td> <a class=" btn btn-info text-white text-bold-600">Alto</a></td>
                                    @elseif($item->priority == '1')
                                    <td> <a class=" btn btn-success text-white text-bold-600">Medio</a></td>
                                    @elseif($item->priority == '2')
                                    <td> <a class=" btn btn-success text-white text-bold-600">Bajo</a></td>
                                    @endif
                                    <td><a href="{{ route('ticket.edit-admin',$item->id) }}" class="btn btn-secondary text-bold-600">Revisar</a></td>
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