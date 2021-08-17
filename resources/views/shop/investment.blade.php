@section('content')

<style>
    .bg-full-screen-image-alt {

        background-image: url("{{asset('assets/img/sistema/fondo.jpg')}}"
        );
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        border-radius: 8px;

    }

    .fondo {

        background: linear-gradient(90deg, rgba(5, 176, 215, 0.75) 0%, rgba(3, 46, 55, 0.83) 100%);
        border-radius: 8px;
        width: 100%;


    }

    #card {

        background: linear-gradient(180deg, #12203C 0%, rgba(10, 16, 28, 0) 100%);
        border-radius: 10px;
        background-color: #0C0C0C;
    }

    .btn {
        background: rgba(0, 0, 0, 0.5);
        border: 1px solid #00C8F4;
        box-sizing: border-box;
        border-radius: 5px;
        color: white;

        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        line-height: 21px;
        letter-spacing: -0.3px;
    }

    #h1 {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 36px;
        line-height: 42px;
        color: #FFFFFF;


    }

    #deposito {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 42px;
        letter-spacing: -0.2px;
        color: #FFFFFF;
    }
</style>

<h1 id="deposito">Depositos</h1>

<div id="adminServices" class="mt-3">
    <div class="card card-dashboard  bg-full-screen-image-alt">
        <div class="container fondo">
            @if(isset($user))
            <h1 class="text-center mt-1 mb-4">Verificar Usuario #{{ $user->id.' - '.$user->fullname }}</h1>
            <form action="{{route('realizar-inversion')}}" method="POST" class="d-inline">
                @else
                <form action="{{route('realizar-inversion')}}" method="POST" target="_blank" class="d-inline">
                    @endif

                    @csrf
                    <div class="form-group">
                        <div class="range-wrap">
                            <div class="range-container ">
                                <h1 class="text-center mt-3 mb-3" id="h1">Selecciona El Monto A Depositar</h1>

                                <a href="#" class="btn">Iniciar</a>
                                <input class="range" type="range" name="range" id="range" min="70" max="10000" value="70" step="1" oninput="num.value = this.value" />

                                <output id="num">70</output>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
        </div>


        <div class="card-body" id="card">

            <h2 class="text-center mt-3 text-white" style="font-weight: bold;letter-spacing: -0.6px; line-height: 110%;
font-style: normal;margin: 0px 16px;">Total a Pagar : $ <span class="range-slider__value">70</span> USD</h2>
            <p class="text-center mt-1" style="color: #00F6E1;">Debes realizar un pago de 8.000 USD para <br> poder activar tu plan.</p>

            @if(isset($user))
            <input type="hidden" class="w-100" name="user" id="user" value="{{$user->id}}" />
            <div class="custom-control custom-switch mt-1">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="comision" value="comision">
                <label class="custom-control-label" for="customSwitch1"></label>
                Generar Comisiones

                @endif

                <br>

                <div class="d-flex justify-content-center mb-2 ">
                    @if(isset($user))
                    <a href="{{route('users.list-user')}}" type="btn" class="btn btn-danger mr-2">Regresar</a>
                    @endif
                    <button type="submit" class="btn text-dark float-right" style="background-color:#08C5B9;font-weight:600;">PAGAR VÍA COINPAYMENTS</button>
                </div>
            </div>

        </div>

        </form>

        <script>
            
            let slider = document.querySelector(".range");
            let outputEl = document.querySelector(".range-slider__value");

            function decimalSeparator(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            outputEl.textContent = `${decimalSeparator(slider.value)}`;

            slider.oninput = function() {
                outputEl.textContent = `${decimalSeparator(this.value)}`;
            };
        </script>

        @endsection