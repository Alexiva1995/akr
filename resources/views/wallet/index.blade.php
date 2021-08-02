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
                </div>

                <div class="table-responsive">
                    @include('wallet.component.tableWallet')
                    @include('layouts.componenteDashboard.modalRetiro')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')



