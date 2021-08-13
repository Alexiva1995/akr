<!-- Modal -->
<div class="modal fade" id="modalModalDetallesCrypto" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModalDetallesTitle">Detalles de comisiones del usuario <!--debe ir el nombre del usuario--></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('crypto.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="iduser" :value="Comisiones.iduser">
                    <input type="hidden" name="tipo" value="detalladas">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical table-striped " style="width: 100%;" id="table_detalle">
                            <thead>
                                <tr class="text-center">
                                    @if ($all)
                                    <th> 
                                        <button style="position: relative; z-index: 1;" type="button" class="btn" :class="(selecAllComision) ? 'btn-danger' : 'btn-info'" v-on:click="selecAllComision = !selecAllComision">
                                            <i class="fa" :class="(selecAllComision) ? 'fa-square-o' : 'fa-check-square'"></i>
                                        </button>
                                    </th>
                                    @endif
                                    <th>ID Crypto</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
<<<<<<< HEAD
                                <tr v-for="item in Comisiones.comisiones" class="text-center">
=======
                                <tr v-for="item in ComisionesDetalles.cryptos" class="text-center">
>>>>>>> 5aa06cdb5c8114836d56694ca217402f6b0b7fa2
                                    @if ($all)
                                    <td>
                                        <input type="checkbox" :value="item.id" :checked="(selecAllComision) ? true : false" name="listaComisiones[]">
                                    </td>
                                    @endif
                                    <td v-text="item.id"></td>
                                    <td v-text="item.fecha"></td>
                                    <td v-text="item.cantidad"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
<<<<<<< HEAD
                                    <th colspan="4" class="text-right">Total Comision</th>
                                    <th colspan="2" v-text="Comisiones.total+' $'" class="text-right"></th>
=======
                                    <th colspan="3" class="text-right">Total Comision</th>
                                    <th colspan="2" v-text="ComisionesDetalles.total+' $'" class="text-right"></th>
>>>>>>> 5aa06cdb5c8114836d56694ca217402f6b0b7fa2
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>