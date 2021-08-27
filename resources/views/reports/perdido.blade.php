@extends('layouts.dashboard')

@section('content')

<h1 class="text-white mb-2">Ordenes</h1>

<div id="logs-list">
    <div class="col-12 ">
        <div class="card" style="background-color:#0f1522;">
            <div class="table-responsive">
                <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                    <thead >

                        <tr class="text-center text-white">
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Monto</th>
                            <th>Fee</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>
                    <tbody>

                        @foreach ($ordenes as $orden)
                        <tr class="text-center" id="contend">
                            <td>{{$orden->id}}</td>
                            <td>{{$orden->name}}</td>
                            <td>{{$orden->total}}</td>
                            <td>{{$orden->fee}}</td>

                            @if(Auth::user()->admin == '1')
                            @if ($orden->status == '0')
                            <td> <a class=" btn btn-info text-white text-bold-600" data-toggle="modal" data-target="#ModalStatus{{$orden->id}}">Esperando</a></td>
                            @endif
                            @else
                            @if ($orden->status == '0')
                            <td> <a class=" btn btn-info text-white text-bold-600">Esperando</a></td>
                            @endif
                            @endif

                            @if($orden->status == '1')
                            <td> <a class=" btn btn-success text-white text-bold-600">Aprobado</a></td>
                            @elseif($orden->status >= '2')
                            <td> <a class=" btn btn-danger text-white text-bold-600">Cancelado</a></td>
                            @endif

                            <td>{{date('Y-M-d', strtotime($orden->created_at))}}</td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="ModalStatus{{$orden->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('cambiarStatus') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <input type="hidden" name="id" value="{{$orden->id}}">
                                            ¿Desea cambiar es estatus de la orden?
                                            <br>
                                            <label>Seleccione el estado</label>
                                            <select name="status" required class="form-control">
                                                <option value="">Seleccione un estado</option>
                                                <option value="1">Aprobado</option>
                                                <option value="2">Rechazado</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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