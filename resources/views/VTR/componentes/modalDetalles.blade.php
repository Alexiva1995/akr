<!-- Modal -->
<div class="modal fade" id="modalModal" tabindex="-1" role="dialog" aria-labelledby="modalModalDetallesTitle"
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
                <form action="{{route('generar.crypto')}}" method="post">
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
                                    <th>ID Comision</th>
                                    <th>Fecha</th>
                                    <th>Concepto</th>
                                    <th>ID Referido</th>
                                    <th>Referido</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in Comisiones.comisiones" class="text-center">
                                    @if ($all)
                                    <td>
                                        <input type="checkbox" :value="item.id" :checked="(selecAllComision) ? true : false" name="listaComisiones[]">
                                    </td>
                                    @endif
                                    <td v-text="item.id"></td>
                                    <td v-text="item.fecha"></td>
                                    <td v-text="item.descripcion"></td>
                                    <td v-text="item.referred_id"></td>
                                    <td v-text="item.referido.fullname"></td>
                                    <td v-text="item.monto +' $'"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total Comision</th>
                                    <th colspan="2" v-text="Comisiones.total+' $'" class="text-right"></th>
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