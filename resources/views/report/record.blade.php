<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de {{$report_type}} {{$start_date}} - {{$end_date}}</title>
</head>
<style>
    tbody{
        margin-top: 3%;
    }
    table{
        text-align: center;
    }
</style>
<body>
    <table border="" style="width:100%; ">
        <thead>
            <tr style="background-color: #FFFFFF;">
                <td style="text-align:center" colspan="1">
                    {{-- <img src="{{asset('logo.jpeg')}}" alt="" height="120px" width="100px"> --}}
                </td>
                <td style="text-align:center" colspan="7">
                    <h3>Reporte de {{$report_type}} {{$start_date}} - {{$end_date}}</h3>
                </td>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Número de crédito</th>
                <th>Total de crédito</th>
                <th>Lapso de crédito</th>
                <th>Fecha Límite</th>
                <th>Cantidad de último pago</th>
                <th>Moratorios</th>
                <th>Crédito restante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr style="background-color: #EEEEEE;">
                <th colspan="12">Tipo de crédito {{ $d->creditType }}</th>
            </tr>
            <tr>
                <td>{{ $d->name }} {{ $d->lastname }}</td>
                <td>{{ $d->creditNum }}</td>
                <td>${{ $d->totalCredit }}</td>
                <td>{{ $d->creditTime }}</td>
                <td>{{ $d->finalDate }}</td>
                <td>${{ $d->cash }}</td>
                <td>{{ $d->moratorios }}</td>
                <td>${{ $d->restCredit }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
