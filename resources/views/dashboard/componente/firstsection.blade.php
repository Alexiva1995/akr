
<div class="row">
    {{-- Bienvenido --}}


    <div class="col-lg-12 col-md-12 col-12">
        <div class="card text-white h-100 m-0" style="background-color:#171717; box-shadow:none;">
            <div class="card-content">
                <div class="card-body d-flex justify-content-between">
                    <div class="">
                        <h1 class=" text-white">Bienvenido <span style="color:#00C8F4;">{{ $data['usuario'] }}</span>
                        </h1>
                    </div>
                    <div class="d-flex">
                        @if (Auth::user()->binary_side_register == 'I')                    
                            <div class="d-flex justify-content-center grupo mr-1">
                                <a href="#" class="btn btn-inactivo text-white text-bold-600" v-on:click="updateBinarySide('D')">Derecha</a> 
                                <a href="#" class="btn btn-activo text-white text-bold-600 disabled">Izquierda</a> 
                            </div>                    
                        @else
                            <div class="d-flex justify-content-center grupo mr-1">
                                <a href="#" class="btn btn-activo text-white text-bold-600 disabled">Derecha</a> 
                                <a href="#" class="btn btn-inactivo text-white text-bold-600" v-on:click="updateBinarySide('I')">Izquierda</a> 
                            </div>                    
                        @endif  
                        <button class="btn" style=" background: #00B2A2;
                            border-radius: 5px;
                           
                            font-style: normal;
                            font-weight: normal;
                            font-size: 15px;
                            line-height: 23px;
                            color: #FFFFFF 
                            !important;" onclick="getlink()">ID de
                            referido: XXXX {{ $data['id'] }} <i class="fa fa-link"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Realizar compra --}}
    <div class="col-lg-12 col-md-12 col-12 mt-1 mb-1">
        <div id="adminServices">
            <div class="card card-dashboard" id="bg-screen-image">
                <div class="container" id="fondo-shadow">
                    
                    <form action="{{ route('realizar-inversion') }}" method="POST" target="_blank" class="d-inline">                    
                    @csrf
                    <div class="form-group mb-0">
                        <div class="range-wrap">
                            <div class="range-container py-4">
                                <a href="#" class="btn" id="btn-iniciar">Iniciar</a>
                                <input class="rango" type="range" name="range" id="range" min="70" max="10000"
                                value="70" step="10" 
                                style="width: 70%"
                                />

                                <output class="range-slider">70 USD</output>
                                <button type="submit" 
                                class="btn btn-comprar text-dark float-right px-1"
                                style="background-color:#08C5B9;font-weight:600;"
                                >COMPRAR</button>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    {{-- Espacio para saldo, referidos y rango --}}
    <div class="col-lg-7 col-md-12 col-12 mt-1 mb-1">
        <div class="row">
            {{-- Monedas y saldo --}}
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card text-white h-100 mb-0 pb-1" style="background: #121212">
                    <div class="card-content row">
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
                                        <h1>{{number_format($data['crypto'], '2', ',', '.')}} DRB</h1>
                                        <a href={{route('retirar')}} class="btn btn-saldo mt-1">Retirar</a>
                                    </div>
                                </div>
                                <div class="col-6 w-100 pt-1 d-flex justify-content-center "
                                    style="border-left: 2px solid white">
                                    <div>
                                        <h1>{{number_format($data['wallet'], '2', ',', '.')}} USDT</h1>
                                        <a href={{route('retirar')}} class="btn btn-saldo mt-1">Retirar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Rangos --}}
            <div class="col-lg-6 col-md-6 col-12 mt-1">
                <div class="card text-white bg-blue h-100 mb-0">
                    <div class="card-content row h-100">
                            <div class="col-12 w-100 text-left">
                                <h4 class="text-white mt-1 ml-1">Rango Actual</h4>
                            </div>
                            <div class="m-auto"
                                style="width: 150px; height: 150px; border-radius: 100px; background: rgba(5, 156, 189, 1); border: 3px solid white;"
                            ></div>
                            <div class="col-12 d-flex justify-content-between align-items-end"
                            style="margin-top: -10px"
                            >
                                <a>&nbsp;&nbsp;< Anterior</a>
                                <a>Próximo >&nbsp;&nbsp;</a>
                            </div>

                    
                    </div>
                </div>
            </div>
            {{-- Referidos --}}
            <div class="col-lg-6 col-md-6 col-12 mt-1">
                <div class="card text-white h-100 mb-0 pb-1 bg-blue">
                    <div class="card-content row">
                        <div class="card-body moneda">
                            <div class="col-6 w-100 text-left">
                                <h4 class="text-white">Referidos</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="col-6 w-100 pt-1 d-flex justify-content-center">
                                    <div>
                                        <p class="">Mes pasado</p>
                                        <h1>{{ $data['directos'] }}</h1>
                                    </div>
                                </div>
                                <div class="col-6 w-100 pt-1 d-flex justify-content-center "
                                    style="border-left: 2px solid white">
                                    <div>
                                        <p class="">Mes Actual</p>
                                        <h1>{{ $data['indirectos'] }}+</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Porcentaje --}}
    <div class="col-lg-5 col-md-12 col-12 mt-1 mb-1">
        <div class="card text-white bg-blue h-100 mb-0">
            <div class="card-sub d-flex align-items-center mt-2">
                <div class="progresscircle blue" data-value={{$data['porcentaje']}}>
                    <span class="progress-left">
                        <span class="progress-circle"></span>
                    </span>
                    <span class="progress-right">
                        <span class="progress-circle"></span>
                    </span>
                    <div class="progress-value">{{$data['porcentaje'].'%'}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center porcentaje">
                <div class="col-12 w-100 text-center mt-2 mb-1">
                    <h1 class="text-white">$ {{number_format($data['inversion'], '2', ',', '.')}}</h1>
                    <span class="text-white">Monto de tu inversión</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Ganancias totales --}}
    <div class="col-lg-12 col-md-12 col-12 mt-1 mb-1">
        <div class="card text-white h-100 mb-0 pb-1" style="background: #121212">
            <div class="card-header d-flex align-items-center text-right pb-0 pt-0 white">
                <h5 class="mt-1 mb-0 text-white"><b>Ganancias totales</b></h5>
            </div>
            @include('dashboard.componente.partials.grafig-1')
        </div>
    </div>
</div>

@include('layouts.componenteDashboard.optionDatatable')

@push('custom_js')
<script>
    let slider = document.querySelector(".rango");
    let output = document.querySelector(".range-slider");

    function decimalSeparator(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    slider.oninput = function() {
        output.textContent = `${decimalSeparator(this.value)} USD`;
    };
</script>
@endpush
