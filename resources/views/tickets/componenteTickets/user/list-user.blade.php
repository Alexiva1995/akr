@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="text-white">Soporte de tickets</h1>
        </div>
        <div class="col-3"><a id="boton-ticket" href="{{ route('ticket.create')}}" class="btn  mb-2 waves-effect waves-light"> Nuevo Ticket <i class="fas fa-ticket-alt"></i></a>
        </div>
        <div class="col-3">
            <button id="IDref" class="btn mb-2" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fas fa-link"></i></button>
        </div>
    </div>

</div>
<br>
<div class="col-12 ">
    <div class="table-responsive mt-2">
        <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
            <thead>

                <tr class="text-center text-white">
                    <th>SL</th>
                    <th>Sujeto</th>
                    <th>Estado</th>
                    <th>Última Respuesta</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($ticket as $item)
                <tr class="text-center" id="contend">
                    <td>0{{ $item->id}}</td>
                    <td>[Ticket #{{ $item->iduser}}] {{$item->issue}}</td>

                    @if ($item->status == '0')
                    <td> <a class=" btn text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Abierto</a></td>
                    @elseif($item->status == '1')
                    <td> <a class=" btn  text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Cerrado</a></td>
                    @endif

                    @if ($item->send == '')
                    <td>Esperando Respuesta</td>
                    @else
                    <td>{{$item->send}}</td>
                    @endif


                    @if ($item->status == '0')
                    <td><a href="{{ route('ticket.edit-user',$item->id) }}"><img src="{{asset('assets/Diseño/Desktop.svg')}}" alt="" width="40" height="40"></a></td>
                    @else
                    <td><a href="{{ route('ticket.show-user',$item->id) }}"><img src="{{asset('assets/Diseño/Desktop.svg')}}" alt="" width="40" height="40"></a></a></td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.linkReferido')
@include('layouts.componenteDashboard.optionDatatable')