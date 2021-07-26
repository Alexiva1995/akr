@extends('layouts.dashboard')

{{-- contenido --}}
@section('content')
<div class="col-12">
    <div class="card bg-lp">

        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="float-right row no-gutters" style="width: 30%;">
                    <div class="col-md-6 ">
                        <span class="font-weight-bold mb-2">Saldo: {{number_format($saldoDisponible,2)}}$</span>
                    </div>


                    {{--@if(\Carbon\Carbon::now()->isFriday())--}}
                    <button type="submit" class="btn btn-primary mb-2" id="retiro" data-toggle="modal" data-target="#modalSaldo">Retirar</button>
                    {{--@endif--}}


                    <div class="col-12 col-md-4">
                        <form action="{{route('liquidation.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="listUsers[]" value="{{Auth::user()->id}}">
                            <input type="hidden" name="tipo" value="user">

                    </div>
                </div>

                <div class="table-responsive">
                    @include('wallet.component.tableWallet')
                </div>
            </div>


            <!-- MODAL PARA RETIRAR SALDO DISPONILE -->

            <div class="modal fade" id="modalSaldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Retiro</h5>
                            <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                &times;
                            </button>
                        </div>
                        <br>
                        <form method="POST" action="{{route('RetirarFondo')}}">                            
                        @csrf
                             <input type="hidden" name="id" value="{{Auth::id()}}">

                            <div class="modal-body ">
                                <p>¿Seguro Que Desea Retirar Lo Fondos?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit" class="btn btn-primary">Retirar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')