<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color:#0f1522">
      <div class="modal-header"style="background-color:#0f1522">
        <h5 class="modal-title text-white" id="exampleModalLabel">Porcentaje de la moneda</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
       
      </div>
      
      <form action="{{route('VTR.send')}}" method="post">
        @csrf
        <div class="modal-body">


        <div class="input-group  mb-3">
<input type="text" id="issues" class="col form-control w-50 d-inline  " value=""  name="porcentaje_de_monedas" placeholder="Ingrese aquí el porcentaje de monedas">
</div>

<div class="input-group mb-3">
<input type="text" id="issues" class="col form-control w-50 d-inline" value="" name="valor" placeholder="Ingrese aquí el Valor de la moneda">
</div>

    <div class="modal-footer">
   
      <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
      <button class="btn text-white" style="background-color: #00cfe8;" data-bs-dismiss="modal">Cerrar</button>
    </div>
   
  </div>
</div>
</div>

