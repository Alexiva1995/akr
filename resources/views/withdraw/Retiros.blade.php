@extends('layouts.dashboard')
@include('layouts.componenteDashboard.linkReferido')
@section('content')




<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white" id="deposito">Retiros</h1>
        </div>
        <div class="col-3">
            <button class="btn mb-1 " style="background-color:#00C8F4;color: black;" onclick="getlink()">ID de
                referido: {{Auth::user()->id}} <i class="fa fa-copy"></i></button>
        </div>
    </div>
</div>

<div id="adminServices" class="mt-3">
    <div class="card card-dashboard" id="bg-screen-image">
        <div class="container" id="fondo-shadow">
            <div>
                <div>
                    <div>
                        <h1 class="text-center mt-4 mb-4" id="titulo">Selecciona El Monto A Retirar</h1>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
        <form action="">

        <div class="card-body " id="card">

            <div class="row mt-2" style="justify-content: center;">
                <div class="col-7">
                    <label id="form-label" class="form-label" for="name"><b>Tipo de Retiro</b></label>
                    <select class=" form-control mt-1" id="up" type="text" value="" placeholder="Selecciona una opción" rows="3">
                    </select>

                </div>


                    <div class="col-7 mt-2">
                        <div class="form-group">
                            <label id="form-label" class="form-label" for="issue"><b>Ingrese la Cantidad: </b></label>
                            <input type="text" id="up" class="form-control mt-1" value="" placeholder="Cantidad de monedas">

                        </div>
                    </div>

                    <div class="col-7 mb-2">
                        <label id="form-label" class="form-label" for="email"><b>Ingrese la billetera de Retiro: </b></label>
                        <input class="form-control mt-1 " value="" type="text" id="up"  rows="3" />

                    </div>
                    <div class="col-7 mb-2">
                    <button type="submit" id="sends" class="col-12 mt-2  btn mb-1 waves-effect waves-light float-right">Solicitar Retiro</button>
                    
                </div>

                <div class="col-6 mb-2">
                        <label id="limite"><b>Limite de Retiro: 70 USDT </b></label>

                    </div>

                </form>
            </div>
        </div>
    </div>





    @endsection