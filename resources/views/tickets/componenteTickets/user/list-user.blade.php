@extends('layouts.dashboard')

@section('content')

<div class="container">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="text-white">Soporte</h1>
        </div>
        <div class="col-6 col-md-4">
            <a href="{{ route('ticket.create')}}" style="color:#F0F0F0;background-color : #BD3900;border-radius: 5px;" class="btn  mb-2 waves-effect waves-light"><i class="feather icon-plus"></i> Crear Ticket</a>
        </div>
    </div>



    <br>

    <div id="record">
        <div class="col-12">
            <div class="card " style="background: #0F1522;
border-radius: 8px;">
                <div class="card-content ">
                    <!--contenedor de adentro-->
                    <div class="card-body card-dashboard ">
                        <div class="table-responsive">

                            <table class="table nowrap scroll-horizontal-vertical myTable table-striped w-100" >
                                <thead class="">

                                    <tr class="text-center text-white" style="background: rgba(0, 200, 244, 0.4);">
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Estado</th>
                                        <th>Prioridad</th>
                                        <th>Accion</th>
                                    </tr>

                                </thead>

                                <tbody >

                                    @foreach ($ticket as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->iduser}}</td>
                                        {{-- <td>{{ $item->estado}}</td>
                                        <td>{{ $item->prioridad}}</td>
                                        <td>{{ $item->issue}}</td>
                                        --}}


                                        @if ($item->status == '0')
                                        <td> <a class=" btn text-bold-600 text-white" style="background-color: green;">Abierto</a></td>
                                        @elseif($item->status == '1')
                                        <td> <a class=" btn  text-bold-600 text-white" style="background-color: red;">Cerrado</a></td>
                                        @endif


                                        @if ($item->priority == '0')
                                        <td> <a class="text-bold-600 text-dark">Alto</a></td>
                                        @elseif($item->priority == '1')
                                        <td> <a class="text-bold-600 text-dark">Medio</a></td>
                                        @elseif($item->priority == '2')
                                        <td> <a class="text-bold-600 text-dark">Bajo</a></td>
                                        @endif



                                        @if ($item->status == '0')
                                        <td><a href="{{ route('ticket.edit-user',$item->id) }}" class="btn  text-bold-600 text-dark" style="background-color: #0CB7F2;">Editar</a></td>
                                        @else
                                        <td><a href="{{ route('ticket.show-user',$item->id) }}" class="btn  text-bold-600 text-dark" style="background-color: #0CB7F2;">Revisar</a></td>
                                        @endif
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