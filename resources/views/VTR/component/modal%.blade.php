
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Porcentaje de la moneda</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
       
      </div>
      <form action="{{route('VTR.send')}}"  method="post" >
      @csrf
      <div class="modal-body">
     
      <input type="text" class="col form-control w-50 d-inline" name="porcentaje_de_monedas" value="1">
      </div>
      <div class="modal-footer">
        <button  class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button  class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
