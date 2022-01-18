<div class="modal fade" id="numCreditEditModal" tabindex="-1" aria-labelledby="deleteCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCreditModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="numCreditModalEditForm" action="/credit" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    ¿Cambiar el numéro de credito?

                    <div class="form-group col-12">
                        <label for="num_credit">Número de Crédito</label>
                        <input type="number" class="form-control" name="num_credit" id="num_credit_edit" value="" placeholder="Número de Crédito" min="1" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Cambiar</button>
                </div>
            </form>
        </div>
    </div>
</div>