<style>
    input[type="file"] {
        display: none;
    }
</style>
<div class="modal fade" id="documentacionModal" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creditModalLabel">Subir Documentación Firmada</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="documentsCredit" action="/documentCredits" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <center>
                        <h6>Solo documentos PDF</h6>
                    </center>
                    <div class="row">
                        <div class="form-group col-5"></div>
                        <div class="form_group col-7">
                            <label for="">Archivos seleccionados:</label>
                        </div>
                    </div>
                    <input type="number" id="credit_id" name="credit_id" value="" hidden>
                    <div class="row">
                        <div class="form-group col-5 mb-3">
                            <input type="file" class="form-control" name="document_1" id="document_1" required/>
                            <label for="document_1" class="btn btn-primary">Subir documento firmado de</label>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="document_1_mostrar" value=""/>
                                <a href="" id="show1" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <input type="file" class="form-control" name="document_2" id="document_2"/>
                            <label for="document_2" class="btn btn-primary">Subir documento firmado de</label>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="document_2_mostrar" value=""/>
                                <a href="" id="show2" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <input type="file" class="form-control" name="document_3" id="document_3"/>
                            <label for="document_3" class="btn btn-primary">Subir documento firmado de</label>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="document_3_mostrar" value=""/>
                                <a href="" id="show3" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <input type="file" class="form-control" name="document_4" id="document_4" />
                            <label for="document_4" class="btn btn-primary">Subir documento firmado de</label>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="document_4_mostrar" value=""/>
                                <a href="" id="show4" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
