<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagaré</title>
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
            <h3 style="padding-top: 6%;">PAGARÉ</h3>
        </center>
        <div style="text-align: justify; font-size: 15px;">
            <p>
                Por medio de este Pagaré, yo {{$client->last_name}} {{$client->name}}, (en lo sucesivo, el "Suscriptor"), prometo pagar incondicionalmente a la vista a GRUPO MONEYFIN, S.A.S. de C.V., (en lo sucesivo, "Moneyfin") o a la persona que represente sus derechos en el domicilio ubicado en AV CARLOS A MADRAZO SN ADO CARDENAS LOCAL 6, COL. CENTRO HEROICA CARDENAS., ESTADO DE TABASCO., CP. 86400, o en cualquier otro domicilio que Moneyfin indique, la cantidad de ${{$check_credit}} (Pesos 00/100).
            </p>
            <p>
                En caso de que la cantidad estipulada en este Pagaré no fuese pagada en su totalidad a la vista, el Suscriptor se obliga a pagar incondicionalmente a Moneyfin, intereses moratorios a razón de una tasa mensual del 50% (Cincuenta por ciento) anual más IVA sobre el monto total estipulado en este Pagaré, calculándose desde el momento del incumplimiento y hasta su total y completo pago.
            </p>
            <p>
                Los intereses moratorios que causa este Pagaré se calcularán sobre la base de un año de 360 (Trescientos Sesenta) días por el número de días efectivamente transcurridos.
            </p>
            <p>
                Para efectos del artículo 128 (Ciento Veintiocho) de la Ley General de Títulos y Operaciones de Crédito, el Suscriptor prorroga irrevocablemente el plazo para la presentación de este Pagaré hasta la fecha que ocurra 1 (Un) años después de la fecha de suscripción del mismo, en el entendido de que dicha extensión no impedirá la presentación de este Pagaré con anterioridad a dicha fecha. El Suscriptor promete incondicionalmente pagar los gastos que impliquen el cobro de este Pagaré y los honorarios de los abogados que intervengan en el mismo cobro.
            </p>
            <p>
                El Suscriptor se somete expresa e irrevocablemente a las leyes aplicables y a la jurisdicción de los Tribunales competentes del municipio de HEROICA CARDENAS, TABASCO, México., renunciando en forma expresa a cualquier otro fuero que pudiere corresponderle por razón de su domicilio presente o por cualquier otro motivo.
            </p>
            <p>
                Se suscribe el presente Pagaré el {{$day}} DE {{$month}} DE {{$year}}, en HEROICA CARDENAS, Estado de TABASCO, México.
            </p>

            <table border="1" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th colspan="5">
                            EL SUSCRIPTOR <br> ACEPTO DEBER Y PAGAR
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Nombre: <strong>{{$client->last_name}} {{$client->name}}</strong></td>
                        <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="3">
                            <br><br>
                            ___________________________________
                            <p>Firma del suscriptor</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Domicilio: {{$client->street}} {{$client->suburb}}, {{$client->postal_code}}. {{$client->city}}, {{$client->state}}; {{$client->country}}.</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Teléfono: {{$client->cellphone}}</td>
                    </tr>
                </tbody>
            </table>

            <table border="1" style="width:100%; border-collapse: collapse; padding-top: 14%;">
                <thead>
                    <tr>
                        <th colspan="5">
                            EL AVAL <br> ACEPTO DEBER Y PAGAR
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Nombre: <strong>{{$credit->last_name_aval}} {{$credit->second_last_name_aval}} {{$credit->name_aval}}</strong></td>
                        <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="3">
                            <br><br>
                            ___________________________________
                            <p>Firma del aval</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Domicilio: {{$credit->address}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; vertical-align: middle;" colspan="3">Teléfono: {{$credit->phone_aval}}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </main>
</body>

</html>