<div class="modal fade" id="savingModal" tabindex="-1" role="dialog" aria-labelledby="savingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="savingModalLabel">Nueva Inversión</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="/saving" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="insurance_type">Cliente</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="null">Seleccione un cliente</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}} {{$client->last_name}} | {{$client->rfc}} | {{$client->curp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="total">Inversión Total</label>
                            <input type="number" class="form-control" name="total" id="total" min="5000"  required>
                        </div>
                        <div class="form-group col-3">
                            <label for="MonthTotal">Meses Totales</label>
                            <input type="number" class="form-control" name="MonthTotal" value="8" id="MonthTotal" min="1"  required>
                        </div>
                        <div class="form-group col-3">
                            <label for="interesTotal">Porcentaje Total</label>
                            <input type="number" class="form-control" name="interesTotal" id="interesTotal" value="2.5" min="1" step="any" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="returnTotal">Retorno Mensual</label>
                            <input type="number" class="form-control" name="returnTotal" id="returnTotal" readonly required>
                        </div>
                        <div class="form-group col-3">
                            <label for="winningTotal">Total a ganar</label>
                            <input type="number" class="form-control" name="winningTotal" id="winningTotal" readonly required>
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