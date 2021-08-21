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
                    referido: {{ Auth::user()->id }} <i class="fa fa-copy"></i></button>
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
                    {{-- <br> --}}
                </div>
            </div>
            <form action="{{ route('retiros')}}" method="POST">
                @csrf
                <div class="card-body " id="card">
                    <div class="row mt-2" style="justify-content: center;">
                        <div class="col-md-7 col-sm-12">
                            <label id="form-label" class="form-label" for="name"><b>Tipo de Retiro</b></label>
                            <select class=" form-control mb-1" id="up" type="text" name="tipo" required>
                                <option selected value="">Selecciona una opcion </option>
                                <option value="USDT">Retirar USDT</option>
                                <option value="DRM">Retirar DRM</option>
                              
                            </select>
                        </div>

                        <div class="col-md-7 col-sm-12 mb-2">
                            <label id="form-label" class="form-label" for="email"><b>Ingrese la billetera de Retiro:
                                </b></label>
                            <input 
                                class="form-control" 
                                type="text" 
                                id="up" 
                                name="billetera" 
                                placeholder="{{Auth::user()->wallet_address}}" 
                                value="{{Auth::user()->wallet_address}}"
                            />
                        </div>
                        <div class="col-md-7 col-sm-12 mb-2">
                            <button type="submit" id="sends"
                                class="col-12 mt-2  btn mb-1 waves-effect waves-light float-right">Solicitar Retiro
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>





@endsection
