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
                                <option value="2">Depósito</option>
                                <option value="3">Transferencia</option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Monto</label>
                            @if($last_payment==null)
                            <input type="number" class="form-control" name="monto" id="monto" value="{{$credit->total_credit}}" min="1" step="any" readonly>
                            <input type="hidden" id="real_monto" value="{{$credit->total_credit}}">
                            @else
                            <input type="number" class="form-control" name="monto" id="monto" value="{{$last_payment->resta}}" min="1" step="any" readonly>
                            <input type="hidden" id="real_monto" value="{{$last_payment->resta}}">
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <label for="">Total pagado</label>

                            @if($last_payment==null)
                            <input type="number" class="form-control" name="total_payed" id="total_payed" value="0" min="1" step="any" readonly>
                            @else
                            <input type="number" class="form-control" name="total_payed" id="total_payed" value="{{$credit->total_credit-$last_payment->resta}}" min="1" step="any" readonly>
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <label for="">Resta</label>
                            @if($last_payment==null)
                            <input type="number" class="form-control" name="resta" id="resta" value="0" min="0" step="any" readonly>
                            @else
                            <input type="number" class="form-control" name="resta" id="resta" value="{{$last_payment->resta}}" min="0" step="any" readonly>
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <label for="">Días atraso</label>
                            @if($last_payment==null)
                            <input type="number" class="form-control" name="atraso" id="atraso" value="0" min="0" step="any" readonly>
                            @else
                            @if($last_payment->Days<"0") <input type="number" class="form-control" name="atraso" id="atraso" value="{{$last_payment->Days*-1}}" readonly>
                                @else
                                <input type="number" class="form-control" name="atraso" id="atraso" value="0" readonly>
                                @endif
                                @endif
                        </div>
                        <div class="form-group col-3">
                            <label for="">Moratorios</label>
                            <input name="moratorios" id="moratorios" type="number" min="0" step="any" value="20" class="form-control" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="">Próximo pago</label>
                            <input name="next_payment" id="next_payment" type="date" class="form-control">
                        </div>
                        <div class="form-group col-3">
                            <label for="">Calcular prox fecha</label>
                            <input name="calculate_next_pay" id="calculate_next_pay" type="checkbox" class="form-control">
                        </div>
                        <div class="form-group col-3">
                            <label for="">Total a pagar</label>
                            <input type="number" class="form-control" name="efectivo" value="{{$credit->amountPay}}" id="efectivo" min="{{$credit->amountPay}}" max="{{$credit->amountPay}}" required>
                        </div>
                        <input type="hidden" class="form-control" name="credit_id" value="{{$credit->id}}">
                        <input type="hidden" class="form-control" name="status" id="status">
                        <input type="hidden" class="form-control" name="cambio" id="cambio">
                        @if($last_payment!=null)
                            <input type="hidden" class="form-control" id="real_days" value="{{$last_payment->Days}}">
                        @else
                            <input type="hidden" class="form-control" id="real_days" value="0">
                        @endif
                        <input type="hidden" class="form-control" id="credit" value="{{$credit->total_credit}}">
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
