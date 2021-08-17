@extends('layouts.dashboard')

@section('content')

<style>
    #boton-ticket {
        background: #BD3900;
        border-radius: 5px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 15px;
        color: #fff;;
    }
</style>
<div class="container">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="text-white">Soporte</h1>
        </div>
        <div class="col-6 col-md-4">
            <a id="boton-ticket" href="{{ route('ticket.create')}}" class="btn  mb-2 waves-effect waves-light"> Nuevo Ticket <i class="fas fa-ticket-alt"></i></a>
        </div>
    </div>


    <br>

    <div id="record">
        <div class="col-12">
            <div class="card">
                <div class="card-content ">
                    <!--contenedor de adentro-->
                    <div class="card-body card-dashboard ">
                        <div class="table-responsive">

                            <table class="table nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                <thead class="">

                                    <tr class="text-center text-white">
                                        <th>SL</th>
                                        <th>Sijeto</th>
                                        <th>Estado</th>
                                        <th>Ultima Respuesta</th>
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