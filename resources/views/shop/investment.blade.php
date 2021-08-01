@section('content')
<div id="adminServices">
    <div class="card">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="container">
                    @if(isset($user))
                        <h1 class="text-center mt-1 mb-4">Verificar Usuario #{{ $user->id.' - '.$user->fullname }}</h1>
                        <form action="{{route('realizar-inversion')}}" method="POST" class="d-inline">                                            
                    @else
                        <form action="{{route('realizar-inversion')}}" method="POST" target="_blank" class="d-inline">                        
                    @endif

                    @csrf
                        <div class="form-group">
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
                            <div class="d-flex justify-content-center mb-2 mt-4">
                                @if(isset($user))
                                    <a href="{{route('users.list-user')}}" type="btn" class="btn btn-danger mr-2">Regresar</a>
                                @endif
                                <button type="submit" class="btn btn-primary float-right">Comprar Paquete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

      
const range = document.getElementById("range");

const scale = (num, in_min, in_max, out_min, out_max) => {
  return ((num - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min;
};

range.addEventListener("input", (e) => {
  const value = +e.target.value;
  const label = e.target.nextElementSibling;
  const rangeWidth = getComputedStyle(e.target).getPropertyValue("width");
  const labelWidth = getComputedStyle(label).getPropertyValue("width");
  // remove px
  const numWidth = +rangeWidth.substring(0, rangeWidth.length - 2);
  const numLabelWidth = +labelWidth.substring(0, labelWidth.length - 2);
  const max = +e.target.max;
  const min = +e.target.min;
  const left =
    value * (numWidth / max) -
    numLabelWidth / 2 +
    scale(value, min, max, 10, -10);
  label.style.left = `${left}px`;
  label.innerHTML = value;
});

    </script>
@endsection