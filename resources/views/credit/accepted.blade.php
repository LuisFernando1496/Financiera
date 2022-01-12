<div class="modal fade" id="acceptedCreditModal" tabindex="-1" aria-labelledby="acceptedCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptedCreditModalLabel">Aceptar Crédito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de aprobar este crédito?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <form id="acceptedForm" method="POST" onsubmit="return hideModal()">
                    @csrf
                    <button id="aceptar" type="submit" class="btn btn-success">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // $('#aceptar').click(function(){
    //     location.reload();
    // })
</script>
