<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de amortización</title>
    <style>
        /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .signaturetitle {
            position: center;
            text-align: center;
            font-weight: bold;
            font-size: 200%;
        }

        .signature {
            text-align: center;
            height: 20px;
            word-spacing: 1px;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.jpeg" width="50%" height="100%" />
    </header>

    <main>
        <center>
            <h3>TABLA DE PAGOS</h3>
        </center>
        <p>NOMBRE DEL CLIENTE: <strong>{{$client->last_name}} {{$client->name}}</strong></p>
        <p>TELÉFONO: <strong>{{$client->cellphone}}</strong></p>
        <p>MONTO DEL CREDITO: <strong>{{$total_credit}}</strong></p>
        <p>FRECUENCIA DE PAGO: <strong>Semanal</strong></p>
        <!-- <p>DIA DE PAGO: <strong></strong></p> -->
        <!-- <p>HORA DE PAGO: <strong></strong></p> -->
        <p>PLAZO: <strong>{{$amortization_num}} semanas</strong></p>
        <p>REGIÓN: <strong>TABASCO</strong></p>
        <p>SUCURSAL: <strong>CARDENAS 03 (AV CARLOS A MADRAZO SN AD CARDENAS LOCAL 6 CARDENAS TABASCO).</strong></p>
        <p>TELÉFONOS: <strong>(56) 11785863, (55) 85640631.</strong></p>
        <p>EMAIL: <strong>atenciónausuarios@grupomoneyfin.com</strong></p>

        <br><br>
        <table border="1" style="width:98%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #EEEEEE;">
                    <th class="text-center">NO. de pago</th>
                    <th class="text-center">Fecha de pago</th>
                    <th class="text-center">Pagos puntuales</th>
                    <th class="text-center">Pagos con atraso</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{$item["num"]}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$item["date"]}}</td>
                    <td style="text-align: center; vertical-align: middle;">$ {{$item["rent"]}}</td>
                    <td style="text-align: center; vertical-align: middle;">$ {{number_format($item["rent"]+100, 2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>

</body>

</html>