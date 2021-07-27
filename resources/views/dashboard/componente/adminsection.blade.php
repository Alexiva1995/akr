{{-- Primeros cuadros -> Agregar paqutes - link Refedos --}}
<div class="row">
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card bg-analytics bg-purple-alt2 text-white h-100">
            <div class="card-content">
                <div class="card-body text-center">
                    <img src="{{asset('assets/img/sistema/ban-der.svg')}}" class="img-left" alt="card-img-left">
                    <img src="{{asset('assets/img/sistema/ban-izq.svg')}}" class="img-right" alt="card-img-right">
                    <img src="{{asset('assets/img/sistema/confe-der.svg')}}" class="img-left" alt="card-img-left"
                        style="height: 100%">
                    <img src="{{asset('assets/img/sistema/confe-izq.svg')}}" class="img-right" alt="card-img-right"
                        style="height: 100%">
                    <div class="avatar avatar-xl bg-primary shadow m-0 mb-1">
                        <img src="{{asset('assets/img/sistema/favicon.png')}}" alt="card-img-left">
                        {{-- <div class="avatar-content">
                         <i class="feather icon-award white font-large-1"></i> 
                        </div> --}}
                    </div>
                    <div class="text-center">
                        <h1 class="mb-2 text-white">Bienvenido {{$data['usuario']}}</h1>
                        <p class="m-auto w-75">
                            {{-- <a href="{{route('package.index')}}" target=""
                                class="btn btn-flat-primary padding-button-short bg-white mt-1 waves-effect waves-light">
                                Agregar Paquete
                            </a> --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card text-white bg-gradient-danger bg-red-alt h-100">
            <div class="card-content row justify-content-center align-items-center">
                <div class="card-body d-flex justify-content-center align-items-center flex-sm-row flex-column pb-0 pt-1 col-12">
                    <div class="order-1 order-md-2">
                        <img src="{{asset('assets/img/sistema/card-img.svg')}}" alt="element 03" width="250" height="250"
                        class=" px-1">
                    </div>

                    <div class="order-2 order-md-1">
                        <p class="card-text mt-3">Invita a tus amigos <br> y gana una comision</p>
                        <h4 class="card-title text-white">¡Todo es mejor con <br> amigos!</h4>
                        <p class="card-text">
                            <button class="btn btn-flat-primary padding-button-short bg-white mt-1 waves-effect waves-light" onclick="getlink()">Copiar link de referido <i class="fa fa-copy"></i></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-12 col-12 mt-1">
    <div class="card text-white bg-gradient-danger bg-red-alt h-100">
        <div class="card-content">
            <div class="card-body pb-0">
                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 white">
                    <h5 class="mt-1 mb-0 text-white"><b>Lado Binario</b></h5>
                </div>
            </div>

            <div class="card-sub ml-3">
                <h1 class="text-warning text-bold-700">
                    @if (Auth::user()->binary_side_register == 'I')
                    IZQUIERDA
                    @else
                    DERECHA
                    @endif
                </h1>
            </div>

            <div class="mt-4">
                @if (Auth::user()->binary_side_register == 'I')                    
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn bg-white text-black text-bold-600 mr-1" v-on:click="updateBinarySide('D')">Derecha</a> 
                        <a href="#" class="btn bg-black text-white text-bold-600 ml-1 disabled"  >Izquierda</a> 
                    </div>                 
                @else
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn bg-white text-black  text-bold-600 mr-1 disabled">Derecha</a> 
                        <a href="#" class="btn bg-black text-white text-bold-600 ml-1"  v-on:click="updateBinarySide('I')">Izquierda</a> 
                    </div>                    
                @endif    
            </div>
            </div>                

        </div>
    </div>
</div>

<!-- {{-- Segundo Cuadros -> Graficas de Comisiones e inversiones --}}
<div class="row">
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card text-white h-100">
            <div class="card-content">
                <div class="card-body">
                    <div id="gcomisiones"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card h-100">
            <div class="card-content">
                <div class="card-body">
                    <div id="ginversiones" class="mx-auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tercer Cuadro Cuadros -> Ordenes de Compra --}}
<div class="row">
    <div class="col-12 mt-1">
        <div class="card text-white h-100">
            <div class="card-content">
                <div class="card-body text-center">
                    <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped"
                        data-order='[[ 1, "asc" ]]'>
                        <thead class="h-100">

                            <tr class="text-center text-white bg-purple-alt2">
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Grupo</th>
                                <th>Paquete</th>
                                <th>ID de Transación</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Fecha de Creación</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($data['ordenes'] as $orden)
                            <tr class="text-center">
                                <td>{{$orden->id}}</td>
                                <td>{{$orden->name}}</td>
                                <td>{{$orden->grupo}}</td>
                                <td>{{$orden->paquete}}</td>
                                <td>{{$orden->idtransacion}}</td>
                                <td>{{$orden->total}}</td>

                                @if ($orden->status == '0')
                                <td> <a class=" btn btn-info text-white text-bold-600">Esperando</a></td>
                                @elseif($orden->status == '1')
                                <td> <a class=" btn btn-success text-white text-bold-600">Aprobado</a></td>
                                @elseif($orden->status >= '2')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Cancelado</a></td>
                                @endif

                                <td>{{date('Y-M-d', strtotime($orden->created_at))}}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->

@include('layouts.componenteDashboard.optionDatatable')
