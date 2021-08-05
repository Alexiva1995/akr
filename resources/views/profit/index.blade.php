{{-- @extends('layouts/contentLayoutMaster') --}}
@extends('layouts.dashboard')

@section('title', 'Flujo de Ganancia')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/additional/data-tables/dataTables.min.css')}}">
@endsection

@section('content')

<div id="record">
    <div class="card col-12">

        <div class="row match-height">
            
            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-warning text-center mx-2">
                    <p class="card-title my-2">Ganancia Total</p>
                    <span class="font-large-2 font-weight-bolder">{{number_format($comision-$retiro,2,".",",")}}</span>
                </div>
            </div>
            
            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-primary text-center mx-2">
                    <p class="card-title my-2">Comisión</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($comision, 2, ".",",")}}</span>
                </div>
            </div>

            <div class="col-md-4 col-12 mt-2">
                <div class="card btn-primary text-center mx-2">
                    <p class="card-title my-2">Retiro</p>
                    <span class="font-large-1 font-weight-bold">{{number_format($retiro,2,".",",")}}</span>
                </div>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body card-dashboard">
                    {{-- <h1 href="#" class="btn btn-primary float-right mb-0 waves-effect waves-light">Comisiones sin liquidar: {{$user}}</h1> --}}
                <div class="table-responsive">
                    <table id="mytable" class="table nowrap scroll-horizontal-vertical myTable table-striped" data-order='[[ 1, "asc" ]]' data-page-length='10'>
                        <thead class="thead-primary">
                            <tr class="text-center text-white bg-purple-alt2">
                                <th>ID</th>
                                <th>Tipo de Transaccion</th>
                                {{-- <th>Correo del usuario al que pertenece</th> --}}
                                <th>Monto</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($profit as $val => $item)
                            <tr class="text-center">
                                <td>{{$item->id}}</td>
                                @if ($item->type_transaction == '0')
                                <td> <a class=" badge badge-info text-white">Comision</a></td>
                                @else
                                <td> <a class=" badge badge-success text-white">Retiro</a></td>
                                @endif
                                {{-- <td>{{$correos[$val]}}</td> --}}
                                <td> {{$item->amount}} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@section('page-script')

<script src="{{ asset('js/additional/data-tables/dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#mytable').DataTable({
            //dom: 'flBrtip',
            responsive: true,
            searching: false,
            ordering: true,
            paging: true,
            select: true,
        });
    });

</script>
@endsection
