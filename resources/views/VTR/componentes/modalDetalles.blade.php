<!-- Modal -->

<div class="modal fade " id="modalModalDetallesCrypto" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="background-color:#0f1522;">
            <div class="modal-header" style="background-color:#0f1522;">
                <h5 class="modal-title" id="form-label">Detalles de comisiones del usuario (@{{ComisionesDetalles.fullname}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="{{route('crypto.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="iduser" :value="ComisionesDetalles.iduser">
                    <input type="hidden" name="tipo" value="detallada">
                    <div class="table-responsive">
                        <table class="myTable w-100 nowrap scroll-horizontal-vertical table-striped " style="width: 100%;" id="table_detalle">
                            <thead>
                                <tr class="text-center">
                                    @if ($all)
                                    <th> 
                                        <button style="position: relative; z-index: 1;" type="button" class="btn" :class="(seleAllComision) ? 'btn-danger' : 'btn-info'" v-on:click="seleAllComision = !seleAllComision">
                                            <i class="fa" :class="(seleAllComision) ? 'fa-square-o' : 'fa-check-square'"></i>
                                        </button>
                                    </th>
                                    @endif
                                    <th class="text-white">ID Crypto</th>
                                    <th class="text-white">Fecha</th>
                                    <th class="text-white">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in ComisionesDetalles.cryptos" class="text-center">
                                    @if ($all)
                                    <td>
                                        <input type="checkbox" :value="item.id" :checked="(seleAllComision) ? true : false" name="listComisiones[]">
                                    </td>
                                    @endif
                                    <td  v-text="item.id"></td>
                                    <td v-text="item.fecha"></td>
                                    <td v-text="item.cantidad"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr  class="mb-2 mt-2">
                                    <th colspan="3" class="text-right text-white">Total Comision</th>
                                    <th colspan="2" v-text="ComisionesDetalles.total+' $'" class="text-right text-white"></th>
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
                <button type="button" class="btn text-white" style="background-color: #00cfe8;" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
