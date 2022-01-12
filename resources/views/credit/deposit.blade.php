<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de depósito</title>
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
            top: 0.5cm;
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
    </style>
</head>

<body>

    <main>
        <table border="1" style="width:99%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th colspan="5" rowspan="1">
                        <div style="float: left;">
                            <img src="logo.jpeg" width="14%">
                        </div>
                        <h3 style="text-align: center;">FICHA MULTIPLE DE DEPOSITO</h3>
                    </th>
                </tr>
            </thead>
        </table>
        <table border="1" style="width:99%; border-collapse: collapse; padding-top: 1%;">
            <thead>
                <tr>
                    <th colspan="5">
                        <p style="font-size: 15px;">SELECCIONE ALGUNA OPCION DE ESTE RECUADRO PARA CUENTA</p>
                        <p>
                            <strong>
                                BANCO IMBURSA S.A. INSTITUCION DE BANCA MULTIPLE GRUPO FINANCIERO INBURSA
                            </strong>
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: justify; vertical-align: middle;" colspan="1">
                        NO. Contrato
                    </td>
                    <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1">
                        <p>1111</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify; vertical-align: middle;" colspan="1">
                        Nombre del cliente:
                    </td>
                    <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1">
                        <p>{{$client->last_name}} {{$client->name}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify; vertical-align: middle;" colspan="1">
                        Monto del pago:
                    </td>
                    <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1">
                        <p>{{$amountPay}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify; vertical-align: middle;" colspan="1">
                        Beneficiario:
                    </td>
                    <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1">
                        <p>GRUPO MONEYFIN SAS DE CV</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: justify; vertical-align: middle;" colspan="1">
                        Banco receptor:
                    </td>
                    <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1">
                        <p>BANCO INBURSA SA</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <img src="accounts.png" width="99%">
        <img src="info.png" width="99%">
    </main>

</body>

</html>