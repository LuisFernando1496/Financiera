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
.profile{
    text-align: center;
}
.profile .img{
    border-radius: 50%;
    width: 200px;
    height: 200px;
    background-size: cover; /*redimensiona apropiadamente*/
    background-position: center;
    background-repeat: no-repeat;
    margin: 0 auto;
}
/* .card{
    background: white;
    display: inline-block;
    padding: 7px;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    width: 300px;
    height: 400px;
} */
</style>
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Registro De Cliente</h5>
                <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="/client" method="post" enctype="multipart/form-data" onsubmit="upperCreate()">
                    @csrf
                    <div class="form-group">
                        <label for="">Sucursal</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                            <option value="null">Seleccione una sucursal</option>
                            @foreach($branches as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <div class="d-flex justify-content-center">
                            <div class="card profile">
                                <p>Imagen del domicio</p>
                                <div class="avatar">
                                    <input type="file" name="clientImg" id="file-uploader" accept="image/*">
                                    <div class="img" style="background-image: url('/5547324.png');"></div>
                                        <label for="file-uploader" class="avatar-selector">
                                            <!--<i class="fa fa-camera"></i>-->
                                            <i class="fa fa-image"></i>
                                        </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="name">Nombre(s)</label>
                            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Nombre(s)" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="last_name">Apellidos</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Apellido(s)" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" value="" maxlength="13" required />
                        </div>
                        <div class="form-group col-6">
                            <label for="curp">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curp" placeholder="CURP" value="" maxlength="18" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Tel cel." value="" maxlength="10" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="cellphone">Celular</label>
                            <input type="text" class="form-control" name="cellphone" id="cellphone" value="" placeholder="Celular" maxlength="10" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="genre">Género</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genre" value="Masculino" checked>
                                <label class="form-check-label" for="genre">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genre" id="genre" value="Femenino">
                                <label class="form-check-label" for="genre">
                                    Femenino
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" value="" placeholder="example@gmail.com"  />
                    </div>
                    <div class="form-group">
                        <label for="street">Calle / Avenida</label>
                        <input type="text" class="form-control" name="street" id="street" value="" placeholder="Calle" required />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label for="int_number">Número interior</label>
                            <input type="text" class="form-control" name="int_number" id="int_number" placeholder="123" maxlength="7" value="" required/>
                        </div>
                        <div class="form-group col-3">
                            <label for="ext_number">Número exterior</label>
                            <input type="text" class="form-control" name="ext_number" id="ext_number" placeholder="234" maxlength="7" value="" required/>
                        </div>
                        <div class="form-group col-3">
                            <label for="suburb">Colonia / Barrio</label>
                            <input type="text" class="form-control" name="suburb" id="suburb" value="" placeholder="Colonia" required />
                        </div>
                        <div class="form-group col-3">
                            <label for="postal_code">Código postal</label>
                            <input type="number" class="form-control" name="postal_code" id="postal_code" value="" placeholder="29000" max="100000" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control" name="city" id="city" value="" placeholder="Ciudad" required />
                        </div>
                        <div class="form-group col-4">
                            <label for="state">Estado</label>
                            <select class="form-control" type="text" name="state" id="state" value="" required>
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
                            <input type="text" class="form-control" name="country" id="country" value="México" placeholder="País" readonly />
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
    document.querySelector("#file-uploader")
    .addEventListener("change", function(ev){
        let files = ev.target.files;

        let image = files[0];

        let imageURL = URL.createObjectURL(image);

        document.querySelector(".profile .img")
        .style.backgroundImage = "url('"+ imageURL +"')";
        console.log(files);
    });
})()
</script>
