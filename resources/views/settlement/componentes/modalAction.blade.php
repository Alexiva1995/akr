<!-- Modal -->
<div class="modal fade" id="modalModalAccion" tabindex="-1" role="dialog" aria-labelledby="modalModalAccionTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content"  style="background-color: #0f1522;">
            <div class="modal-header"  style="background-color: #0f1522;">
                <h5 class="modal-title" id="form-labels" v-text="(StatusProcess == 'reverse') ? 'Reversar Liquidacion' : 'Aprobar Liquidacion'"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('settlement.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="idliquidation" :value="ComisionesDetalles.idliquidaction">
                    <input type="hidden" name="action" :value="StatusProcess">
                    <h5 class="text-white">Usuario: <strong v-text="ComisionesDetalles.fullname"></strong></h5>
                    <h5 class="text-white">Total: <strong v-text="ComisionesDetalles.total"></strong></h5>

                    <div class="form-group" v-if="StatusProcess == 'aproved'">
                        <label for="" id="form-labels" class="text-white">Hash</label>
                        <input id="issues" type="text" name="hash" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="" id="form-labels"  class="text-white">Comentario</label>
                        <textarea id="issues" name="comentario" class="form-control" :required="(StatusProcess == 'reverse') ? true : false"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" id="form-labels" v-text="(StatusProcess == 'reverse') ? 'Reservar' : 'Aprobar'"></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button " id="form-labels" style="background-color: #03c2b5;" class="btn " data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>