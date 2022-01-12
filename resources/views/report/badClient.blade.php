<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de clientes atrasados {{$start_date}} - {{$end_date}}</title>
</head>

<body>
    @php
    $totalSum=0;
    @endphp
    <br>
    <center>
        <h3>Reporte de clientes atrasados {{$start_date}} - {{$end_date}}</h3>
    </center>
    <table border="1" style="width:98%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #EEEEEE;">
                <th class="text-center">Cliente</th>
                <th class="text-center">N. de crédito</th>
                <th class="text-center">Monto solicitado</th>
                <th class="text-center">Monto aprobado</th>
                <th class="text-center">Fecha Último pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{$item->client->last_name}} {{$item->client->name}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->type_id}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->want_credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->check_credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->last_payment}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>