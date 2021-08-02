<!-- MODAL PARA RETIRAR SALDO DISPONILE -->

<div class="modal fade" id="modalSaldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-xl-center text-bold-600" id="exampleModalLabel">Retiro</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <br>
            <form>
                @csrf
                <input type="hidden" name="id" value="">

                <div class="modal-body ">

                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                                <div class="col-2">
                                    <label for="" class="font-weight-bold  mr-6">Monto:</label>
                                </div>
                                <div class="col-8">
                                    <input disabled class="col form-control w-50 d-inline" type="text" value="{{number_format    ($saldoDisponible)}}">

                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-1">

                            <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                                <div class="col-2">
                                    <label for="" class="col font-weight-bold  mr-6">Fee:</label>
                                </div>
                                <div class="col-8">
                                    <input disabled style="backoground: #5f5f5f5f;" class="col form-control w-50 d-inline" type="text" value="{{ number_format(floatval($saldoDisponible) * 0.1) }}">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-1">
                            <div class="row mb-0 justify-content-center" style="font-size: 1.5em;">
                                <div class="col-2">
                                    <label for="" class="font-weight-bold"> recibir:</label>
                                </div>
                                <div class="col-8">
                                    <input disabled style="backoground: #5f5f5f5f;" class="form-control w-50 d-inline" type="text" value="{{($saldoDisponible) - (floatval($saldoDisponible) * 0.1) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <a href="{{route('settlement.wallet')}}" type="btn bt-primary" class="btn btn-primary">Retirar</a>
                </div>
            </form>
        </div>
    </div>
</div>