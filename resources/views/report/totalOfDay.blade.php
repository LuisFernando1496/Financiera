<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Total del {{$day}}</title>
</head>

<body>
    @php
    $totalExpenses=0
    @endphp
    <br>
    <center>
        <h3>Reporte Total del {{$day}}</h3>
    </center>
    <table border="1" style="width:98%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:center" colspan="5">
                    <h3>Pagos</h3>
                </td>
            </tr>
            <tr style="background-color: #EEEEEE;">
                <th class="text-center">Cliente</th>
                <th class="text-center">N. de crédito</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Fecha límite</th>
                <th class="text-center">Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $item)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{$item->credit->client->last_name}} {{$item->credit->client->name}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->credit_id}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->fecha}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->fecha_limite}} %</td>
                <td style="text-align: center; vertical-align: middle;">$ {{$item->monto}}</td>
            </tr>
            @endforeach
            <tr style="background-color: #EEEEEE;">
                <td style="text-align:center" colspan="3">
                    Total: $
                </td>
                <td style="text-align:center" colspan="2">
                    {{$total_payments}}
                </td>
            </tr>
        </tbody>
    </table>

    <table border="1" style="width:98%; border-collapse: collapse; padding-top: 1%;">
        <thead>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:center" colspan="5">
                    <h3>Gastos</h3>
                </td>
            </tr>
            <tr style="background-color: #EEEEEE;">
                <th class="text-center">Descripción</th>
                <th class="text-center">Usuario que lo realizó</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Total parcial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $item)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{$item->description}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->user->last_name}} {{$item->user->name}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->quantity}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->price}}</td>
                <td style="text-align: center; vertical-align: middle;">$ {{$item->quantity*$item->price}}</td>
                @php
                $totalExpenses = $totalExpenses+($item->quantity*$item->price);
                @endphp
            </tr>
            @endforeach
            <tr style="background-color: #EEEEEE;">
                <td style="text-align:center" colspan="3">
                    Total: $
                </td>
                <td style="text-align:center" colspan="2">
                    {{$totalExpenses}}
                </td>
            </tr>
        </tbody>
    </table>

    <table border="1" style="width:98%; border-collapse: collapse; padding-top: 1%;">
        <thead>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:center" colspan="5">
                    <h3>Seguros</h3>
                </td>
            </tr>
            <tr style="background-color: #EEEEEE;">
                <th class="text-center">Tipo</th>
                <th class="text-center">Beneficiario</th>
                <th class="text-center">Interes</th>
                <th class="text-center">Monto del crédito</th>
                <th class="text-center">Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($insurances as $item)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{$item->insurance_type}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->beneficiario}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->interes}}</td>
                <td style="text-align: center; vertical-align: middle;">$ {{$item->credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->client->last_name}} {{$item->client->name}}</td>
            </tr>
            @endforeach
            <tr style="background-color: #EEEEEE;">
                <td style="text-align:center" colspan="3">
                    Total: $
                </td>
                <td style="text-align:center" colspan="2">
                    {{$total_insurances}}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>