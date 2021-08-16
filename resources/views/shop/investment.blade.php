@section('content')

<style>
    .bg-full-screen-image-alt {

        background-image: url("{{asset('assets/img/sistema/fondo.jpg')}}"
        );
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }


    .fondo {


        background: linear-gradient(90deg, rgba(5, 176, 215, 0.75) 0%, rgba(3, 46, 55, 0.83) 100%);
        border-radius: 8px;


    }
</style>

<h1>Depositos</h1>

<div id="adminServices" class="mt-3">
    <div class="card">
        <div class="card-content">
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
                                        <h1 class="text-center text-white mt-3 mb-3">Selecciona El Monto A Depositar</h1>
                                        <input class="range" type="range" name="range" id="range" min="70" max="10000" value="70" step="1" onmousemove="rangevalue1.value=value" />
                                        <output id="rangevalue1"></output>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
            <div class="card-body">

                <h2 class="text-center mt-3 text-dark">Total a Pagar : $ 8.000 USD</h2>
                <p class="text-center mt-1" style="color: #00F6E1;">Debes realizar un pago de 8.000 USD para <br> poder activar tu plan.</p>

                @if(isset($user))
                <input type="hidden" class="w-100" name="user" id="user" value="{{$user->id}}" />
                <div class="custom-control custom-switch mt-1">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="comision" value="comision">
                    <label class="custom-control-label" for="customSwitch1"></label>
                    Generar Comisiones
                </div>
                @endif
            </div>
            <br>

        </div>
        <div class="d-flex justify-content-center mb-2 ">
            @if(isset($user))
            <a href="{{route('users.list-user')}}" type="btn" class="btn btn-danger mr-2">Regresar</a>
            @endif
            <button type="submit" class="btn text-dark float-right" style="background-color:#08C5B9;">Pagar via CoinPayments</button>
        </div>
    </div>
</div>
<script>
    function PasarValor() {
        document.getElementById("range").value = document.getElementById("total").value;
    }
</script>

</form>
@endsection