<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Créditos desembolsados del {{$start_date}} a {{$end_date}}</title>
</head>

<body>
    @php
    $total=0
    @endphp
    <br>
    <center>
        <h3>Reporte Créditos desembolsados del {{$start_date}} a {{$end_date}}</h3>
    </center>
    <table border="1" style="width:98%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #EEEEEE;">
                <th class="text-center">N. de crédito</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Monto solicitado</th>
                <th class="text-center">Monto aprobado</th>
                <th class="text-center">Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($credits as $item)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{$item->num_credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->type_id}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->want_credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->check_credit}}</td>
                <td style="text-align: center; vertical-align: middle;">{{$item->client->name}} {{$item->client->last_name}}</td>
                @php
                $total = $total+$item->check_credit
                @endphp
            </tr>
            @endforeach
            <tr style="background-color: #EEEEEE;">
                <td style="text-align:center" colspan="3">
                    Total: $
                </td>
                <td style="text-align:center" colspan="2">
                    $ {{$total}}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>