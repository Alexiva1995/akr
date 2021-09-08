<!-- Modal -->
<div class="modal fade" id="modalModalDetalles" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="background-color: #0f1522;">
            <div class="modal-header" style="background-color: #0f1522;">
                <h5 class="modal-title text-white" id="modalModalDetallesTitle">Detalles de comisiones del usuario (@{{ComisionesDetalles.fullname}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('liquidation.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="iduser" :value="ComisionesDetalles.iduser">
                    <input type="hidden" name="tipo" value="detallada">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical table-striped " style="width: 100%;" id="table_detalle">
                            <thead style="background-color: #095d76;  border: 2px solid rgba(17, 184, 209, 0.77); ">
                                <tr class="text-center text-white">
                                    @if ($all)
                                    <th> 
                                        <button style="position: relative; z-index: 1;" type="button" class="btn" :class="(seleAllComision) ? 'btn-danger' : 'btn-info'" v-on:click="seleAllComision = !seleAllComision">
                                            <i class="fa" :class="(seleAllComision) ? 'fa-square-o' : 'fa-check-square'"></i>
                                        </button>
                                    </th>
                                    @endif
                                    <th id="form-labels">ID Comision</th>
                                    <th id="form-labels">Fecha</th>
                                    <th id="form-labels">Concepto</th>
                                    <th id="form-labels">ID Referido</th>
                                    <th id="form-labels">Referido</th>
                                    <th id="form-labels">Monto</th>
                                </tr>
                            </thead>
                            <tbody  style=" border: 2px solid rgba(17, 184, 209, 0.77);">
                                <tr v-for="item in ComisionesDetalles.comisiones" class="text-center">
                                    @if ($all)
                                    <td>
                                        <input type="checkbox" :value="item.id" :checked="(seleAllComision) ? true : false" name="listComisiones[]">
                                    </td>
                                    @endif
                                    <td id="form-labels" v-text="item.id"></td>
                                    <td id="form-labels" v-text="item.fecha"></td>
                                    <td id="form-labels" v-text="item.descripcion"></td>
                                    <td  id="form-labels" v-text="item.referred_id"></td>
                                    <td id="form-labels" v-text="item.referido.fullname"></td>
                                    <td  id="form-labels" v-text="item.monto +' $'"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right text-white" id="form-labels">Total Comision</th>
                                    <th colspan="2" id="form-labels" v-text="ComisionesDetalles.total+' $'" class="text-right"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- @if(\Carbon\Carbon::now()->format('l') == 'Friday') --}}
                        @if ($all)
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Generar Liquidacion</button>
                            </div>
                        {{-- @endif --}}
                    @endif
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" id="form-labels" class="btn text-white" style="background-color: #00cfe8;" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>