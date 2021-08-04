
<!-- Modal -->
<div class="modal fade" id="valor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Valor de la moneda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form action="{{route('VTR.valor_monedas')}}" method="post">
        @csrf
      <div class="modal-body">
      <input type="number" id="valor_monedas" class="col form-control w-50 d-inline" value="10" name="valor_monedas" placeholder="Ingrese aquí el Valor de la moneda"> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
