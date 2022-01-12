<div class="modal fade" id="surveyModalEdit" tabindex="-1" role="dialog" aria-labelledby="surveyModalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="surveyModalEditLabel">Nueva Encuesta</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="surveyModalEditForm" action="/survey" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="name">Nombre del cliente</label>
                            <input type="text" class="form-control" name="name" id="nameEdit"  required>
                        </div>
                        <div class="form-group col-3">
                            <label for="age">Edad</label>
                            <input type="number" class="form-control" name="age" id="ageEdit" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="business_line">Giro del negocio</label>
                            <input type="text" class="form-control" name="business_line" id="business_lineEdit" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="antiquity">Antiguedad</label>
                            <input type="text" class="form-control" name="antiquity" id="antiquityEdit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="">¿El crédito es para la inversión de su propio negocio?</label>
                            <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="self_inversion" id="self_inversion1Edit" checked required>
                                <label class="form-check-label" for="self_inversion1">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="self_inversion" id="self_inversion2Edit" required>
                                <label class="form-check-label" for="self_inversion2">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="">¿Ha quedado mal en alguna entidad de creditos personales o grupales?</label>
                            <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="bad_record" id="bad_record1Edit" checked required>
                                <label class="form-check-label" for="bad_record1">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="bad_record" id="bad_record2Edit" required>
                                <label class="form-check-label" for="bad_record2">
                                    No
                                </label>
                            </div>
                        </div>                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                        <label for="">¿Conoce usted su historial crediticio?</label>
                        <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="self_record" id="self_record1Edit" checked required>
                                <label class="form-check-label" for="self_record1">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="self_record" id="self_record2Edit" required>
                                <label class="form-check-label" for="self_record2">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="">¿Ha sido alguna vez presta nombre?</label>
                            <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="name_giver" id="name_giver1Edit" checked required>
                                <label class="form-check-label" for="name_giver1">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="name_giver" id="name_giver2Edit" required>
                                <label class="form-check-label" for="name_giver2">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="gain">¿Cual es la ganancia mensual de su negocio?</label>
                            <input type="number" class="form-control" name="gain" id="gainEdit"  required>
                        </div>
                        <div class="form-group col-6">
                            <label for="other_gains">¿Cuenta con algún otro ingreso economico? ¿Cual?</label>
                            <input type="text" class="form-control" name="other_gains" id="other_gainsEdit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="other_credits">¿Tiene algun credito vigente en alguna otra entidad? ¿Cual?</label>
                            <input type="text" class="form-control" name="other_credits" id="other_creditsEdit"  required>
                        </div>
                        <div class="form-group col-4">
                            <label for="credit_amount">¿De cuanto es el crédito?</label>
                            <input type="number" class="form-control" name="credit_amount" id="credit_amountEdit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="">¿Tienen conocimiento sus familiares del crédito que solicita?</label>
                            <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="family_knows" id="family_knows1Edit" checked required>
                                <label class="form-check-label" for="family_knows1">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="family_knows" id="family_knows2Edit" required>
                                <label class="form-check-label" for="family_knows2">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-8">
                            <label for="how_financial">¿Como se enteró de la financiera apoyando a mi negocio?</label>                            
                            <textarea class="form-control" name="how_financial" id="how_financialEdit" rows="3" required></textarea>
                        </div>
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