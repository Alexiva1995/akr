<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Porcentaje de la moneda</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>

      </div>
      <form action="{{route('VTR.send')}}" method="post">
        @csrf
        <div class="modal-body">


        <div class="input-group  mb-3">
<input type="text" id="porcentaje_de_monedas" class="col form-control w-50 d-inline  " value="Porcentaje de la moneda" name="porcentaje_de_monedas" placeholder="Ingrese aquí el porcentaje de monedas">
</div>

<div class="input-group mb-3">
<input type="text" id="valor" class="col form-control w-50 d-inline" value="Valor de la moneda" name="valor" placeholder="Ingrese aquí el Valor de la moneda">
</div>

    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    </form>
  </div>
</div>
</div>

