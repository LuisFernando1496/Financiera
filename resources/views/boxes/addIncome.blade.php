<div class="modal fade" id="incomeCashBoxModal" tabindex="-1" aria-labelledby="incomeCashBoxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incomeCashBoxModalLabel"></h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/income" method="post">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" name="box_id" id="box_id_income">
                        <div class="form-group col-6">
                            <label for="description">Descripción</label>
                            <input class="form-control" type="text" name="description" id="description" value="" placeholder="Descripción" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="amount">Monto</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" min="1" name="amount" id="amount" class="form-control was validated" aria-label="Amount (to the nearest dollar)" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">MXN</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="limpiar()" type="button" class="btn btn-outline-secondary" data-dismiss="modal">CANCELAR</button>
                        <button type="submit" class="btn btn-primary">SUMAR A CAJA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    function limpiar() {
        let fields = document.getElementsByClassName('form-control')

        for (let i = 0; i < fields.length; i++) {
            var element = fields[i];
            element.value = ''
        };
    }
</script>