           
            <!-- MODAL PARA RETIRAR SALDO DISPONILE -->

            <div class="modal fade" id="modalSaldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Retiro</h5>
                            <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                &times;
                            </button>
                        </div>
                        <br>
                        <form method="post" action="">                         
                        @csrf
                             <input type="hidden" name="id" value="">

                            <div class="modal-body ">
                                <p>¿Seguro Que Desea Retirar Lo Fondos?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit" class="btn btn-primary">Retirar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          

