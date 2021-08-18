{{-- Primeros cuadros -> Agregar paqutes - link Refedos --}}
<div class="row" >
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card text-white h-100 m-0" style="background-color:#171717; box-shadow:none;">
            <div class="card-content">
                <div class="card-body d-flex justify-content-between">                    
                    <div class="">
                        <h1 class=" text-white">Bienvenido <span style="color:#00C8F4;">{{$data['usuario']}}</span></h1>                        
                    </div>
                    <p class="card-text">
                        <button class="btn" style="background-color: #00C8F4; color: black;" onclick="getlink()">ID de referido: {{$data['id']}} <i class="fa fa-copy"></i></button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-12 mt-1 mb-1">
        <div class="card text-white  bg-red-alt2 h-100">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="container">                        
                        <form action="{{route('realizar-inversion')}}" method="POST" target="_blank" class="d-inline">                            
                            @csrf
                            <div class="">
                                <div class="range-wrap">
                                    <div class="range-container">
                                        <input type="range" class="w-100" name="range" id="range" min="70" max="10000" step="10" value="70"/>
                                        <label for="range">70$</label>
                                        @if(isset($user))
                                            <input type="hidden" class="w-100" name="user" id="user" value="{{$user->id}}"/>  
                                            <div class="custom-control custom-switch mt-1">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="comision" value="comision">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                                Generar Comisiones
                                            </div>                                        
                                        @endif
                                    </div>
                                    <br>
    
                                </div>
                                <div class="">                                  
                                    <button type="submit" class="btn float-right" style="background-color: #00C8F4; color: black;">Comprar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 mt-1 mb-1"> 
        <div class="card text-white h-100 mb-0 pb-1" style="background: #121212">
            <div class="card-content row">
                {{-- <div class="card-body d-flex justify-content-center align-items-center flex-sm-row flex-column pb-0 pt-1 col-12"> --}}
                <div class="card-body moneda">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-6 w-100 text-center">
                            <h4 class="text-white">Monedas Actuales</h4>
                        </div>
                        <div class="col-6 w-100 text-center font-size-">
                            <h4 class="text-white">Saldo en dolares</h4>                                                    
                        </div>                    
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-6 w-100 pt-1 d-flex justify-content-center">
                            <div>
                                <h1>{{50.000}} DRB</h1>
                                <button class="btn btn-saldo mt-1">Retirar</button>                                
                            </div>
                        </div>
                        <div class="col-6 w-100 pt-1 d-flex justify-content-center " style="border-left: 2px solid white">
                            <div>                            
                                <h1>{{1.000}} USDT</h1>
                                <button class="btn btn-saldo mt-1">Retirar</button>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Este es --}}
    <div class="col-lg-6 col-md-12 col-12 mt-1 mb-1">
        <div class="card text-white bg-blue h-100 mb-0">
            {{-- <div class="card-content row justify-content-center align-items-center"> --}}
                {{-- <div class="card-body d-flex justify-content-center align-items-center flex-sm-row flex-column pb-0 pt-1 col-12"> --}}
                <div class="card-sub d-flex align-items-center mt-2">
                    <div class="progresscircle blue" data-value='100'>
                        <span class="progress-left">
                            <span class="progress-circle"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-circle"></span>
                        </span>
                        <div class="progress-value">50%</div>
                    </div>
                </div>
                    <div class="d-flex justify-content-center align-items-center porcentaje">
                        <div class="col-12 w-100 text-center mt-2 mb-2">
                            <h1 class="text-white">$ 500,00</h1>
                            <span class="text-white">Estas a punto de cumplir tu meta</span>
                        </div>
                    </div>
            {{-- </div> --}}
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mt-1 mb-1"> 
        <div class="card text-white h-100 mb-0 pb-1 bg-blue" >
            <div class="card-content row">
                {{-- <div class="card-body d-flex justify-content-center align-items-center flex-sm-row flex-column pb-0 pt-1 col-12"> --}}
                <div class="card-body moneda">
                        <div class="col-6 w-100 text-left">
                            <h4 class="text-white">Referidos</h4>
                        </div>                                           
                    
                    <div class="d-flex justify-content-center">
                        <div class="col-6 w-100 pt-1 d-flex justify-content-center">
                            <div>
                                <p class="">Mes pasado</p>                                
                                <h1>{{25}}</h1>
                            </div>
                        </div>
                        <div class="col-6 w-100 pt-1 d-flex justify-content-center " style="border-left: 2px solid white">
                            <div>                            
                                <p class="">Mes Actual</p>
                                <h1>{{28}}+</h1>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mt-1 mb-1">
        <div class="card text-white bg-blue h-100 mb-0">
            <div class="card-content row justify-content-center align-items-center">
                {{-- <div class="card-body d-flex justify-content-center align-items-center flex-sm-row flex-column pb-0 pt-1 col-12"> --}}
                <div class="card-body">

                </div>
            </div>
        </div>
    </div> 

    <div class="col-lg-12 col-md-12 col-12 mt-1 mb-1"> 
        <div class="card text-white h-100 mb-0 pb-1" style="background: #121212">
            <div class="card-header d-flex align-items-center text-right pb-0 pt-0 white">
                <h5 class="mt-1 mb-0 text-white"><b>Ganancias totales</b></h5>
            </div>
                {{-- @include('dashboard.componente.partials.grafig-1') --}}
        </div>
    </div>
   
</div>

@include('layouts.componenteDashboard.optionDatatable')
