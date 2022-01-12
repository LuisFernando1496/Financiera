<div class="modal fade" id="InsuranceModalEdit" tabindex="-1" role="dialog" aria-labelledby="InsuranceModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InsuranceModalEditLabel">Editar Solicitud De Seguro</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insuranceModalEditForm" action="/insurance" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="insurance_type">Cliente</label>
                        <input type="text" id="client" class="form-control" name="client" value="prueba" readonly>
                        <input type="hidden" id="client_idEdit" name="client_id">
                    </div>
                    <div class="form-group">
                        <label for="insurance_type">Tipo de seguro</label>
                        <select class="form-control" type="text" name="insurance_type" id="insurance_typeEdit" value="" required>
                            <option value="null" selected>Seleccione un tipo</option>
                            <option value="Contado">Contado</option>
                            <option value="Financiado">Financiado</option>
                            <option value="DeVida">De vida</option>
                        </select>
                    </div>
                    <div class="form-group" id="view_benEdit" hidden>
                        <label for="beneficiario">Beneficiario</label>
                        <input type="text" class="form-control" name="beneficiario" id="beneficiarioEdit">
                    </div>
                    <div class="form-group" id="view_finEdit" hidden>
                        <label for="interes">Interés</label>
                        <input type="number" min="1" max="100" class="form-control" name="interes" id="interesEdit">
                    </div>
                    <div class="form-group" id="view_conEdit" hidden>
                        <label for="contado">Pago Contado</label>
                        <input type="number" min="1" class="form-control" name="contado" id="contadoEdit">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="monthTotal">Meses</label>
                            <input type="number" min="1" class="form-control" name="monthTotal" id="monthTotalEdit" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="credit">Crédito</label>
                            <input type="number" min="2000" value="2000" class="form-control" name="credit" id="creditEdit" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="cost">Costo</label>
                            <input type="number" value="300" class="form-control" name="cost" id="costEdit" readonly required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="limpiar()" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>