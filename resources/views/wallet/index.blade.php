@extends('layouts.dashboard')

{{-- contenido --}}
@section('content')
<div class="col-12">
<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Wallet</h1>
        </div>

        <div class="col-3">
        <button class="btn" id="IDref" onclick="getlink()">ID de
                referido: {{ Auth::user()->id }} <i class="fa fa-link"></i>
            </button>
        </div>
    </div>
</div>
        
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="float-right row no-gutters" style="width: 30%;">
                    <div class="col-md-6 ">
                        <span class="font-weight-bold mb-2">Saldo: {{number_format($saldoDisponible,2)}}$</span>
                    </div>

                    @if(\Carbon\Carbon::now()->isFriday())
                    <button type="submit" class="btn btn-primary mb-2" id="retiro" data-toggle="modal" data-target="#modalSaldo">Retirar</button>
                    @endif
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



