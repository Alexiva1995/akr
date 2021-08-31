@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')

<style>
    #IDref {
        background: #00B2A2;
        border-radius: 5px;

        font-style: normal;
        font-weight: normal;
        font-size: 15px;
        line-height: 23px;
        color: #FFFFFF !important;

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
    <div class="col-12 ">
        <div class="card" style="background-color:#0f1522;">
            <div class="table-responsive">
                <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                    <thead class="">

                        <tr class="text-center text-white ">
                            @if(Auth::user()->id == 1)
                            <th>ID</th>
                            <th>Usuario</th>
                            @endif
                            <th>Fecha</th>
                            <th>IP</th>

                        </tr>

                    </thead>
                    <tbody id="tvody">

                        @foreach ($logins as $login)
                        <tr class="text-center" id="contend">
                            @if(Auth::user()->id == 1)
                            <td>{{$login->id}}</td>
                            <td>{{$login->getUser->fullname}}</td>
                            @endif
                            <td>{{$login->created_at->format('d-m-Y')}}</td>
                            <td>{{$login->ip_address}}</td>


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
@include('layouts.componenteDashboard.optionDatatable')