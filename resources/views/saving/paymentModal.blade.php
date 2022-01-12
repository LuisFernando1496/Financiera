<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Nuevo pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="/payment" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="">Tipo de pago</label>
                            <select class="form-control" name="tipo" id="tipo" required>
                                <option value="0" disabled selected>-- Seleccione un tipo de pago --</option>
                                <option value="1">Efectivo</option>
                                <option value="2">Deposito</option>

                            </select>
                        </div>
                        <div class="form-group col-3">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                            <button id="createPayment" type="submit" class="btn btn-success">Pagar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>