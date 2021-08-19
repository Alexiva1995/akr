@extends('layouts.dashboard')

@section('content')


<div class="row">
    <div class="col-md-8">
        <h1 class="text-white">Historial de Tickets</h1>
    </div>
    <!--<div class="col-6 col-md-4">
        <a id="boton-ticket" href="{{ route('ticket.list-user')}}" class="btn  mb-2 waves-effect waves-light">Volver Atrás <i class="fas fa-chevron-left"></i></a>
    </div>-->
</div>

<br>
<div id="record">
    <div class="col-12">
        <div class="table-responsive" style="border-radius: 8px 8px 0px 0px;"> 


            <table class="nowrap scroll-horizontal-vertical  table-striped w-100">
                <thead  id="thead">

                    <tr class="text-center text-white ">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Última Respuesta</th>
                        <th>Accion</th>
                    </tr>

                </thead>

                <tbody id="tvody">

                    @foreach ($ticket as $item)
                    <tr class="text-center" id="contend">
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->iduser}}</td>
                        {{-- <td>{{ $item->estado}}</td>
                        <td>{{ $item->prioridad}}</td>
                        <td>{{ $item->issue}}</td>
                        --}}

                        @if ($item->status == '0')
                        <td> <a class=" btn text-white text-bold-600" style="background-color: green;">Abierto</a></td>
                        @elseif($item->status == '1')
                        <td> <a class=" btn text-white text-bold-600" style="background-color: red;">Cerrado</a></td>
                        @endif


                        <td>asd</td>

                        <td><a href="{{ route('ticket.edit-admin',$item->id) }}" class="btn text-bold-600 text-dark" style="background-color: #0CB7F2;">Revisar</a></td>
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