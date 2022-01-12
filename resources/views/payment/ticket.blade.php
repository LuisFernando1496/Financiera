<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket</title>    
</head>
<body>

<style>
    * {
    font-size: 12px;
    font-family: 'Times New Roman';
}
td,th,tr,table {
    border-top: 1px solid black;
    border-collapse: collapse;
}
td.producto,th.producto {
    width: 150px;
    max-width: 150px;
}
td.cantidad,th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}
td.precio,th.precio {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}
.centrado {
    text-align: center;
    align-content: center;
    width: 100%;
}
.ticket {
    width: 155px;
    max-width: 155px;
}
img {
    max-width: inherit;
    width: inherit;
}
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}

</style>
<div class="ticket">
    <img src="{{asset('/logo.jpeg')}}" alt="Logotipo">
    <p class="centrado">
        Calle: CARRETERA A NIQUIVIL <br>
        Colonia: BARRIO LINDA VISTA <br>
        Atendido por: {{Auth::user()->name}} {{Auth::user()->last_name}} <br>
        Fecha: {{$payment->created_at->format('d-m-y h:m:s')}} <br>
        Folio: {{$payment->folio}}
        {{--Sucursal {{$payment->credit->client->branch->name}} <br>
        Calle: {{$payment->credit->client->branch->street}} numero: {{$payment->credit->client->branch->ext_number}},Colonia: {{$payment->credit->client->branch->suburb}}, <br>
        Atendido por: {{Auth::user()->name}}, Venta:{{$payment->status}} <br>
        Fecha: {{$payment->created_at}} <br>
        Folio: {{$payment->folio}}--}}
    </p>
    <section id="ticket" style="display: flex; justify-content: space-between; align-items: center;">
        <div id="pro-th">CANT</div>
        <div id="pre-th">CONCEPTO  <br></div>
        <div id="cod-th">P/U</div>

    </section>
    <hr>
    
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div id="pro-td">
                1
            </div>
            <div id="pre-td" style="text-align: center;">{{$payment->concepto}} </div>
            <div id="can-td" style="text-align: center; margin-right:3px !important;">${{number_format($payment->efectivo,2,'.',',')}} </div>
            </div>
        <hr>
    
    <div id="total">
        @if ($payment->tipo == 2)
        Pago con tarjeta
        @else
        Pago en efectivo
        @endif
        =========================
        <br>
        Pagó:  ${{number_format($payment->efectivo,2,'.',',')}}
        =========================
        <br>
        Monto Total: ${{number_format($payment->monto,2,'.',',')}}<br>
        Resta: ${{$payment->resta}}<br>
        Lleva pagando: ${{$payment->credit->total_credit-$payment->resta}}
        ========================= <br>
        Moratorios: ${{number_format($payment->moratorios,2,'.',',')}}
        {{-- <br>
        Resta: {{$payment->resta}}
        Lleva pagando: ${{$payment->credit->total_credit-$payment->resta}} <br>
        ========================= <br>
        Moratorios: ${{number_format($payment->moratorios,2,'.',',')}}--}}
    </div>
    <p class="centrado">RFC:---- </p>
    <p class="centrado">Email: {{Auth::user()->email}}</p>
    <p class="centrado">¡GRACIAS POR SU PAGO!</p>
    <p class="centrado">Este ticket no es comprobante fiscal</p>
</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>
