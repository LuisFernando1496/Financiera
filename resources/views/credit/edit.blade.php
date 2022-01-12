<div class="modal fade" id="creditModalEdit" tabindex="-1" role="dialog" aria-labelledby="creditModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creditModalEditLabel">Vista solicitud De Crédito</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="creditModalEditForm" action="/credit" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="renovation_credit" value="renovation_credit">
                                <label class="form-check-label" for="inlineCheckbox3">Renovación</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox5" name="insurance_credit" value="insurance_credit">
                                <label class="form-check-label" for="inlineCheckbox3">Seguro de vida</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox6" name="guarantee" value="guarantee">
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
                            <input type="number" readonly class="form-control" name="num_credit" id="num_creditEdit" value="" placeholder="Número de Crédito" min="1" required />
                        </div>
                        <div class="form-group col-8">
                            <label for="curp">Cliente</label>
                            <input type="text" id="client" class="form-control" name="client" value="prueba" readonly>
                            <input type="hidden" id="client_idEdit" name="client_id">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="type_id">Tipo De identificación</label>
                            <input type="text" readonly class="form-control" name="type_id" id="type_idEdit" value="" placeholder="Tipo De identificación" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="num_id">Núm. De identificación</label>
                            <input type="number" readonly min="1" class="form-control" name="num_id" id="num_idEdit" value="" placeholder="Núm. De identificación" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="auth_date">Fecha Validez</label>
                            <input type="date" readonly class="form-control" name="auth_date" id="auth_dateEdit" value="" placeholder="Fecha validez" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label for="civil_state">Estado Civil</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civil_state" id="civil_states" value="0" checked>
                                <label class="form-check-label" for="civil_state">
                                    Soltero
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civil_state" id="civil_stateC" value="1">
                                <label class="form-check-label" for="civil_state">
                                    Casado
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="regimen">Régimen Patrimonial Del Matrimonio</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="regimen" id="regimenS" value="Separación" checked>
                                <label class="form-check-label" for="regimen">
                                    Separación De Bienes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="regimen" id="regimenC" value="Conyugal">
                                <label class="form-check-label" for="regimen">
                                    Sociedad Conyugal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="regimen" id="regimenL" value="Legal">
                                <label class="form-check-label" for="regimen">
                                    Sociedad Legal
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="current_house">La Vivienda Que Actualmente Habita Es</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="current_house" id="current_houseP" value="0" checked>
                                <label class="form-check-label" for="current_house">
                                    Propia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="current_house" id="current_houseF" value="1">
                                <label class="form-check-label" for="current_house">
                                    De Familiares
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="economic">N° Dependiente económico</label>
                            <input type="number"readonly min="1" class="form-control" name="economic" id="economicEdit" value="" placeholder="Dependiente económico" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-7">
                            <label for="entreprise_name">Nombre Empresa ó Patrón</label>
                            <input type="text"  readonly class="form-control" name="entreprise_name" id="entreprise_nameEdit" value="" placeholder="Nombre Empresa" required />
                        </div>
                        <div class="form-group col-5">
                            <label for="NRP">N° Registro Patronal (NRP)</label>
                            <input type="number" readonly min="1" class="form-control" name="NRP" id="NRPEdit" value="" placeholder="N° Registro Patronal" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="entreprise_phone">Teléfono De Empresa ó Patrón</label>
                            <input type="text" readonly class="form-control" name="entreprise_phone" id="entreprise_phoneEdit" value="" placeholder="Teléfono De Empresa ó Patrón" required />
                        </div>
                        <div class="form-group col-3">
                            <label for="schedule_in">Horario Laboral Entrada</label>
                            <input type="time" readonly class="form-control" name="schedule_in" id="schedule_inEdit" value="" placeholder="Horario Laboral Entrada" required />
                        </div>
                        <div class="form-group col-3">
                            <label for="schedule_out">Horario Laboral Salida</label>
                            <input type="time" readonly class="form-control" name="schedule_out" id="schedule_outEdit" value="" placeholder="Horario Laboral Salida" required />
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
                                <input type="text" readonly class="form-control" name="last_name2" id="last_name2Edit" value="" placeholder="Apellido Paterno" required />
                            </div>
                            <div class="form-group">
                                <label for="second_last_name2">Apellido Materno</label>
                                <input type="text" readonly class="form-control" name="second_last_name2" id="second_last_name2Edit" value="" placeholder="Apellido Materno" required />
                            </div>
                            <div class="form-group">
                                <label for="name2">Nombres(s)</label>
                                <input type="text" readonly class="form-control" name="name2" id="name2Edit" value="" placeholder="Nombre(s)" required />
                            </div>
                            <div class="form-group">
                                <label for="phone2">Teléfono</label>
                                <input type="text" readonly class="form-control" name="phone2" id="phone2Edit" value="" placeholder="Teléfono" required />
                            </div>
                            <div class="form-group">
                                <label for="cellphone2">Celular</label>
                                <input type="text" readonly class="form-control" name="cellphone2" id="cellphone2Edit" value="" placeholder="Celular" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name3">Apellido Paterno</label>
                                <input type="text" readonly class="form-control" name="last_name3" id="last_name3Edit" value="" placeholder="Apellido Paterno" required />
                            </div>
                            <div class="form-group">
                                <label for="second_last_name3">Apellido Materno</label>
                                <input type="text" readonly class="form-control" name="second_last_name3" id="second_last_name3Edit" value="" placeholder="Apellido Materno" required />
                            </div>
                            <div class="form-group">
                                <label for="name3">Nombres(s)</label>
                                <input type="text" readonly class="form-control" name="name3" id="name3Edit" value="" placeholder="Nombre(s)" required />
                            </div>
                            <div class="form-group">
                                <label for="phone3">Teléfono</label>
                                <input type="text" readonly class="form-control" name="phone3" id="phone3Edit" value="" placeholder="Teléfono" required />
                            </div>
                            <div class="form-group">
                                <label for="cellphone3">Celular</label>
                                <input type="text" readonly class="form-control" name="cellphone3" id="cellphone3Edit" value="" placeholder="Celular" required />
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
                                <input type="text"  readonly class="form-control" name="last_name_aval" id="last_name_avalEdit" value="" placeholder="Apellido Paterno" required />
                            </div>
                            <div class="form-group">
                                <label for="second_last_name_aval">Apellido Materno</label>
                                <input type="text" readonly class="form-control" name="second_last_name_aval" id="second_last_name_avalEdit" value="" placeholder="Apellido Materno" required />
                            </div>
                            <div class="form-group">
                                <label for="name_aval">Nombres(s)</label>
                                <input type="text" readonly class="form-control" name="name_aval" id="name_avalEdit" value="" placeholder="Nombre(s)" required />
                            </div>
                            <div class="form-group">
                                <label for="phone_aval">Teléfono</label>
                                <input type="text" readonly class="form-control" name="phone_aval" id="phone_avalEdit" value="" placeholder="Teléfono/Celular" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_warranty">Tipo</label>
                                <input type="text" readonly class="form-control" name="type_warranty" id="type_warrantyEdit" value="" placeholder="Tipo" required />
                            </div>
                            <div class="form-group">
                                <label for="description_warranty">Descripción</label>
                                <input type="text" readonly class="form-control" name="description_warranty" id="description_warrantyEdit" value="" placeholder="Descripción" required />
                            </div>
                            <div class="form-group">
                                <label for="model_warranty">Modelo</label>
                                <input type="text"  readonly class="form-control" name="model_warranty" id="model_warrantyEdit" value="" placeholder="Modelo" required />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="serie_warranty">Serie</label>
                                    <input type="text" readonly class="form-control" name="serie_warranty" id="serie_warrantyEdit" value="" placeholder="Serie" required />
                                </div>
                                <div class="form-group col-4">
                                    <label for="placa_warranty">Placa</label>
                                    <input type="text" readonly class="form-control" name="placa_warranty" id="placa_warrantyEdit" value="" placeholder="Placa" required />
                                </div>
                                <div class="form-group col-4">
                                    <label for="color_warranty">Color</label>
                                    <input type="text" readonly class="form-control" name="color_warranty" id="color_warrantyEdit" value="" placeholder="Color" required />
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
                            <input type="number" readonly class="form-control" name="pension" id="pensionEdit" value="" placeholder="Pensión alimenticia" min="1" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="time_Credit">B.- Plazo del crédito</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit4" value="4" checked>
                                <label class="form-check-label" for="time_Credit">
                                    4 Meses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit5" value="5">
                                <label class="form-check-label" for="time_Credit">
                                    5 Meses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="time_Credit" id="time_Credit6" value="6">
                                <label class="form-check-label" for="time_Credit">
                                    6 Meses
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="want_credit">C.- Crédito solicitado</label>
                            <input type="number" readonly class="form-control" name="want_credit" id="want_creditEdit" value="" placeholder="Crédito solicitado" min="1" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="check_credit">D.- Crédito aprobado</label>
                            <input type="number" readonly class="form-control" name="check_credit" id="check_creditEdit" value="" placeholder="Crédito aprobado" min="1" required />
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
                            <input type="text" readonly class="form-control" name="bank_name" id="bank_nameEdit" value="" placeholder="Nombre del banco" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="credit_bank_number">Número único asociado de la tarjeta</label>
                            <input type="text"  readonly class="form-control" name="credit_bank_number" id="credit_bank_numberEdit" value="" placeholder="Número único asociado de la tarjeta" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="credit_bank_key">Clabe, cuenta o n° tarjeta</label>
                            <input type="text" readonly class="form-control" name="credit_bank_key" id="credit_bank_keyEdit" value="" placeholder="Clabe, cuenta o n° tarjeta" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city_of">Ciudad de</label>
                        <input type="text" readonly class="form-control" name="city_of" id="city_ofEdit" value="" placeholder="Ciudad de" required />
                    </div>
                    
                </form>
            </div>

        </div>
    </div>
</div>