<style>
    .avatar{
    position: relative;
}
.avatar input[type = 'file']{
    display: none;
}
.avatar-selector{
    background-color: #009688;
    color: white;
    border-radius: 50%;
    padding: 0.8em;
    font-size: 1.2em;
    cursor: pointer;
    position: absolute;
    right: 2.5em;
    bottom: 0.5em;
}
.profile2{
    text-align: center;
}
.profile2 .img{
    border-radius: 50%;
    width: 200px;
    height: 200px;
    background-size: cover; /*redimensiona apropiadamente*/
    background-position: center;
    background-repeat: no-repeat;
    margin: 0 auto;
}
</style>
<div class="modal fade" id="clientModalEdit" tabindex="-1" role="dialog" aria-labelledby="clientModalLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabelEdit">Editar datos del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="clientModalEditForm" action="/client" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Imagen actual de la vivienda</label><br>
                            <img class="ml-5" id="clientImg" src="" width="250" height="250" style="background-size: cover;">
                        </div>
                        <div class="form-group col-6">
                            {{-- <div class="d-flex justify-content-center"> --}}
                                <div class="card profile2">
                                    <p>Subir nueva imagen de domicilio</p>
                                    <div class="avatar">
                                        <input type="file" name="clientImgEdit" id="file-uploader2" accept="image/*">
                                        <div class="img" style="background-image: url('/1087087.png');"></div>
                                            <label for="file-uploader2" class="avatar-selector">
                                                <i class="fa fa-image"></i>
                                            </label>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                        <div class="form-group col-6">
                            <label for="name">Nombre(s)</label>
                            <input type="text" class="form-control" name="name" id="nameEdit" placeholder="Nombre(s)" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="last_name">Apellidos</label>
                            <input type="text" class="form-control" name="last_name" id="last_nameEdit" placeholder="Apellido(s)" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfcEdit" placeholder="RFC" maxlength="13" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="curp">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curpEdit" placeholder="CURP" maxlength="18" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" name="phone" id="phoneEdit" placeholder="Tel cel." maxlength="10" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="cellphone">Celular</label>
                            <input type="text" class="form-control" name="cellphone" id="cellphoneEdit" value="" placeholder="Celular" maxlength="10" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="genre">Género</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genreEditM" value="Masculino" checked>
                                <label class="form-check-label" for="genre">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genreEditF" value="Femenino">
                                <label class="form-check-label" for="genre">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="emailEdit" placeholder="example@gmail.com" required />
                    </div>
                    <div class="form-group">
                        <label for="street">Calle / avenida</label>
                        <input type="text" class="form-control" name="street" id="streetEdit" placeholder="Calle" required />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="int_number">Número interior</label>
                            <input type="text" class="form-control" name="int_number" id="int_numberEdit" placeholder="123" required/>
                        </div>
                        <div class="form-group col-3">
                            <label for="ext_number">Número exterior</label>
                            <input type="text" class="form-control" name="ext_number" id="ext_numberEdit" placeholder="234" required/>
                        </div>
                        <div class="form-group col-3">
                            <label for="suburb">Colonia / barrio</label>
                            <input type="text" class="form-control" name="suburb" id="suburbEdit" placeholder="Colonia" required />
                        </div>
                        <div class="form-group col-3">
                            <label for="postal_code">Código postal</label>
                            <input type="number" class="form-control" name="postal_code" id="postal_codeEdit" placeholder="29000" max="100000" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control" name="city" id="cityEdit" placeholder="Ciudad" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="state">Estado</label>
                            <select class="form-control" type="text" name="state" id="stateEdit" required>
                                <option value="Ciudad de México">Ciudad de México</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Cd. México">Cd. México</option>
                                <option value="Michoacán">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="country">País</label>
                            <input type="text" class="form-control" name="country" id="countryEdit" placeholder="País" readonly />
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
<script>
    (function(){
    document.querySelector("#file-uploader2")
    .addEventListener("change", function(ev){
        let files = ev.target.files;

        let image = files[0];

        let imageURL = URL.createObjectURL(image);

        document.querySelector(".profile2 .img")
        .style.backgroundImage = "url('"+ imageURL +"')";
        console.log(files);
    });
})()
</script>
