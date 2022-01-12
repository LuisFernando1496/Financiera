<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de crédito</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Bootstrap css-->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}"> -->

    <style>
        .wrapper {
            width: 400px;
            height: 200px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .signature-pad {
            left: 0;
            top: 0;
            width: 400px;
            height: 200px;
            background-color: white;
            border-width: 5px;
            border-color: black;
        }
    </style>
</head>

<body>
    <form>
        <div class="form-row">
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="individual_credit" value="individual_credit">
                    <label class="form-check-label" for="inlineCheckbox1">Crédito individual personal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="seller_credit" value="seller_credit">
                    <label class="form-check-label" for="inlineCheckbox2">Crédito comerciante</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="aditional_credit" value="aditional_credit">
                    <label class="form-check-label" for="inlineCheckbox3">Crédito adicional paralelo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="renovation_credit" value="renovation_credit">
                    <label class="form-check-label" for="inlineCheckbox3">Renovación</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="insurance_credit" value="insurance_credit">
                    <label class="form-check-label" for="inlineCheckbox3">Seguro de vida</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="guarantee" value="guarantee">
                    <label class="form-check-label" for="inlineCheckbox3">Garantía</label>
                </div>
            </div>
        </div>
        <center>
            <h6>1.- Datos de identificación del cliente</h6>
            <div class="h-divider">
            </div>
        </center>
        <div class="form-row" style="padding-bottom: 1%;">
            <div class="form-group col-4">
                <label for="num_credit">Número de Crédito</label>
                <input type="number" class="form-control" name="num_credit" id="num_credit" value="" placeholder="Número de Crédito" min="1" required />
            </div>
            <div class="form-group col-8">
                <label for="curp">Cliente</label>
                <input type="text" value="PRUEBA ALONSO" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label for="type_id">Tipo De identificación</label>
                <input type="text" class="form-control" name="type_id" id="type_id" value="" placeholder="Tipo De identificación" required />
            </div>
            <div class="form-group col-4">
                <label for="num_id">Núm. De identificación</label>
                <input type="number" min="1" class="form-control" name="num_id" id="num_id" value="" placeholder="Núm. De identificación" required />
            </div>
            <div class="form-group col-4">
                <label for="auth_date">Fecha Validez</label>
                <input type="date" class="form-control" name="auth_date" id="auth_date" value="" placeholder="Fecha validez" required />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-2">
                <label for="civil_state">Estado Civil</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="civil_state" id="civil_state" value="0" checked>
                    <label class="form-check-label" for="civil_state">
                        Soltero
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="civil_state" id="civil_state" value="1">
                    <label class="form-check-label" for="civil_state">
                        Casado
                    </label>
                </div>
            </div>
            <div class="form-group col-4">
                <label for="regimen">Régimen Patrimonial Del Matrimonio</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="regimen" id="regimen" value="Separación" checked>
                    <label class="form-check-label" for="regimen">
                        Separación De Bienes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="regimen" id="regimen" value="Conyugal">
                    <label class="form-check-label" for="regimen">
                        Sociedad Conyugal
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="regimen" id="regimen" value="Legal">
                    <label class="form-check-label" for="regimen">
                        Sociedad Legal
                    </label>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="current_house">La Vivienda Que Actualmente Habita Es</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="current_house" id="current_house" value="0" checked>
                    <label class="form-check-label" for="current_house">
                        Propia
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="current_house" id="current_house" value="1">
                    <label class="form-check-label" for="current_house">
                        De Familiares
                    </label>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="economic">N° Dependiente económico</label>
                <input type="number" min="1" class="form-control" name="economic" id="economic" value="" placeholder="Dependiente económico" required />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-7">
                <label for="entreprise_name">Nombre Empresa ó Patrón</label>
                <input type="text" class="form-control" name="entreprise_name" id="entreprise_name" value="" placeholder="Nombre Empresa" required />
            </div>
            <div class="form-group col-5">
                <label for="NRP">N° Registro Patronal (NRP)</label>
                <input type="number" min="1" class="form-control" name="NRP" id="NRP" value="" placeholder="N° Registro Patronal" required />
            </div>
            <div class="form-group col-6">
                <label for="entreprise_phone">Teléfono De Empresa ó Patrón</label>
                <input type="text" class="form-control" name="entreprise_phone" id="entreprise_phone" value="" maxlength="10" placeholder="Teléfono De Empresa ó Patrón" required />
            </div>
            <div class="form-group col-3">
                <label for="schedule_in">Horario Laboral Entrada</label>
                <input type="time" class="form-control" name="schedule_in" id="schedule_in" value="" placeholder="Horario Laboral Entrada" required />
            </div>
            <div class="form-group col-3">
                <label for="schedule_out">Horario Laboral Salida</label>
                <input type="time" class="form-control" name="schedule_out" id="schedule_out" value="" placeholder="Horario Laboral Salida" required />
            </div>
        </div>
        <center>
            <h6>2.- Referencias familiares del cliente</h6>
            <div class="h-divider">
            </div>
        </center>
        <div class="row" style="padding-bottom: 1%;">
            <div class="col-6">
                <div class="form-group">
                    <label for="last_name2">Apellido Paterno</label>
                    <input type="text" class="form-control" name="last_name2" id="last_name2" value="" placeholder="Apellido Paterno" required />
                </div>
                <div class="form-group">
                    <label for="second_last_name2">Apellido Materno</label>
                    <input type="text" class="form-control" name="second_last_name2" id="second_last_name2" value="" placeholder="Apellido Materno" required />
                </div>
                <div class="form-group">
                    <label for="name2">Nombres(s)</label>
                    <input type="text" class="form-control" name="name2" id="name2" value="" placeholder="Nombre(s)" required />
                </div>
                <div class="form-group">
                    <label for="phone2">Teléfono</label>
                    <input type="text" class="form-control" name="phone2" id="phone2" value="" placeholder="Teléfono" maxlength="10" required />
                </div>
                <div class="form-group">
                    <label for="cellphone2">Celular</label>
                    <input type="text" class="form-control" name="cellphone2" id="cellphone2" value="" placeholder="Celular" required />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="last_name3">Apellido Paterno</label>
                    <input type="text" class="form-control" name="last_name3" id="last_name3" value="" placeholder="Apellido Paterno" required />
                </div>
                <div class="form-group">
                    <label for="second_last_name3">Apellido Materno</label>
                    <input type="text" class="form-control" name="second_last_name3" id="second_last_name3" value="" placeholder="Apellido Materno" required />
                </div>
                <div class="form-group">
                    <label for="name3">Nombres(s)</label>
                    <input type="text" class="form-control" name="name3" id="name3" value="" placeholder="Nombre(s)" required />
                </div>
                <div class="form-group">
                    <label for="phone3">Teléfono</label>
                    <input type="text" class="form-control" name="phone3" id="phone3" value="" placeholder="Teléfono" maxlength="10" required />
                </div>
                <div class="form-group">
                    <label for="cellphone3">Celular</label>
                    <input type="text" class="form-control" name="cellphone3" id="cellphone3" value="" placeholder="Celular" maxlength="10" required />
                </div>
            </div>
        </div>
        <center>
            <h6>3.- Aval y garantía</h6>
            <div class="h-divider">
            </div>
        </center>
        <div class="row" style="padding-bottom: 1%;">
            <div class="col-6">
                <div class="form-group">
                    <label for="last_name_aval">Apellido Paterno</label>
                    <input type="text" class="form-control" name="last_name_aval" id="last_name_aval" value="" placeholder="Apellido Paterno" required />
                </div>
                <div class="form-group">
                    <label for="second_last_name_aval">Apellido Materno</label>
                    <input type="text" class="form-control" name="second_last_name_aval" id="second_last_name_aval" value="" placeholder="Apellido Materno" required />
                </div>
                <div class="form-group">
                    <label for="name_aval">Nombres(s)</label>
                    <input type="text" class="form-control" name="name_aval" id="name_aval" value="" placeholder="Nombre(s)" required />
                </div>
                <div class="form-group">
                    <label for="phone_aval">Teléfono</label>
                    <input type="text" class="form-control" name="phone_aval" id="phone_aval" value="" placeholder="Teléfono/Celular" maxlength="10" required />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="type_warranty">Tipo</label>
                    <input type="text" class="form-control" name="type_warranty" id="type_warranty" value="" placeholder="Tipo" required />
                </div>
                <div class="form-group">
                    <label for="description_warranty">Descripción</label>
                    <input type="text" class="form-control" name="description_warranty" id="description_warranty" value="" placeholder="Descripción" required />
                </div>
                <div class="form-group">
                    <label for="model_warranty">Modelo</label>
                    <input type="text" class="form-control" name="model_warranty" id="model_warranty" value="" placeholder="Modelo" required />
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="serie_warranty">Serie</label>
                        <input type="text" class="form-control" name="serie_warranty" id="serie_warranty" value="" placeholder="Serie" required />
                    </div>
                    <div class="form-group col-4">
                        <label for="placa_warranty">Placa</label>
                        <input type="text" class="form-control" name="placa_warranty" id="placa_warranty" value="" placeholder="Placa" required />
                    </div>
                    <div class="form-group col-4">
                        <label for="color_warranty">Color</label>
                        <input type="text" class="form-control" name="color_warranty" id="color_warranty" value="" placeholder="Color" required />
                    </div>
                </div>
            </div>
        </div>
        <center>
            <h6>4.- Datos para determinar el monto de crédito</h6>
            <div class="h-divider">
            </div>
        </center>
        <div class="form-row" style="padding-bottom: 1%;">
            <div class="form-group col-6">
                <label for="pension">A.- En caso de tener descuentos a favor de llenar la siguiente información: Descuento mensual por pensión alimenticia (en su caso)</label>
                <input type="number" class="form-control" name="pension" id="pension" value="" placeholder="Pensión alimenticia" min="1" required />
            </div>
            <div class="form-group col-6">
                <label for="time_Credit">B.- Plazo del crédito</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit" value="4" checked>
                    <label class="form-check-label" for="time_Credit">
                        4 Meses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit" value="5">
                    <label class="form-check-label" for="time_Credit">
                        5 Meses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit" value="6">
                    <label class="form-check-label" for="time_Credit">
                        6 Meses
                    </label>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="want_credit">C.- Crédito solicitado</label>
                <input type="number" class="form-control" name="want_credit" id="want_credit" value="" placeholder="Crédito solicitado" min="1" required />
            </div>
            <div class="form-group col-6">
                <label for="check_credit">D.- Crédito aprobado</label>
                <input type="number" class="form-control" name="check_credit" id="check_credit" value="" placeholder="Crédito aprobado" min="1" required />
            </div>
        </div>
        <center>
            <h6>5.- Datos para abono en cuenta de crédito</h6>
            <div class="h-divider">
            </div>
        </center>
        <div class="form-row" style="padding-bottom: 1%;">
            <div class="form-group col-4">
                <label for="bank_name">Nombre del banco</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Nombre del banco" required />
            </div>
            <div class="form-group col-4">
                <label for="credit_bank_number">Número único asociado de la tarjeta</label>
                <input type="text" class="form-control" name="credit_bank_number" id="credit_bank_number" value="" placeholder="Número único asociado de la tarjeta" required />
            </div>
            <div class="form-group col-4">
                <label for="credit_bank_key">Clabe, cuenta o n° tarjeta</label>
                <input type="text" class="form-control" name="credit_bank_key" id="credit_bank_key" value="" placeholder="Clabe, cuenta o n° tarjeta" required />
            </div>
        </div>
        <div class="form-group">
            <label for="city_of">Ciudad de</label>
            <input type="text" class="form-control" name="city_of" id="city_of" value="" placeholder="Ciudad de" required />
        </div>
        <center>
            <div class="wrapper">
                <canvas id="signature-pad" class="signature-pad form-control" width=400 height=200></canvas>
            </div>
            <p>Firma del cliente</p>
        </center>
    </form>
</body>

</html>
