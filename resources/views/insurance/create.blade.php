<div class="modal fade" id="insuranceModal" tabindex="-1" role="dialog" aria-labelledby="insuranceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insuranceModalLabel">Solicitud De Seguro</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="/insurance" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="insurance_type">Cliente</label>
                        <select class="form-control" name="client_id" id="client_id" required>
                            <option value="null" selected>Seleccione un cliente</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->last_name}} {{$client->name}} | {{$client->rfc}} | {{$client->curp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="insurance_type">Tipo de seguro</label>
                        <select class="form-control" type="text" name="insurance_type" id="insurance_type" value="" required>
                            <option value="null" selected>Seleccione un tipo</option>
                            <option value="Contado">Contado</option>
                            <option value="Financiado">Financiado</option>
                            <option value="DeVida">De vida</option>
                            <option value="funerarios">Gastos funerarios</option>
                        </select>
                    </div>
                    <div class="form-group" id="view_ben" hidden>
                        <label for="beneficiario">Beneficiario</label>
                        <input type="text" class="form-control" name="beneficiario" id="beneficiario">
                    </div>
                    <div class="form-group" id="view_fin" hidden>
                        <label for="interes">Interés</label>
                        <input type="number" min="1" max="100" class="form-control" name="interes" id="interes">
                    </div>
                    <div class="form-group" id="view_con" hidden>
                        <label for="contado">Pago Contado</label>
                        <input type="number" min="1" class="form-control" name="contado" id="contado">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="monthTotal">Meses</label>
                            <input type="number" min="1" class="form-control" name="monthTotal" id="monthTotal" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="credit">Crédito</label>
                            <input type="number" min="2000" value="2000" class="form-control" name="credit" id="credit" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="cost">Costo</label>
                            <input type="number" value="300" class="form-control" name="cost" id="cost" readonly required>
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