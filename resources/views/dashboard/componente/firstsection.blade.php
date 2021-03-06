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
                            Tu saldo actual es $ {{number_format($data['wallet'], '2', ',', '.')}} <br>
                            {{-- ¿Qué tal recargar tu saldo? --}}
                        </p>
                        
                        <br>
                        
                        @if (Auth::user()->dni == NULL)
                        <p class="m-auto w-75">
                            KYC: Sin verificar <span class="text-danger h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->dni != NULL && Auth::user()->verify == 0)
                        <p class="m-auto w-75">
                            KYC: En Revision <span class="text-warning h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->dni != NULL && Auth::user()->verify == 1)
                        <p class="m-auto w-75">
                            KYC: Verificada <span class="text-success h3">◉</span><br>
                        </p>
                        @endif

                        
                        @if (Auth::user()->status == 0)
                        <p class="m-auto w-75">
                            Estado: Inactiva <span class="text-danger h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->status == 1)
                        <p class="m-auto w-75">
                            Estado: Activa <span class="text-success h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->status == 2)
                        <p class="m-auto w-75">
                            Estado: suspendido <span class="text-warning h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->status == 3)
                        <p class="m-auto w-75">
                            Estado: bloqueado <span class="text-warning h3">◉</span><br>
                        </p>
                        @elseif (Auth::user()->status == 4)
                        <p class="m-auto w-75">
                            Estado: caducado <span class="text-warning h3">◉</span><br>
                        </p>
                        @endif
                  
                        @if (Auth::user()->dni == NULL)
                        <p class="card-text">
                            <a class="btn btn-flat-primary padding-button-short bg-white mt-1 waves-effect waves-light" href="{{ route('kyc') }}">Verificación KYC <i class="far fa-copy"></i></a>
                        </p>    
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card text-white bg-gradient-danger bg-red-alt h-100">
            <div class="card-content d-flex justify-contents-start align-items-center">
                <div class="card-body pb-0 pt-3">
                    <img src="{{asset('assets/img/sistema/card-img.svg')}}" alt="element 03" width="250" height="250"
                        class="float-right px-1">
                    <h4 class="card-text mt-3">Invita a tus amigos <br> y gana una comision</h4>
                    <p class="card-text">
                        <button class="btn btn-flat-primary padding-button-short bg-white mt-1 waves-effect waves-light" onclick="getlink()">Copiar link de referido <i class="fa fa-copy"></i></button>
                    </p>
                    <h4 class="card-title text-white">¡Todo es mejor con amigos!</h4>
                </div>
            </div>
        </div>
    </div>
</div>


