@extends('layouts.dashboard')

@section('content')


<div class="row">
    <div class="col-md-8">
        <h1 class="text-white">Historial de Tickets</h1>
    </div>
  
</div>

<br>
<div id="record">
    <div class="col-12">
        <div class="table-responsive" style="border-radius: 8px 8px 0px 0px;"> 


            <table class="nowrap  scroll-horizontal-vertical  table-striped w-100">
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
                        <td># {{$item->id}}</td>
                        <td>{{ $item->name}}</td>
                        

                        @if ($item->status == '0')
                            <td> <a class=" btn text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Abierto</a></td>
                            @elseif($item->status == '1')
                            <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Cerrado</a></td>
                            @endif


                        <td>asd</td>

                        <td><a href="{{ route('ticket.edit-admin',$item->id) }}"><img src="{{asset('assets/Diseño/Desktop.svg')}}" alt="" width="40" height="40"></a></td>
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