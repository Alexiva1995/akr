@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Informes / Registros</h1>
            <h4 class="text-white">Registro de Binario</h4>
        </div>

        <div class="col-3">
            <button id="IDref" class="btn mb-2" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fas fa-link"></i></button>
        </div>
    </div>

</div>
<br>
<div class="col-12 ">
    <div class="card" style="background-color:#0f1522;">
        <div class="table-responsive">
            <table class="nowrap myTable scroll-horizontal-vertical   table-striped w-100">
                <thead>

                    <tr class="text-center text-white">
                        <th>Pago De lado Izquierdo</th>
                        <th>Pago De lado Derecho</th>
                        <th>Libre Izquierda</th>
                        <th>Libre Derecho</th>
                        <th>Usuario</th>

                    </tr>
                </thead>
                <tbody>


                    <tr class="text-center" id="contend">
                        <td># 1</td>

                        <td># 1</td>

                        <td>2</td>

                        <td>1250</td>


                        <td>12 min</td>



                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.linkReferido')
@include('layouts.componenteDashboard.optionDatatable')