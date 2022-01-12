<style>
    input[type="file"] {
    display: none;

}
.docs{
    border: 1px solid #4433ff ;
    display: inline-block;
    border-radius: 6px;

    padding: 6px 12px;
    cursor: pointer;
}
.docs:hover{
    /* box-shadow: 0px 0px 5px 1px black; */
    background-color: #dad6ff;
    box-shadow: 0px 15px 20px rgba(130, 146, 140, 0.4);
    /* color: #fff; */
    transform: translateY(-3px);
}
</style>
<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creditModalLabel">Solicitud De Crédito</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="/credit" method="post" enctype="multipart/form-data">
                    <h6 style="text-align: center; text-decoration: underline;"><a href="https://www.burodecredito.com.mx/" target="__blank">Antes de registrar al cliente consulte su historial crediticio aquí</a></h6>
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="individual_credit" name="individual_credit" value="individual_credit">
                                <label class="form-check-label" for="inlineCheckbox1"><span>Crédito individual</span><br><span>personal</span></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="seller_credit" name="seller_credit" value="seller_credit">
                                <label class="form-check-label" for="inlineCheckbox2"><span>Crédito</span><br><span>comerciante</span></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aditional_credit" name="aditional_credit" value="aditional_credit">
                                <label class="form-check-label" for="inlineCheckbox3"><span>Crédito adicional</span><br><span>paralelo</span></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="renovation_credit" name="renovation_credit" value="renovation_credit">
                                <label class="form-check-label" for="inlineCheckbox3">Renovación</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="insurance_credit" name="insurance_credit" value="insurance_credit">
                                <label class="form-check-label" for="inlineCheckbox3">Seguro de vida</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="guarantee" name="guarantee" value="guarantee">
                                <label class="form-check-label" for="inlineCheckbox3">Garantía</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="view_file" hidden>
                        <label class="docs" for="fileLocal">Imagen Del Negocio</label>
                        <input type="file" accept="image/*" name="fileLocal" id="fileLocal">
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
                            <select name="client_id" class="form-control" id="client_id">
                                <option value="null">Seleccione un cliente</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->last_name}} {{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="type_id">Tipo De identificación</label>
                            <input type="text" class="form-control" name="type_id" id="type_id" value="" placeholder="Tipo De identificación" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="num_id">Núm. De identificación</label>
                            <input type="number" min="0" class="form-control" name="num_id" id="num_id" value="" placeholder="Núm. De identificación" />
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
                            <input type="number" min="0" class="form-control" name="NRP" id="NRP" value="" placeholder="N° Registro Patronal" required />
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
                                <input type="text" class="form-control" name="cellphone2" id="cellphone2" value="" placeholder="Celular" maxlength="10" required />
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
                                <input type="text" class="form-control" name="last_name_aval" id="last_name_aval" value="" placeholder="Apellido Paterno" />
                            </div>
                            <div class="form-group">
                                <label for="second_last_name_aval">Apellido Materno</label>
                                <input type="text" class="form-control" name="second_last_name_aval" id="second_last_name_aval" value="" placeholder="Apellido Materno" />
                            </div>
                            <div class="form-group">
                                <label for="name_aval">Nombres(s)</label>
                                <input type="text" class="form-control" name="name_aval" id="name_aval" value="" placeholder="Nombre(s)" />
                            </div>
                            <div class="form-group">
                                <label for="phone_aval">Teléfono</label>
                                <input type="text" class="form-control" name="phone_aval" id="phone_aval" value="" maxlength="10" placeholder="Teléfono/Celular" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_warranty">Tipo</label>
                                <input type="text" class="form-control" name="type_warranty" id="type_warranty" value="" placeholder="Tipo" />
                            </div>
                            <div class="form-group">
                                <label for="description_warranty">Descripción</label>
                                <input type="text" class="form-control" name="description_warranty" id="description_warranty" value="" placeholder="Descripción" />
                            </div>
                            <div class="form-group">
                                <label for="model_warranty">Modelo</label>
                                <input type="text" class="form-control" name="model_warranty" id="model_warranty" value="" placeholder="Modelo" />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="serie_warranty">Serie</label>
                                    <input type="text" class="form-control" name="serie_warranty" id="serie_warranty" value="" placeholder="Serie" />
                                </div>
                                <div class="form-group col-4">
                                    <label for="placa_warranty">Placa</label>
                                    <input type="text" class="form-control" name="placa_warranty" id="placa_warranty" value="" placeholder="Placa" />
                                </div>
                                <div class="form-group col-4">
                                    <label for="color_warranty">Color</label>
                                    <input type="text" class="form-control" name="color_warranty" id="color_warranty" value="" placeholder="Color" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <center>
                        <h6>4.- Datos para determinar el monto de crédito</h6>
                        <div class="h-divider">
                        </div>
                    </center>
                    <div class="form-row" style="padding-bottom: 1%;">
                        <div class="form-group col-12">
                            <label for="pension">A.- En caso de tener descuentos a favor de llenar la siguiente información: Descuento mensual por pensión alimenticia (en su caso)</label>
                            <input type="number" class="form-control" name="pension" id="pension" value="" placeholder="Pensión alimenticia" min="0" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="time_Credit">B.- Plazo del crédito en meses (4 semanas)</label>
                            <input type="number" min="1" class="form-control" name="time_Credit" id="time_Credit" required>
                        </div>
                        <div class="form-group col-4">
                            <label for="interes">Interés</label>
                            <input type="number" min="1" max="100" class="form-control" name="interes" id="interes">
                        </div>
                        <div class="form-group col-4">
                            <label for="want_credit">C.- Crédito solicitado</label>
                            <input type="number" class="form-control" name="want_credit" id="want_credit" value="" placeholder="Crédito solicitado" min="1" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="check_credit">D.- Crédito aprobado</label>
                            <input type="number" class="form-control" name="check_credit" id="check_credit" value="" placeholder="Crédito aprobado" min="1" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="totalCredit">E.- Crédito Total (Interés)</label>
                            <input type="number" class="form-control" name="total_credit" id="totalCredit" value="" placeholder="Crédito aprobado" min="1" readonly required />
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
                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Nombre del banco" />
                        </div>
                        <div class="form-group col-4">
                            <label for="credit_bank_number">Número único asociado de la tarjeta</label>
                            <input type="text" class="form-control" name="credit_bank_number" id="credit_bank_number" value="" placeholder="Número único asociado de la tarjeta" />
                        </div>
                        <div class="form-group col-4">
                            <label for="credit_bank_key">Clabe, cuenta o n° tarjeta</label>
                            <input type="text" class="form-control" name="credit_bank_key" id="credit_bank_key" value="" placeholder="Clabe, cuenta o n° tarjeta" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city_of">Ciudad de</label>
                        <input type="text" class="form-control" name="city_of" id="city_of" value="" placeholder="Ciudad de"/>
                    </div>
                    <div class="modal-footer">
                        <button onclick="limpiar()" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
