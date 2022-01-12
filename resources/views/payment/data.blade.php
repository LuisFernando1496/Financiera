@extends('layouts.light.master')
@section('title', 'Layout Light')
@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Pagos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pagos</li>
<li class="breadcrumb-item active"></li>
@endsection

@if($bool!=false)
@include('payment.create')
@endif

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right" style="padding-bottom: 2%;">
                        @if($bool!=false)
                        <button id="newPay" class="btn btn-outline-primary">Nuevo pago</button>
                        @endif
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Fecha limite</th>
                                <th>fecha</th>
                                <th>Estatus</th>
                                <th>Proximo pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $item)
                            <tr>
                                <td class="text-center">{{$item->credit->client->name}} {{$item->credit->client->last_name}}</td>
                                <td class="text-center">{{$item->fecha_limite}}</td>
                                <td class="text-center">{{$item->fecha}}</td>
                                @if($item->status==1)
                                <td class="text-center" style="color: GREEN;">PAGADO</td>
                                <td class="text-center">PAGADO</td>
                                @else
                                <td class="text-center" style="color: red;">SIN PAGAR</td>
                                @if($item->Days<"0") <td class="text-center">{{$item->Days*-1}} Dias de retraso</td>
                                    @else
                                    <td class="text-center">{{$item->Days}} Dias</td>
                                    @endif

                                    @endif

                                    @endforeach
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Fecha limite</th>
                                <th>fecha</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#newPay').click(function() {
            $('#paymentModal').modal();
            var total_payed = document.getElementById("total_payed").value;
            var credit = document.getElementById("credit").value;
            var monto = document.getElementById("monto").value;
            var daysToPay = document.getElementById("real_days").value;

            if (total_payed == credit) {
                document.getElementById("createPayment").disabled = true;
            }
            if (daysToPay < 0) {
                $('#moratorios').val((daysToPay * -1) * 20);
                $('#monto').val(parseInt($('#moratorios').val(), 10) + parseInt(monto, 10));
            } else $('#moratorios').val(0);
        });
        $('#next_payment').change(function() {

            document.getElementById("calculate_next_pay").disabled = true;
        });
        $('#moratorios').change(function() {
            var monto = document.getElementById("real_monto").value;
            $('#monto').val(parseInt($(this).val(), 10) + parseInt(monto, 10))
        });
        $('#calculate_next_pay').change(function() {

            document.getElementById("next_payment").disabled = true;
        });


        $('#efectivo').keyup(function() {
            var total = $(this).val()
            var monto = $('#monto').val()
            $('#resta').val(monto - total)
            console.log($('#resta').val())
            if ($('#resta').val() == 0) {
                $('#status').val(1)
                $('#cambio').val(0)

            } else if ($('#resta').val() > 0) {
                $('#status').val(0)
                $('#cambio').val(0)
            } else {
                $('#cambio').val(total - monto)
                $('#status').val(1)
            }
        });
    });
</script>
@endsection