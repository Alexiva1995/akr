@extends('layouts.dashboard')

@section('content')

<style>
    #IDref{
        background: #00B2A2;
        border-radius: 5px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 23px;
        color: #000000 !important;

    }
</style>
<div class="container">
    <div class="col-12">
        <div class="row d-flex justify-content-between mb-1">
            <h1 class="text-white">Historial del inicio de sesión</h1>
            <button class="btn" id="IDref" onclick="getlink()">ID de
                referido: {{ Auth::user()->id }} <i class="fa fa-link"></i>
            </button>
        </div>
    </div>
</div>
<div id="logs-list">
    <div class="col-12">
        <div class="card bg-lp">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">

                                <tr class="text-center text-white bg-purple-alt2">        
                                    @if(Auth::user()->id == 1)                        
                                        <th>ID</th>
                                        <th>Usuario</th>
                                    @endif
                                    <th>Fecha</th>
                                    <th>IP</th>
                                    <th>Localización</th>
                                    <th>Navegador</th>
                                    <th>SO</th>
                                    
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($logins as $login)
                                <tr class="text-center">
                                    @if(Auth::user()->id == 1)
                                        <td>{{$login->id}}</td>
                                        <td>{{$login->getUser->fullname}}</td>
                                    @endif
                                    <td>{{date('Y-M-d', strtotime($login->created_at))}}</td>
                                    <td>{{$login->ip_address}}</td>
                                    <td>{{$login->location}}</td>
                                    <td>{{$login->browser}}</td>
                                    <td>{{$login->so}}</td>
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


