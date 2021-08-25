@section('content')


<div class="container">
    <div class="row">
        <div class="col-9">
            <h1 class="text-white">Depositos</h1>
        </div>
        <div class="col-3">
            <button class="btn mb-2 " id="IDref" onclick="getlink()">ID de
                referido: XXXX {{Auth::user()->id}} <i class="fa fa-link"></i></button>
        </div>
    </div>
</div>

<div id="adminServices" class="mt-2">
    <div class="card card-dashboard " id="bg-screen-image">
        <div class="container " id="fondo-shadow">
            @if (isset($user))
            <h1 class="text-center mt-1 mb-4">Verificar Usuario #{{ $user->id . ' - ' . $user->fullname }}</h1>
            <form action="{{ route('realizar-inversion')}}" method="POST" class="d-inline">
                @else
                <form action="{{ route('realizar-inversion') }}" method="POST" target="_blank" class="d-inline">
                    @endif

                    @csrf
                    <div class="form-group ">
                        <div class="range-wrap">
                            <div class="range-container ">
                                <h1 class="text-center mt-3 mb-2" id="titulo">Selecciona El Monto A Depositar</h1>

                                <a href="#" class="btn" id="btn-iniciar">Iniciar</a>
                                <input class="range" type="range" name="range" id="range" min="70" max="10000" value="70" step="10" />

                                <output class="range-slider">70</output>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
        </div>


        <div class="card-body" id="card">
            <h2 class="text-center mt-3 mb-2 text-white" id="total-a-pagar">Total a Pagar : $ <span class="range-slider__value">70</span> USD</h2>

            @if (isset($user))
            <input type="hidden" class="w-100" name="user" id="user" value="{{ $user->id }}" />
            <div class="custom-control custom-switch mt-1">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="comision" value="comision">
                <label class="custom-control-label" for="customSwitch1"></label>
                Generar Comisiones
                @endif

                <br>

                <div class="d-flex justify-content-center  mb-5">
                    @if (isset($user))
                    <a href="{{ route('users.list-user') }}" type="btn" class="btn btn-danger mr-2">Regresar</a>
                    @endif
                    <button type="submit" class="btn text-dark float-right" style="background-color:#08C5B9;font-weight:600;">PAGAR VÍA COINPAYMENTS</button>
                </div>
            </div>

        </div>

        </form>


        <!--script del input range-->
        <script>
            let slider = document.querySelector(".range");
            let outputEl = document.querySelector(".range-slider__value");
            let output = document.querySelector(".range-slider");

            function decimalSeparator(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            outputEl.textContent = `${decimalSeparator(slider.value)}`;

            slider.oninput = function() {
                outputEl.textContent = `${decimalSeparator(this.value)}`;
                output.textContent = `${decimalSeparator(this.value)} USD`;
            };
        </script>


        @endsection